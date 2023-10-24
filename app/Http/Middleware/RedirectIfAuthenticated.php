<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  $guard
   * @return mixed
   */
  public function handle($request, Closure $next, $guard = null)
  {
    if (Auth::guard($guard)->check()) {

      $role = Auth::user()->roles()->first();

      // $client = Auth::user()->client;

      if ($role->id == 11) {
        return redirect(route('registration.staging'));
      } elseif ($role->id == 4) {




        return redirect(route('client.dashboard'));
      } else {
        return redirect(route('admin.clients.management'));
        //return '/admin/clients_management';
      }
    }

    return $next($request);
  }
}