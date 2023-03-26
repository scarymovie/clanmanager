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

        $eventsList = Event::with('status')
            ->where('clan_id', $clan->id)
            ->get();
        $gvgList = GuildWars::where('clan_id', $clan->id)
            ->get();

        $pointsOfConfirmedGvgs = GuildWars::where('clan_id', $clan->id)
            ->whereHas('status', function($query) {
                $query->where('title', 'confirmed');
            })->sum('points');

        $pointsOfConfirmedEvents = $eventsList->filter(function ($value, $key) {
                return $value->status != null && $value->status->status === 'confirmed';
            })->sum('points') + $pointsOfConfirmedGvgs;

        $events_all = count($eventsList) + count($gvgList);
        $gvgs_all = count($gvgList);

        $events_confirmed = EventMemberStatus::where('clan_id', $clan->id)
            ->whereIn('member_id', $membersIds)
            ->when($month_start, function($query) use ($month_start) {
                $query->where('event_date', '>', $month_start);
            })
            ->when($month_end, function($query) use ($month_end) {
                $query->where('event_date', '<', $month_end);
            })
            ->where('status', 'confirmed')
            ->with('character', 'events')
            ->get();

        $gvgs_confirmed = GuildWarsMemberStatus::where('clan_id', $clan->id)
            ->whereIn('member_id', $membersIds)
            ->when($month_start, function($query) use ($month_start) {
                $query->where('updated_at', '>', $month_start);
            })
            ->when($month_end, function($query) use ($month_end) {
                $query->where('updated_at', '<', $month_end);
            })
            ->where('title', 'confirmed')
            ->get();

        $countOfConfirmedEvents = count($events_confirmed);
        $countOfConfirmedGvgs = count($gvgs_confirmed);

        $clan_events = Event::where('clan_id', $clan->id)->count();
        $clan_gvgs = GuildWars::where('clan_id', $clan->id)->count();

        $activity_percent = 0;
        if ($clan_events != 0 && $clan_gvgs != 0) {
            $activity_percent = round(($countOfConfirmedEvents + $countOfConfirmedGvgs) / ($clan_events + $clan_gvgs) * 100, 2);
        } elseif ($clan_events === 0 && $clan_gvgs != 0) {
            $activity_percent = round($countOfConfirmedGvgs / $clan_gvgs * 100);
        } elseif ($clan_gvgs === 0 && $clan_events != 0) {
            $activity_percent = round($countOfConfirmedEvents / $clan_events * 100);
        }

        $acivity_events = count($events_confirmed) + count($gvgs_confirmed);

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
