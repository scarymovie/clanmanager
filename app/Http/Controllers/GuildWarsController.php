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

    public function index(Request $request, Clan $clan)
    {
        $date = Carbon::parse($request->date)->format('d.m.Y');
        $startOfWeek = Carbon::parse(Carbon::parse($date)->format('d.m.Y') ?? now()->format('d.m.Y'))->startOfWeek()->format('d.m.Y');
        $endOfWeek = Carbon::parse(Carbon::parse($date)->format('d.m.Y') ?? now()->format('d.m.Y'))->endOfWeek()->format('d.m.Y');

        $member = Member::query()
            ->where('clan_id', $clan->id)
            ->where('user_id', Auth::id())
            ->with('characters', 'characters.type')
            ->first();

        $guildWars = GuildWars::query()
            ->where('clan_id', $clan->id)
            ->where('date', '>', Carbon::parse($member->created_at)->format('d.m.Y'))
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->with('guildWarMemberStatuses')
            ->get();

        $attendedGvgs = GuildWarsMemberStatus::query()
            ->where('member_id', $member->id)
            ->whereBetween('gvg_date', [$startOfWeek, $endOfWeek])
            ->pluck('guild_wars_id')
            ->toArray();

        $character = $member->characters->where('status', 'main')->first();

        return view('guildwars.index', compact('clan', 'member', 'character', 'guildWars', 'date', 'attendedGvgs'));
    }

    public function create(Clan $clan)
    {
        $member = Member::query()
            ->where('clan_id', $clan->id)
            ->where('user_id', Auth::id())
            ->first();

        return view('guildwars.create', compact('clan', 'member'));
    }

    public function store(Request $request, Clan $clan, GuildWars $guildWar)
    {
        $validated = $request->all();

        $gvg = GuildWars::create([
            'clan_id' => $clan->id,
            'title' => $validated['title'],
            'note' => $validated['note'] ?? '',
            'date' => $validated['date'] ?? '',
            'points' => $validated['points'],
        ]);
        return redirect()->route('gvg.index', compact('clan'));
    }

    public function show(Clan $clan, GuildWars $guildWar)
    {
        $member = Member::where('user_id', Auth::id())
            ->where('clan_id', $clan->id)
            ->with('characters', 'characters.type')
            ->first();
        $characters = $member->characters->where('status', 'main');

        return view('guildwars.show', compact('clan','guildWar', 'characters', 'member'));
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

    public function update(Request $request, Clan $clan, GuildWars $guildWar)
    {
        $validated = $request->all();
        $member = Member::query()
            ->where('user_id', Auth::id())
            ->where('clan_id', $clan->id)
            ->with('characters', 'characters.type')
            ->first();

        $gvg_status = GuildWarsMemberStatus::create(
            [
                'guild_wars_id' => $guildWar->id,
                'member_id' => $member->id,
                'clan_id' => $clan->id,
                'character_id' => $validated['character_id'],
                'title' => 'confirmed',
                'party_leader_id' => 1,
                'image' => $validated['image'] ?? '',
                'note' => $validated['note'] ?? ''
            ]
        );

        return redirect()->route('clan.gvg.index', compact('clan'));
    }

    public function destroy(GuildWars $guildWars)
    {
        //
    }

    public function gvgStatus(Request $request, Clan $clan, GuildWars $guildWar)
    {
        $difference = $request->difference ?? '';
        $guildWar_day = Carbon::parse($guildWar->date);

        $currentGuildWar = Carbon::parse()->diffInWeeks($guildWar_day);
        $guildWar_date = Carbon::parse($guildWar_day)->addWeeks($currentGuildWar)->addWeeks($difference ?? 0);

        $validated['guild_war_id'] = $guildWar->id;
        $validated['note'] = $request->note;
        $validated['clan_id'] = $clan->id;
        $validated['status'] = $request->status ?? 'confirmed';

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
                'gvg_date' => $guildWar->date,
                'title' => $validated['status'],
                'party_leader_id' => '1',
                'note' => $validated['note']
            ]
        );
        return redirect()->route('gvg.index', $clan);
    }
}
