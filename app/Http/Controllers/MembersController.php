<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
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

        if ($validated['rank'] === 'Мастер'){
            Member::checkIfMasterNotExist($clan);
        }

        $member = Member::create([
            'clan_id' => $clan->id,
            'user_id' => $validated['user_id'] ?? null,
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


    public function createMaster(Request $request, Clan $clan)
    {
        $validated = $request->all();
        $validated['clan_id'] = $clan->id;

        if (Member::checkIfMasterNotExist($clan)){
            $member = Member::create([
                'clan_id' => $validated['clan_id'],
                'user_id' => Auth::id(),
                'nickname' => $validated['nickname'],
                'rank' => 'Мастер'
            ]);
        }

        return redirect()->route('members', compact('clan'));
    }
}
