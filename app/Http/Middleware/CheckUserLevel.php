<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $level
     * @return mixed
     */

    public function handle($request, Closure $next, $level)
    {
        if (!Auth::check()) {
            // If user is not logged in, redirect to login page
            return redirect('/login');
        }

        $user = Auth::user();
        if ($user->level !== $level) {
            // If user level does not match, redirect to home or error page
            return redirect('/home');
        }

        return $next($request);
    }
}
