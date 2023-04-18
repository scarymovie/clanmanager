<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Clan;
use App\Models\Event;
use App\Models\EventMemberStatus;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    public function index(Request $request, Clan $clan)
    {
        $request_date = Carbon::parse($request->date)->format('d.m.Y') ?? now();
        $week = Carbon::createFromFormat('d.m.Y', $request_date);
        $start_of_week = Carbon::parse($week)->startOf('week');
        $end_of_week = Carbon::parse($week)->endOfWeek();

        $member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->with('characters.type')->first();
        $memberCreatedAt = $member->created_at;

        $weekday = Carbon::parse($week ?? now())->isoWeekday();
        $diffDays = Carbon::now()->startOfWeek()->diffInDays(Carbon::parse($week->startOfWeek()), false);
        $diffWeeks = (int) round($diffDays / 7);

        $events = Event::where('clan_id', $clan->id)
            ->with(['status' => function ($query) use ($start_of_week, $end_of_week, $member) {
                $query->whereBetween('event_date', [$start_of_week, $end_of_week]);
                $query->where('member_id', $member->id);
            }])
            ->get();

        $attendedEvents = $member->attendedEvents($start_of_week, $end_of_week)->pluck('event_id')->toArray();
        $events = $events->map(function ($event) use ($memberCreatedAt, $start_of_week, $week, $member, $attendedEvents, $diffWeeks) {
            $diffDaysEventDate = Carbon::now()->diffInDays(Carbon::parse($event->start_date), false);
            $diffWeeksEventDate = (int) round(abs($diffDaysEventDate) / 7);
            $eventDate = Carbon::parse($event->start_date)->addWeek($diffWeeksEventDate);
            // Check if the event happened before the member joined the clan
            if ($eventDate->lt($memberCreatedAt)) {
//                dd($eventDate);
                $event->is_hidden = true;
                return $event;
            }

            // Calculate the number of weeks between the event date and the start of the week
            $diffWeeks = $eventDate->diffInWeeks($week, false);

            // Check if the event happened before the start of the week
//            if ($diffWeeks < 0) {
////                dd($diffWeeks);
//                $event->is_hidden = true;
//                return $event;
//            }

            $eventMemberStatus = EventMemberStatus::query()
                ->where('event_id', $event->id)
                ->where('member_id', $member->id)
                ->where('clan_id', $event->clan_id)
                ->first();

            $event->week_day_name = Carbon::parse($event->start_date)->locale('ru_RU')->dayName;
            $event->week_day = Carbon::parse($event->start_date)->isoWeekday();
            $event->time = date('d.m.Y', strtotime($event->start_date));
            $event->is_hidden = false;

            // Set the is_attended property based on whether the member attended the event
            $event->is_attended = in_array($event->id, $attendedEvents);

            return $event;
        })->sortBy('week_day');

        $character = $member->characters->where('status', 'main')->first();
        return view('events.index', compact(['events', 'clan', 'character', 'weekday', 'diffWeeks', 'member', 'week', 'attendedEvents']));
    }

    public function create(Clan $clan)
    {
        $member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
        return view('events.create', compact('clan', 'member'));
    }

    public function store(EventRequest $eventRequest, Clan $clan)
    {
        $validated = $eventRequest->validated();

        $event = Event::create([
            'title' => $validated['title'],
            'start_date' => $validated['date'],
            'clan_id' => $clan->id,
            'points' => $validated['points'],
        ]);

        return redirect()->route('events.index', compact('clan'));
    }

    public function show(Request $request, Clan $clan, Event $event, $difference)
    {
        $dayName = Carbon::parse($event->start_date)->locale('ru_RU')->dayName;
        $event['week_day'] = mb_convert_case($dayName, MB_CASE_TITLE, "UTF-8");
        $member = Member::where('user_id', Auth::id())->where('clan_id', $clan->id)->with('characters', 'characters.type')->first();
        $characters = $member->characters;
        return view('events.show', compact(['event', 'clan', 'characters', 'difference', 'member']));
    }

    public function showDetails(Request $request, Clan $clan)
    {
        $validated = $request->all();
        $event = Event::find($validated['event']);
        return response()->json($event);
    }

    public function edit(Event $event)
    {
        //
    }

    public function update(Request $request, Event $event)
    {
        //
    }

    public function destroy(Event $event)
    {
        //
    }

    public function eventStatus(Request $request, Clan $clan, Event $event, $difference)
    {
        $event_day = Carbon::parse($event->start_date);

        $currentEvent = Carbon::parse()->diffInWeeks($event_day);
        $event_date = Carbon::parse($event_day)->addWeeks($currentEvent)->addWeeks($difference ?? 0);

        $validated['event_id'] = $event->id;
        $validated['note'] = $request->note;
        $validated['clan_id'] = $clan->id;
        $validated['status'] = $request->status ?? 'confirmed';

        $member = Member::where('clan_id', $validated['clan_id'])->where('user_id', Auth::id())->with('characters')->first();
        $validated['character_id'] = $member->characters->where('status', 'main')->first()->id;
        $validated['member_id'] = $member->id;

        $eventMember = EventMemberStatus::updateOrCreate(
            [
                'clan_id' => $validated['clan_id'],
                'event_id' => $validated['event_id'],
                'member_id' => $validated['member_id'],
                'character_id' => $validated['character_id'],
                'event_date' => $event_date,
            ],
            [
                'status' => $validated['status'],
                'party_leader_id' => '1',
                'note' => $validated['note']
            ]
        );

        return redirect()->route('events.index', $clan);
    }

    public function eventMasterStatus(Request $request, Clan $clan, Event $event, Member $member)
    {
//        dd($request->all());
        $eventDate = Carbon::parse($event->start_date);

        $diffDays = Carbon::parse($eventDate)->diffInDays(Carbon::parse($request->week), false);
        $diffWeeks = (int) round($diffDays / 7);

        $validated['event_id'] = $event->id;
        $validated['note'] = $request->note ?? '';
        $validated['clan_id'] = $clan->id;
        $validated['status'] = $request->status;

        $validated['character_id'] = $member->characters->where('status', 'main')->first()->id;
        $validated['member_id'] = $member->id;

        $guildWarMember = EventMemberStatus::updateOrCreate(
            [
                'clan_id' => $validated['clan_id'],
                'event_id' => $validated['event_id'],
                'member_id' => $validated['member_id'],
                'character_id' => $validated['character_id'],
                'event_date' => $eventDate->addWeeks($diffWeeks)->format('Y-m-d'),
                'party_leader_id' => '1',
            ],
            [
                'status' => $validated['status'],
//                'note' => $validated['note']
            ]
        );
        return redirect()->back();
    }
}
