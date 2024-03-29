<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClansStoreRequest;
use App\Models\CharactersType;
use App\Models\Clan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClansController extends Controller
{

    public function index()
    {
        $clans = Clan::all();
        return view('clans.index', compact('clans'));
    }

    public function create()
    {
        return view('clans.create');
    }

    public function store(ClansStoreRequest $clansStoreRequest)
    {
        $validated = $clansStoreRequest->validated();

        $clan = Clan::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'invite_link' => Str::random(32)
        ]);

        return redirect()->route('clans.show', compact('clan'));
    }

    public function show(Clan $clan)
    {
        $member = $clan->members->firstWhere('user_id', Auth::id());
        return view('clans.show', compact(['clan', 'member']));
    }

    public function edit(Clan $clan)
    {
        //
    }

    public function update(Request $request, Clan $clan)
    {
        //
    }

    public function destroy(Clan $clan)
    {
        //
    }

    public function setNewInviteLink(Clan $clan)
    {
        $clan->update(['invite_link' => Str::random(32)]);
        return redirect()->back();
    }

}
