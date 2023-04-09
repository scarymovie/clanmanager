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
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index(Request $request, Clan $clan)
    {
        $start = $request->start;
        $end = $request->end;
        $auth_member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
        $startDate = $start ? Carbon::parse($start) : Carbon::now()->startOfMonth();
        $endDate = $end ? Carbon::parse($end) : Carbon::now()->endOfMonth();

        $members = Member::where('clan_id', $clan->id)->with('characters')->get();

        $events = Event::where('clan_id', $clan->id)->get();
        $gvgList = GuildWars::where('clan_id', $clan->id)->whereBetween('date', [$startDate->format('d.m.Y'), $endDate->format('d.m.Y')])->get();

        $eventStatistics = [];
        foreach ($events as $event) {
            $attendees = EventMemberStatus::where('event_id', $event->id)
                ->whereBetween('event_date', [$startDate, $endDate])
                ->get();

            $eventAttendances = [];
            foreach ($attendees as $attendee) {
                $member = Member::find($attendee->member_id);
                $eventAttendances[$member->id] = [
                    'status' => $attendee->status,
                    'count' => isset($eventAttendances[$member->id]) ? $eventAttendances[$member->id]['count'] + 1 : 1,
                ];
            }
            $eventStatistics[$event->title] = $eventAttendances;
        }

        $gvgStatistics = [];
        foreach ($gvgList as $gvg) {
            $attendees = GuildWarsMemberStatus::where('guild_wars_id', $gvg->id)
                ->whereBetween('gvg_date', [$startDate->format('d.m.Y'), $endDate->format('d.m.Y')])
                ->get();
            $gvgAttendances = [];
            foreach ($attendees as $attendee) {
                $member = Member::find($attendee->member_id);
                $gvgAttendances[$member->id] = [
                    'status' => $attendee->title,
                    'count' => isset($gvgAttendances[$member->id]) ? $gvgAttendances[$member->id]['count'] + 1 : 1,
                ];
            }
            $gvgStatistics[$gvg->title] = $gvgAttendances;
        }

        $memberActivity = [];
        foreach ($members as $member) {
            $eventDaysOfWeekCount = 0;
            $gvgDaysOfWeekCount = 0;

            $eventMemberStatusCount = EventMemberStatus::where('member_id', $member->id)
                ->whereBetween('event_date', [$member->created_at->format('d.m.Y'), $endDate])
                ->count();

            $gvgMemberStatusCount = GuildWarsMemberStatus::where('member_id', $member->id)
                ->whereBetween('gvg_date', [$member->created_at->format('d.m.Y'), $endDate->format('d.m.Y')])
                ->count();

            foreach ($eventStatistics as $event) {
                foreach ($event as $memberId => $attendance) {
                    if ($memberId == $member->id && $attendance['status'] == 'confirmed') {
                        $eventDaysOfWeekCount += $attendance['count'];
                    }
                }
            }

            foreach ($gvgStatistics as $gvg) {
                foreach ($gvg as $memberId => $attendance) {
                    if ($memberId == $member->id && $attendance['status'] == 'confirmed') {
                        $gvgDaysOfWeekCount += $attendance['count'];
                    }
                }
            }

            $eventCounts = [];
            $memberEventCount = 0;
            foreach ($events as $event) {
                $dayOfWeek = Carbon::parse($event->start_date)->dayOfWeek;
                $eventCount = $member->created_at->diffInDaysFiltered(function (Carbon $date) use ($dayOfWeek) {
                    return $date->dayOfWeek === $dayOfWeek;
                }, $endDate);
                $memberEventCount += $eventCount;
                $eventCounts[$event->title] = $eventCount;
            }

            $gvgCounts = [];
            $memberGvgCount = 0;
            foreach ($gvgList as $gvg) {
                if (Carbon::parse($gvg->date)->greaterThanOrEqualTo($member->created_at)) {
                    $gvgCount = 1;
                    $memberGvgCount += $gvgCount;
                    $gvgCounts[$gvg->title] = $gvgCount;
                }
            }

            $activityRatio = ($eventMemberStatusCount + $gvgMemberStatusCount) > 0 ? ($eventMemberStatusCount + $gvgMemberStatusCount) / ($memberEventCount + $gvgMemberStatusCount) * 100 : 0;

            $memberActivity[$member->id] = [
                'member' => $member,
                'activity_ratio' => round($activityRatio),
                'event_count' => $memberEventCount,
                'gvg_count' => $memberGvgCount,
                'event_counts' => $eventCounts,
                'gvg_counts' => $gvgCounts,
            ];
        }
//        dd($memberActivity);
        return view('activity.index', compact('members', 'eventStatistics', 'gvgList', 'clan', 'auth_member', 'memberActivity', 'memberEventCount', 'start', 'end', 'events', 'gvgStatistics'));
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
