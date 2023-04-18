<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\Event;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SignaturesEventsController extends Controller
{
    public function index(Request $request, Clan $clan)
    {
        $auth_member = Member::where('clan_id', $clan->id)->where('user_id', \Auth::id())->first();

        $week = Carbon::parse($request->date ?? now())->format('d.m.Y');
        $start_of_week =  Carbon::parse($week)->startOfWeek();
        $end_of_week = Carbon::parse($week)->endOfWeek();

        $weekday = Carbon::parse($week ?? now())->isoWeekday();
        $diffDays = Carbon::now()->diffInDays(Carbon::parse($week), false);
        $diffWeeks = (int) floor($diffDays / 7);

        $eventList = Event::query()
            ->where('clan_id', $clan->id)
            ->with(['status' => function ($query) use ($start_of_week, $end_of_week) {
                $query->whereBetween('event_date', [$start_of_week, $end_of_week]);
            }])->get();

        return view('signatures.events', compact('clan', 'auth_member', 'eventList', 'week'));
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

    public function show(Request $request, Clan $clan, Event $event)
    {
        $week = Carbon::parse($request->week ?? now())->format('d.m.Y');
        $start_of_week =  Carbon::parse($week)->startOfWeek();
        $end_of_week = Carbon::parse($week)->endOfWeek();

        $auth_member = Member::where('clan_id', $clan->id)->where('user_id', \Auth::id())->first();

        $members = Member::where('clan_id', $clan->id)->with(['eventMemberStatuses' => function ($query) use ($start_of_week, $end_of_week) {
            $query->whereBetween('event_date', [$start_of_week, $end_of_week]);
        },'characters.type'])->get();

        $members = $members->sortBy(function ($member) {
            return $member->eventMemberStatuses->first()->status ?? 'Нет информации';
        });

        return view('signatures.show_event', compact('clan', 'event', 'auth_member', 'members'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
