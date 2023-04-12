<?php

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;
use Illuminate\Http\Request;

class NotCandidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $clan = $request->clan;
        $auth_member = Member::where('clan_id', $clan->id)->where('user_id', \Auth::id())->first();
        if ($auth_member->hasRole('Candidate')){
            return response()->view('middleware.wait_approve', compact('clan'));
        } else {
            return $next($request);
        }

    }
}
