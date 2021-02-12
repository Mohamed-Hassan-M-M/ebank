<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Blockedwithbalance
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
            toastr()->warning('You are blocked and you can only get back your balance',Auth::user()->username);
            return redirect()->route('account.index');
        }
        return $next($request);
    }
}
