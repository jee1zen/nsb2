<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Gate;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        
        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role_id = auth()->user()->roles()->first()->id;

        if($role_id==4){

             $client = auth()->user()->client;
             $client->is_first = 1;
             $client->save();

            return view('auth.passwords.client_edit');
        }elseif( $role_id==10 || $role_id==8 || $role_id==9){


            return view('auth.passwords.client_edit');

        }
        
        
        else{
            return view('auth.passwords.edit');
            
        }
       
    }

    // public function update(UpdatePasswordRequest $request)
    // {
    //     auth()->user()->update($request->validated());

    //     return redirect()->route('profile.password.edit')->with('message', __('global.change_password_success'));
    // }


    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        $role_id = auth()->user()->roles()->first()->id;
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        if($role_id==1 || $role_id==3 || $role_id==5 ||  $role_id ==6 || $role_id==7 ){
            return redirect()->route('admin.clients.index')->with('message','password updated successfully');
        }else{
            return redirect()->route('client.dashboard')->with('message','password updated successfully');
        }

        
    }
}