<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        //dd(Auth::user()->phone);
        if (Auth::guard($guard)->check()) {
            if ($guard == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                //return redirect()->route('user.home');
                if (Auth::user()->phone === "0123456789") { //extra
                    return redirect()->intended(route('thank.you'));
                } else {
                    return redirect()->intended(route('user.home'));
                }
            }
        }

        return $next($request);
    }
}
