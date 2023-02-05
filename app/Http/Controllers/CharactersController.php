<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterStoreRequest;
use App\Http\Requests\ChatacterStoreRequest;
use App\Models\Character;
use App\Models\CharactersType;
use App\Models\Clan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharactersController extends Controller
{

    public function index(Clan $clan)
    {

        return view('characters.index', compact('clan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Clan $clan)
    {
        $characters_type = CharactersType::all();
        return view('characters.create', compact('clan', 'characters_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacterStoreRequest $characterStoreRequest)
    {
        try {
            $validated = $characterStoreRequest->validated();
            $character = Character::create([
                'nickname' => $validated['nickname'],
                'status' => $validated['status'],
                'character_type_id' => $validated['character_type'],
                'link' => $validated['link'],
                'note' => $validated['note'] ?? '',
                'user_id' => Auth::id()
            ]);
        } catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->back()->with(['success' => 'Успешно']);
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
    public function update(Request $request, Character $character)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        //
    }
}
