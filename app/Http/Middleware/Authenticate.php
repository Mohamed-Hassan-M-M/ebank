<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {//if you are not auth with no ajax
            if(Request::is('admin*')){
                return route('admin.login');
            }
            elseif(Request::is('user*')){
                return route('user.login');//
            }
            else{
                return route('website.home');
            }
        }
    }
}
