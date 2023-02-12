<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClansController extends Controller
{
    public function __construct()
    {
        $this->middleware('clan', ['except' => ['index', 'create', 'store']]);
    }

    public function index()
    {
        $clans = Clan::all();
        return view('clans.index', compact('clans'));
    }

    public function create()
    {
        return view('clans.create');
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $clan = Clan::create([
            'user_id' => Auth::id(),
            'title' => $title
        ]);
        return redirect()->route('clan.show', compact('clan'));
    }

    public function show(Clan $clan)
    {
        return view('clans.show', compact('clan'));
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
