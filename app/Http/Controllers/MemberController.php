<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function index(Clan $clan)
    {
        $members = Member::where('clan_id', $clan->id)->get();
        return view('members.index', compact('members', 'clan'));
    }

    public function create(Clan $clan)
    {
        return view('members.create', compact('clan'));
    }

    public function store(Request $request, Clan $clan)
    {
        $validated = $request->all();
        $member = Member::create([
            'clan_id' => $clan->id,
            'user_id' => null,
            'nickname' => $validated['nickname'],
            'rank' => $validated['rank']
            ]);

        return redirect()->back();
    }

    public function show(Request $request, member $member)
    {
        $members = Member::where();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $member = Member::find($request->member);
        $member->delete();
        return redirect()->back();
    }
}
