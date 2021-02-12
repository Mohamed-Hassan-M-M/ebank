<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Blocked
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
        if(Auth::check() && Auth::user()->status == 0 && Auth::user()->balance <= 0){
            Auth::guard('web')->logout();
            toastr()->warning('You are blocked and you can not use our services');
            return redirect('/');
        }
        return $next($request);
    }
}
