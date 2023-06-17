<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InquriesController extends Controller
{
    public function inquiries(){

        $inquries = Inquiry::all();

      



        return view('admin.inquiries.index',compact('inquries'));

    }

    public function inquirieShow($id){

        $inquiry =  Inquiry::find($id);


        return view('admin.inquiries.show',compact('inquiry'));
    }    
}
