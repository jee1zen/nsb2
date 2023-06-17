<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ValidationController extends Controller
{

    public function userEmailvalidation(Request $request){

        $check = User::where('email','=',$request->email)->count();
        if($check>0){

            $send['state'] = false;

        }else{

            $send['state'] = true;
        }


        return response()->json($send);
    }


    

}
