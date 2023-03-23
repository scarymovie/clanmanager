<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\GuildWars;
use App\Models\GuildWarsMemberStatus;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuildWarsController extends Controller
{

    public function index(Clan $clan)
    {
        $guildWars = GuildWars::where('clan_id', $clan->id)->with('status')->get();
        $member = Member::where('user_id', Auth::id())->with('characters', 'characters.type')->first();
        $character = $member->characters->where('status', 'main')->first();
        return view('guildwars.index', compact('clan', 'member', 'character', 'guildWars'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(GuildWars $guildWars)
    {
        //
    }

    public function showDetails(Request $request, Clan $clan)
    {
        $validated = $request->all();
        $guildWar = GuildWars::find($validated['gvg']);
        return response()->json($guildWar);
    }

    public function edit(GuildWars $guildWars)
    {
        //
    }

    public function update(Request $request, GuildWars $guildWars)
    {
        //
    }

    public function destroy(GuildWars $guildWars)
    {
        //
    }

    public function gvgStatus(Request $request, Clan $clan, GuildWars $guildWar)
    {
//        dd($request->all());
        $difference = $request->difference ?? '';
        $guildWar_day = Carbon::parse($guildWar->date);

        $currentGuildWar = Carbon::parse()->diffInWeeks($guildWar_day);
        $guildWar_date = Carbon::parse($guildWar_day)->addWeeks($currentGuildWar)->addWeeks($difference ?? 0);

        $validated['guild_war_id'] = $guildWar->id;
        $validated['note'] = $request->note;
        $validated['clan_id'] = $clan->id;
        $validated['status'] = $request->status;

        $member = Member::where('clan_id', $validated['clan_id'])->where('user_id', Auth::id())->with('characters')->first();
        $validated['character_id'] = $member->characters->where('status', 'main')->first()->id;
        $validated['member_id'] = $member->id;

        $guildWarMember = GuildWarsMemberStatus::updateOrCreate(
            [
                'clan_id' => $validated['clan_id'],
                'guild_wars_id' => $validated['guild_war_id'],
                'member_id' => $validated['member_id'],
                'character_id' => $validated['character_id']
            ],
            [
                'title' => $validated['status'],
                'party_leader_id' => '1',
                'note' => $validated['note']
            ]
        );
//        dd($guildWarMember);
        return redirect()->route('clan.gvg.index', $clan);
    }
}
