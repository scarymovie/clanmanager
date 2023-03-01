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

    public function index(Clan $clan, $week = null)
    {
        $week = '03.01.2024';
//        $weekday = Carbon::parse($week)->weekday();
        $weekday = Carbon::parse()->weekday();
        $events = Event::with('status', 'weekday')->get();
//dd($events);
        $member = Member::where('user_id', Auth::id())->with('characters', 'characters.type')->first();

        foreach ($events as $event){

            $eventMemberStatus = EventMemberStatus::query()
                ->where('event_id', $event->id)
                ->where('member_id', $member->id)
                ->where('clan_id', $clan->id)
                ->first();

            $event['status'] = $eventMemberStatus['status'] ?? null;
            $dayName = Carbon::parse($event->start_date)->locale('ru_RU')->dayName;
            $event['week_day_name'] = mb_convert_case($dayName, MB_CASE_TITLE, "UTF-8");
            $event['week_day'] = Carbon::parse($event->start_date)->isoWeekday();
            $event['time'] = $event->weekday->time;
        }
        $events = collect($events)->sortBy('week_day');
        $character = $member->characters->where('status', 'main')->first();

        return view('events.index', compact(['events', 'clan', 'character', 'weekday']));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Clan $clan, Event $event)
    {
        $dayName = Carbon::parse($event->start_date)->locale('ru_RU')->dayName;
        $event['week_day'] = mb_convert_case($dayName, MB_CASE_TITLE, "UTF-8");
        $member = Member::where('user_id', Auth::id())->with('characters', 'characters.type')->first();
        $characters = $member->characters;
        return view('events.show', compact(['event', 'clan', 'characters']));
    }

    public function showDetails(Request $request, Clan $clan)
    {
        $validated = $request->all();
        $event = Event::find($validated['event']);
//        $user = Auth::user();
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
        $validated['event_id'] = $event->id;

        $validated['clan_id'] = $clan->id;
        $validated['status'] = $request->status;

        $member = Member::where('clan_id', $validated['clan_id'])->where('user_id', Auth::id())->with('characters')->first();
        $validated['character_id'] = $member->characters->where('status', 'main')->first()->id;
        $validated['member_id'] = $member->id;

        $eventMember = EventMemberStatus::updateOrCreate(
            ['clan_id' => $validated['clan_id'], 'event_id' => $validated['event_id'],
                'member_id' => $validated['member_id'], 'character_id' => $validated['character_id']],
            ['status' => $validated['status']]
        );

        return redirect()->back();
    }

    public function test(Request $request, Clan $clan, Event $event)
    {
        $event_day = $event->start_date;
        $currentEvent = Carbon::now()->diffInWeeks($event_day);
        $event_date = Carbon::parse($event_day)->addWeek(3);

        $validated['event_id'] = $event->id;

        $validated['clan_id'] = $clan->id;
        $validated['status'] = 'cool';

        $member = Member::where('clan_id', $validated['clan_id'])->where('user_id', Auth::id())->with('characters')->first();
        $validated['character_id'] = $member->characters->where('status', 'main')->first()->id;
        $validated['member_id'] = $member->id;

        $eventMember = EventMemberStatus::updateOrCreate(
            ['clan_id' => $validated['clan_id'], 'event_id' => $validated['event_id'],
                'member_id' => $validated['member_id'], 'character_id' => $validated['character_id']],
            ['status' => $validated['status'], 'event_date' => $event_date, 'party_leader_id' => '1', ]
        );
        return redirect()->back();
    }
}
