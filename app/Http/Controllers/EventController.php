<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\Event;
use App\Models\EventMemberStatus;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function index(Clan $clan)
    {
        $events = Event::with('status')->get();
        $member = Member::where('user_id', Auth::id())->with('characters', 'characters.type')->first();

        foreach ($events as $event){
            $eventMemberStatus = EventMemberStatus::query()
                ->where('event_id', $event->id)
                ->where('member_id', $member->id)
                ->where('clan_id', $clan->id)
                ->first();

            $event['status'] = $eventMemberStatus['status'] ?? null;
        }
        $character = $member->characters->where('status', 'main')->first();

        return view('events.index', compact(['events', 'clan', 'character']));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
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

    public function eventStatus(Request $request)
    {
        $clan = Clan::where('title', $request->clan)->first();
        $validated['event_id'] = $request->event;

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
}
