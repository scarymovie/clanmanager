<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemberMasterRequest;
use App\Models\Character;
use App\Models\CharactersType;
use App\Models\Clan;
use App\Models\member;
use App\Service\CharacterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MembersController extends Controller
{
    public function index(Clan $clan)
    {
        $members = $clan->members()
            ->with(['characters', 'roles'])
            ->whereHas('characters', function ($query) {
                $query->where('status', 'main');
            })
            ->whereHas("roles", function ($query) {
                $query->whereIn("name", ["Master", "Member"]);
            })->get();

        $auth_member = $members->firstWhere('user_id', Auth::id());

        return view('members.index', compact('clan', 'members', 'auth_member'));
    }

    public function create(Clan $clan)
    {
        $members = $clan->members()
            ->with(['characters', 'roles'])
            ->whereHas("roles", function ($query) {
                $query->whereIn("name", ["Candidate"]);
            })->get();

        $auth_member = $clan->members->firstWhere('user_id', Auth::id());
        return view('members.create', compact('clan', 'auth_member', 'members'));
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

    public function createMaster(CreateMemberMasterRequest $createMemberMasterRequest, Clan $clan, CharacterService $characterService)
    {
        if (Member::checkIfMasterNotExist($clan)) {
            $member = Member::create([
                'clan_id' => $clan->id,
                'user_id' => Auth::id(),
                'rank' => 'Мастер'
            ]);
            $member->assignRole('Master');

            $validated = $createMemberMasterRequest->validated();
            $validated['status'] = Member::MAIN;
            $validated['character_type_id'] = $validated['character_type'];

            $characterService->checkIfMainExists($validated['status'], $member);

            $character = $characterService->createCharacter($validated, $member);
        }

        return redirect()->route('members.index', compact('clan'));
    }

    public function getInvitedUserData(Clan $clan, $token)
    {
        $member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
        if ($member) {
            return view('middleware.wait_approve');
        } else {
            $characters_type = CharactersType::all();
            return view('middleware.candidate', compact('clan', 'characters_type'));
        }
    }

    public function changeCandidateStatus(Request $request, Clan $clan, Member $member)
    {
        $decision = $request->decision;
        if ($decision === 'accept'){
            $member->syncRoles([]);
            $member->assignRole('Member');
        } elseif ($decision === 'decline'){
            $member->syncRoles([]);
            $member->assignRole('Rejected');
        }
        return redirect()->back();
    }
}
