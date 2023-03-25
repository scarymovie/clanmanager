<?php

namespace App\Http\Middleware;

use App\Models\CharactersType;
use Closure;
use Illuminate\Http\Request;

class RedirectToCharacters
{

    public function handle(Request $request, Closure $next)
    {
        $clan = $request->clan;
        if ($clan->members->isEmpty()){
            $characters_type = CharactersType::all();
            return response()->view('middleware.no_characters', compact('clan', 'characters_type'));
        }
        return $next($request);
    }
}
