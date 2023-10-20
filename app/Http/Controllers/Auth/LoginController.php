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
    public function redirectTo()
    {





        $role = Auth::user()->roles()->first();
        // dd($role->id);

        if ($role->id == 11) {
            Auth::user()->last_login = new DateTime();
            Auth::user()->save();


            return 'registration/staging';
        } elseif ($role->id == 4) {


            Auth::user()->last_login = new DateTime();
            Auth::user()->save();



            return  'client/dashboard';
        } else {
            // dd("came here");
            Auth::user()->last_login = new DateTime();
            Auth::user()->save();


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