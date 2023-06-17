<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Otp;
use Illuminate\Http\Request;

class OTPViewController extends Controller
{
    public function index(){

        $otps=Otp::all();

        return view('admin.liveOtp.index', compact('otps'));


        
    }
}