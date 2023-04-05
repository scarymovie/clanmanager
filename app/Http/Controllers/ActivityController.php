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
        $startDate = Carbon::parse($start ?? now()->startOfMonth());
        $endDate = Carbon::parse($end ?? now()->endOfMonth());

        $members = Member::where('clan_id', $clan->id)->with('characters')->get();

        $events = Event::where('clan_id', $clan->id)->get();
        $gvgList = GuildWars::where('clan_id', $clan->id)->get();

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

        $memberActivity = [];
        foreach ($members as $member) {
            $eventDaysOfWeekCount = 0; // Общее количество ивентов, на которые мембер подтвердил участие
            $eventMemberStatusCount = EventMemberStatus::where('member_id', $member->id)
                ->whereBetween('event_date', [$startDate, $endDate])
                ->count();

            foreach ($eventStatistics as $event) {
                foreach ($event as $memberId => $attendance) {
                    if ($memberId == $member->id && $attendance['status'] == 'confirmed') {
                        $eventDaysOfWeekCount += $attendance['count'];
                    }
                }
            }

            $eventCounts = [];
            $memberEventCount = 0;
            foreach ($events as $event) {
                $dayOfWeek = Carbon::parse($event->start_date)->dayOfWeek;
                $eventCount = $startDate->diffInDaysFiltered(function (Carbon $date) use ($dayOfWeek) {
                    return $date->dayOfWeek === $dayOfWeek;
                }, $endDate);
                $memberEventCount += $eventCount;
                $eventCounts[$event->title] = $eventCount;
            }

            $activityRatio = $eventMemberStatusCount > 0 ? $eventMemberStatusCount / $memberEventCount * 100 : 0;

            $memberActivity[$member->id] = [
                'member' => $member,
                'activity_ratio' => round($activityRatio),
            ];
        }

        return view('activity.index', compact('members', 'eventStatistics', 'gvgList', 'clan', 'auth_member', 'memberActivity', 'memberEventCount', 'start', 'end'));
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
