<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharactersType;
use App\Models\Clan;
use App\Models\Event;
use App\Models\EventMemberStatus;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AcitivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clan $clan)
    {
        $month_start = Carbon::now()->startOfMonth();
        $month_end = Carbon::now()->endOfMonth();

        $members = $clan->members;
        $membersIds = $members->pluck('id');
        $characters_types = CharactersType::all();

        $eventsList = Event::query()
            ->with('status')
            ->where('clan_id', $clan->id)
            ->get();

        $events_all = count($eventsList);

        $events_confirmed = EventMemberStatus::where('clan_id', $clan->id)
            ->whereIn('member_id', $membersIds)
            ->where('event_date', '>', $month_start)
            ->where('event_date', '<', $month_end)
            ->where('status', 'confirmed')
            ->with('character')
            ->get();

        $countOfConfirmedEvents = count($events_confirmed);
        $clan_events = count(Event::where('clan_id', $clan->id)->get());
        if ($clan_events != 0){
            $activity_percent = round( $countOfConfirmedEvents / $clan_events * 100);
        } else {
            $activity_percent = 0;
        }
        $acivity_events = count($events_confirmed);

        return view('activity.index', compact(['clan', 'members', 'characters_types', 'activity_percent',
            'acivity_events', 'events_all', 'eventsList', 'countOfConfirmedEvents']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventMemberStatus  $eventMemberStatus
     * @return \Illuminate\Http\Response
     */
    public function show(EventMemberStatus $eventMemberStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventMemberStatus  $eventMemberStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(EventMemberStatus $eventMemberStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventMemberStatus  $eventMemberStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventMemberStatus $eventMemberStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventMemberStatus  $eventMemberStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventMemberStatus $eventMemberStatus)
    {
        //
    }
}
