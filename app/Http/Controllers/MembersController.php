<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharactersType;
use App\Models\Clan;
use App\Models\member;
use App\Service\CharacterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
{

    public function index(Clan $clan)
    {
        $auth_member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
        $members = Member::where('clan_id', $clan->id)->get();
        return view('members.index', compact('members', 'clan', 'auth_member'));
    }

    public function create(Clan $clan)
    {
        $auth_member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
        return view('members.create', compact('clan', 'auth_member'));
    }

    public function store(Request $request, Clan $clan)
    {
        $validated = $request->all();

        $member = Member::create([
            'clan_id' => $clan->id,
            'user_id' => Auth::id(),
            'nickname' => $validated['nickname'],
            'rank' => 'Мембер'
            ]);

        $member->assignRole('Candidate');

        return redirect()->back();
    }

    public function show(Request $request, member $member)
    {
        $members = Member::where();
    }

    public function edit(member $member)
    {
        //
    }

    public function update(Request $request, member $member)
    {
        //
    }

    public function destroy(Clan $clan, Member $member)
    {
        $member->delete();
        return redirect()->back();
    }

    public function createMaster(Request $request, Clan $clan, CharacterService $characterService)
    {
        $validated = $request->all();
        $validated['clan_id'] = $clan->id;

        if (Member::checkIfMasterNotExist($clan)){
            $member = Member::create([
                'clan_id' => $validated['clan_id'],
                'user_id' => Auth::id(),
                'rank' => 'Мастер'
            ]);

            $member->assignRole('Master');
            $validated['status'] = 'main';
            $validated['character_type_id'] = $request->character_type;
            $validated['link'] = $request->link;
            $characterService->checkIfMainExists($validated['status'], $member);

            $character = $characterService->createCharacter($validated, $member);
        }

        return redirect()->route('members', compact('clan'));
    }

    public function getInvitedUserData($token)
    {
        $clan = Clan::where('invite_link', $token)->firstOrFail();
        $characters_type = CharactersType::all();
        return view('middleware.no_characters', compact('clan', 'characters_type'));
    }

}
