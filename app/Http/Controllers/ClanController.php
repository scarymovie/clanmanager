<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClanController extends Controller
{

    public function index()
    {
        $clans = Clan::where('user_id', Auth::id())->get();
        return view('clan.index', compact('clans'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $clan = Clan::create([
            'user_id' => Auth::id(),
            'title' => $title
        ]);
        return redirect()->back();
    }

    public function show(Clan $clan)
    {
        return view('clan.show', compact('clan'));
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

}
