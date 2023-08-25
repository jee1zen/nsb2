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
          
            $role =Auth::user()->roles()->first(); 
            $client = Auth::user()->client;

            if($role->id==11){
               return redirect(route('registration.staging'));
            }

            //  dd($role->id);
             if($role->id==4){
        
            // return  '/client/dashboard';
           
             if($client->status==8 || $client->status==9){
                return redirect(route('client.dashboard'));
             }else{

                return redirect(route('client.staging'));
             }

            }elseif($role->id==8 || $role->id==9){     

                $checkKYC = Auth::user()->companySignature->client->kyc;

                if($checkKYC==1){
                    // return redirect(route('client.dashboard'));
                    return redirect(route('client.dashboard'));
    
                 }else{
    
                   
                    return redirect(route('login'));
                 }
           
        }elseif($role->id==10){


            return redirect(route('client.dashboard'));

        }
        else{
            return redirect(route('admin.clients.management'));
            //return '/admin/clients_management';
        }
      }

      return $next($request);

    

    }
}