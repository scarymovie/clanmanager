<?php

namespace App\Http\Middleware;

use App\Models\CharactersType;
use App\Models\Member;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectToCharacters
{

    public function handle(Request $request, Closure $next)
    {
        $clan = $request->clan;
        if ($clan){
            $characters_type = CharactersType::all();
            if ($clan->members->isEmpty() && $clan->user_id === Auth::id()){
                return response()->view('middleware.no_master', compact('clan', 'characters_type'));
            } elseif ($clan->members->isEmpty() && $clan->user_id !== Auth::id()){
                return abort(404);
            }
            $member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
//            dd($member);
            if ($member){
                if ($member->characters()->get()->isEmpty() && !$member->hasRole('Candidate')){
                    return response()->view('middleware.no_characters', compact('clan', 'characters_type', 'member'));
                }
            } else {
                return response()->view('middleware.candidate', compact('clan', 'characters_type'));
            }

        }

        return $next($request);
    }
}
