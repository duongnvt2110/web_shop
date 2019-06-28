<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Administrator
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
        // if(auth()->user() && auth()->user()->isAdmin()){
        //     return $next($request);
        // }
        if(Auth::guard('admin')->user()){
            dd('test');
            return $next($request);
        }
        abort(403,"You don't have permission to perform this action");
    }
}
