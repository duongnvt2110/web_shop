<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LastActivity
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
            if (!Auth::check()) {
                return $next($request);
            }

            $user = Auth::user();
            $user->update([
                'last_activity' => Carbon::now(),
            ]);

            return $next($request);

    }
}
