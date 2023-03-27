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

        if ($clan->members->isEmpty()){
            $characters_type = CharactersType::all();
            $member = Member::where('clan_id', $clan->id)->where('user_id', Auth::id())->first();
            return response()->view('middleware.no_characters', compact('clan', 'characters_type', 'member'));
        }
        return $next($request);
    }
}
