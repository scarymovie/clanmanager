<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\Event;
use App\Models\EventMemberStatus;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkCharacter');
    }

    public function index(Request $request, Clan $clan)
    {
        $week = $request->date;

        $weekday = Carbon::parse($week ?? now())->isoWeekday();
        $diffWeeks = Carbon::now()->diffInWeeks($week, false);

        $events = Event::where('clan_id', $clan->id)->with('status')->get();
        $member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->with('characters.type')->first();

        $events = $events->map(function ($event) use ($member) {
            $eventMemberStatus = EventMemberStatus::query()
                ->where('event_id', $event->id)
                ->where('member_id', $member->id)
                ->where('clan_id', $event->clan_id)
                ->first();

            $event->status = optional($eventMemberStatus)->status;
            $event->week_day_name = Carbon::parse($event->start_date)->locale('ru_RU')->dayName;
            $event->week_day = Carbon::parse($event->start_date)->isoWeekday();
            $event->time = date('d.m.Y', strtotime($event->start_date));

            return $event;
        })->sortBy('week_day');

        $character = $member->characters->where('status', 'main')->first();

        return view('events.index', compact(['events', 'clan', 'character', 'weekday', 'diffWeeks', 'member']));
    }

    public function create(Clan $clan, Member $member)
    {
//        $member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
        return view('events.create', compact('clan', 'member'));
    }

    public function store(Request $request, Clan $clan)
    {
        $validated = $request->all();
        unset($validated['_token']);
        // TODO сделать formrequest и добавить поинты
        $event = Event::create([
            'title' => $validated['title'],
            'start_date' => $validated['date'],
            'clan_id' => $clan->id,
            'points' => $validated['points'],
        ]);
        return redirect()->route('events', compact('clan'));
    }

    public function show(Request $request, Clan $clan, Event $event)
    {
        $difference = $request->difference;
        $dayName = Carbon::parse($event->start_date)->locale('ru_RU')->dayName;
        $event['week_day'] = mb_convert_case($dayName, MB_CASE_TITLE, "UTF-8");
        $member = Member::where('user_id', Auth::id())->with('characters', 'characters.type')->first();
        $characters = $member->characters;
        return view('events.show', compact(['event', 'clan', 'characters', 'difference']));
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

    public function eventStatus(Request $request, Clan $clan, Event $event)
    {
        $difference = $request->difference;
        $event_day = Carbon::parse($event->start_date);

        $currentEvent = Carbon::parse()->diffInWeeks($event_day);
        $event_date = Carbon::parse($event_day)->addWeeks($currentEvent)->addWeeks($difference ?? 0);

        $validated['event_id'] = $event->id;
        $validated['note'] = $request->note;
        $validated['clan_id'] = $clan->id;
        $validated['status'] = $request->status;

        $member = Member::where('clan_id', $validated['clan_id'])->where('user_id', Auth::id())->with('characters')->first();
        $validated['character_id'] = $member->characters->where('status', 'main')->first()->id;
        $validated['member_id'] = $member->id;

        $eventMember = EventMemberStatus::updateOrCreate(
            [
                'clan_id' => $validated['clan_id'],
                'event_id' => $validated['event_id'],
                'member_id' => $validated['member_id'],
                'character_id' => $validated['character_id']
            ],
            [
                'status' => $validated['status'],
                'event_date' => $event_date,
                'party_leader_id' => '1',
                'note' => $validated['note']
            ]
        );
//        dd($eventMember);
        return redirect()->route('events', $clan);
    }
}
