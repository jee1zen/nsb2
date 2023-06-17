<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DateTime;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/admin/clients_management';
    public function redirectTo() {
       

            $role =Auth::user()->roles()->first(); 
            $client = Auth::user()->client;
            Auth::user()->last_login = new DateTime();
            Auth::user()->save();
         
        if($role->id==4){
        
            // return  '/client/dashboard';
            //  $checkKYC = Auth::user()->client->mainInvestmentWithKyc();
            //  dd($checkKYC);
             if($client->status==8 || $client->status==9){
           


                   if(!Auth::user()->isClientFirstLog()){

                    return 'profile/password';

                   }


                return  'client/dashboard';

             }else{

              
                return  'Client/staging';
             }

          
           
        } elseif($role->id==8 || $role->id== 9){

            $checkKYC = Auth::user()->companySignature->client->kyc;

            if($checkKYC==1){
               
                return  'client/dashboard';

             }else{

                
                return  '/';
             }


        }elseif($role->id==10){



            return 'client/dashboard';


        }
        
        else{
          
            return '/admin/clients';
        }


      
    }
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

 
}
