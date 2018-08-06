<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class userTypeCorP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->check() || Auth::guard('pharmacist')->check())
        return $next($request);
    }
}
