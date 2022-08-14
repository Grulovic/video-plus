<?php

namespace App\Http\Middleware;

use App\Models\BlockedUser;
use Closure;
use Illuminate\Http\Request;

class BlockedUsersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (BlockedUser::where('ip_address',$request->ip())->first()) {
            abort(403, "You are restricted to access the site.");
        }

        if (auth()->user() && auth()->user()->isBlocked()) {
            abort(403, "You are restricted to access the site.");
        }

        return $next($request);
    }
}
