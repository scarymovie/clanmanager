<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharactersType;
use App\Models\Clan;
use App\Models\Event;
use App\Models\EventMemberStatus;
use App\Models\GuildWars;
use App\Models\GuildWarsMemberStatus;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AcitivityController extends Controller
{
    public function index(Clan $clan)
    {
        $month_start = Carbon::now()->startOfMonth();
        $month_end = Carbon::now()->endOfMonth();

        $members = $clan->members;
        $membersIds = $members->pluck('id');
        $characters_types = CharactersType::all();

        $eventsList = Event::with('status')->where('clan_id', $clan->id)->get();
        $gvgList = GuildWars::where('clan_id', $clan->id)->get();

        $pointsOfConfirmedEvents = $eventsList->filter(function ($value, $key){
                return optional($value->status)->status === 'confirmed';
            })->sum('points') + GuildWars::where('clan_id', $clan->id)
                ->whereHas('status', function($query) {
                    $query->where('title', 'confirmed');
                })->sum('points');

        $events_all = $eventsList->count() + $gvgList->count();
        $gvgs_all = $gvgList->count();

        $events_confirmed = EventMemberStatus::with('character', 'events')
            ->where('clan_id', $clan->id)
            ->whereIn('member_id', $membersIds)
            ->whereBetween('event_date', [$month_start, $month_end])
            ->where('status', 'confirmed')
            ->get();

        $gvgs_confirmed = GuildWarsMemberStatus::where('clan_id', $clan->id)
            ->whereIn('member_id', $membersIds)
            ->whereBetween('updated_at', [$month_start, $month_end])
            ->where('title', 'confirmed')
            ->get();

        $countOfConfirmedEvents = $events_confirmed->count();
        $countOfConfirmedGvgs = $gvgs_confirmed->count();

        $clan_events = Event::where('clan_id', $clan->id)->count();
        $clan_gvgs = GuildWars::where('clan_id', $clan->id)->count();

        $activity_percent = ($clan_events != 0 && $clan_gvgs != 0) ? round(($countOfConfirmedEvents + $countOfConfirmedGvgs) / ($clan_events + $clan_gvgs) * 100, 2)
            : ($clan_events === 0 ? round($countOfConfirmedGvgs / $clan_gvgs * 100)
                : ($clan_gvgs === 0 ? round($countOfConfirmedEvents / $clan_events * 100) : 0));

        $acivity_events = $events_confirmed->merge($gvgs_confirmed)->count();

        return view('activity.index', compact(['clan', 'members', 'characters_types', 'activity_percent',
            'acivity_events', 'events_all', 'eventsList', 'pointsOfConfirmedEvents', 'gvgList']));
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
