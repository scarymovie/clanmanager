<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\GuildWars;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SignaturesController extends Controller
{
    public function index(Request $request, Clan $clan)
    {
        $auth_member = Member::where('clan_id', $clan->id)->where('user_id', \Auth::id())->first();
        $start = Carbon::parse($request->start ?? now()->startOf('week'))->format('d.m.Y');
        $end = Carbon::parse($request->end ?? now()->endOfWeek())->format('d.m.Y');

        $gvgList = GuildWars::query()
            ->where('clan_id', $clan->id)
            ->whereBetween('date', [$start, $end])
            ->with('guildWarMemberStatuses')
            ->get();

        return view('signatures.index', compact('clan', 'auth_member', 'gvgList'));
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

    public function show(Clan $clan, GuildWars $guildWar)
    {
        $auth_member = Member::where('clan_id', $clan->id)->where('user_id', \Auth::id())->first();
        $members = Member::where('clan_id', $clan->id)->with(['guildWarMemberStatuses','characters.type'])->get();

        $members = $members->sortBy(function ($member) {
            return $member->guildWarMemberStatuses->first()->title ?? 'Нет информации';
        });

        return view('signatures.show', compact('clan', 'guildWar', 'auth_member', 'members'));
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
