<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->roles()->first();
            

            // dd($user->role_id);
            if ($role->id == 1 || $role->id == 5 || $role->id == 6 || $role->id == 7) {

                return $next($request);
            } else {
                Auth::logout();
                // abort(403, 'Wrong Accept Header');
                return   redirect('/');
            }
        }
    }
}
