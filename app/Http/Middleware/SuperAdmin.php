<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
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
        if (Auth::guard('admin')->user()->super_admin == 1) {
            return $next($request);
        }
        toastr()->warning('You are not allowed to view this page.','Super admin say,');
        return redirect()->route('admin.dashboard');
        return $next($request);
    }
}
