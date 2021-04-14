<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Session;

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
        if($request->route()->getName()=='parties'){
            $path=$request->path();
            $groupId= substr($path, strpos($path, "/") + 1);
            Session::put('join',$groupId);
        }

        if (! $request->expectsJson()) {
            return route('signin');
        }
    }
}
