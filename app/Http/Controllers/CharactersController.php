<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterStoreRequest;
use App\Models\Character;
use App\Models\CharactersType;
use App\Models\Clan;
use App\Models\Member;
use App\Models\User;
use App\Service\CharacterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharactersController extends Controller
{

    public function index(Clan $clan)
    {
        $member = Member::where('clan_id', $clan->id)
            ->where('user_id', Auth::id())
            ->first();
        $characters = [];
        if ($member != null){
            $characters = Character::where('member_id', $member->id)->orderBy('status')->with('type')->get();
        }


        return view('characters.index', compact('clan', 'characters', 'member'));
    }

    public function create(Clan $clan)
    {
        $characters_type = CharactersType::all();
        $member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
        return view('characters.create', compact('clan', 'characters_type', 'member'));
    }

    public function store(CharacterStoreRequest $characterStoreRequest, Clan $clan, Member $member, CharacterService $characterService)
    {
        try {
            $validated = $characterStoreRequest->validated();

            $characterService->checkIfMainExists($validated['status'], $member);

            $character = $characterService->createCharacter($validated, $member);
        } catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('characters.index', compact('clan'));
    }

    public function show(Character $character)
    {
        //
    }

    public function edit(Clan $clan, Character $character)
    {
        $characters_type = CharactersType::all();
        $member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
        return view('characters.edit', compact(['character', 'clan', 'characters_type', 'member']));
    }

    public function update(CharacterStoreRequest $characterStoreRequest, Clan $clan, Character $character, CharacterService $characterService)
    {
        try {
            $validated = $characterStoreRequest->validated();
            $member = $character->member()->first();
            $characterService->checkIfMainExists($validated['status'],$member);
            $character->updateOrFail([
                'nickname' => $validated['nickname'],
                'status' => $validated['status'],
                'character_type_id' => $validated['character_type'],
                'link' => $validated['link'] ?: '',
                'member_id' => $character->member_id,
            ]);
        } catch (\Throwable $exception){
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->back()->with('message', 'Успешно');
    }

    public function destroy(Clan $clan, Character $character)
    {
        $character->delete();
        return redirect()->back()->with('message', 'Успешно');
    }

    public function createNewbie(CharacterStoreRequest $characterStoreRequest, Clan $clan, CharacterService $characterService)
    {
        $validated = $characterStoreRequest->validated();
        $member = Member::create([
            'clan_id' => $clan->id,
            'user_id' => Auth::id(),
            'rank' => 'заявка в клан'
        ]);
        $character = $characterService->createCharacter($validated, $member);
        $member->assignRole('Candidate');
        return view('middleware.wait_approve');
    }
}
