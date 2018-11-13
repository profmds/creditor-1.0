<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->check() && Auth::user()->type == 'admin') {
            return redirect('/dashboard');
            //return $next($request);
        } else if (Auth::guard($guard)->check() && Auth::user()->type == 'teachers') {
            return redirect('/classroom');
            //return $next($request);
        } else {

        }


        return redirect('/home');
    }
}
