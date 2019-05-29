<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;
class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request, Closure $next)
    {
        if (!Sentinel::check()) {
           return redirect()->route('login')->withErrors('Bạn phải đăng nhập');
        }
        return $next($request);
    }
}
