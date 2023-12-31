<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$guard=null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->roles()->first();

            // dd($user->role_id);
            if ($role->id == 11) {

                return $next($request);
            } else {
                Auth::logout();
                // abort(403, 'Wrong Accept Header');
                return   redirect('/');
            }
        
    }
}
}