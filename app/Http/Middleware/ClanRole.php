<?php

namespace App\Http\Middleware;

use App\Models\Clan;
use App\Models\Member;
use Closure;
use Illuminate\Http\Request;

class ClanRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        $clan = $request->clan;
        $member = Member::where('clan_id', $clan->id)->where('user_id', \Auth::id())->first();
        if ($member->hasAnyRole($role)){
            return $next($request);
        } else {
            return abort(404);
        }

    }
}
