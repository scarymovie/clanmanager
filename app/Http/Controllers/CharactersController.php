<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterStoreRequest;
use App\Models\Character;
use App\Models\CharactersType;
use App\Models\Clan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharactersController extends Controller
{

    public function index(Clan $clan)
    {
        $member = Member::where('clan_id', $clan->id)
            ->where('user_id', Auth::id())
            ->first();

        $characters = Character::where('member_id', $member->id)->orderBy('status')->with('type')->get();

        return view('characters.index', compact('clan', 'characters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Clan $clan)
    {
        $characters_type = CharactersType::all();
        $member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
        return view('characters.create', compact('clan', 'characters_type', 'member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacterStoreRequest $characterStoreRequest, Clan $clan)
    {
        try {
            $validated = $characterStoreRequest->validated();
            $character = Character::create([
                'nickname' => $validated['nickname'],
                'status' => $validated['status'],
                'character_type_id' => $validated['character_type'],
                'link' => $validated['link'],
                'note' => $validated['note'] ?? '',
                'member_id' => $validated['member_id'],
            ]);
        } catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->back()->with('message', 'Успешно');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $character)
    {
        //
    }

    public function destroyAll(Clan $clan, Character $character)
    {
        $character->delete();
        return redirect()->back()->with('message', 'Успешно');
    }
}
