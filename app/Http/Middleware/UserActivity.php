<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserActivity
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
        auth()->user()->update(['last_activity' => date('Y-m-d H:i:s')]);
        return $next($request);
    }
}
