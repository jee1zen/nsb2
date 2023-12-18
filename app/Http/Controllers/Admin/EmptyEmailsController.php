<?php

namespace App\Http\Controllers\Admin;

use App\EmptyEmail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmptyEmailsController extends Controller
{
    
    public function index(Request $request){

        $today = Carbon::today()->toDateString();
        if (count($request->all()) === 0) {
            $fromDate = $today;
            $toDate = $today;
        } else {
            $fromDate = $request->fromDate;
            $toDate = $request->toDate;
        }
      
    
        $emptyRecords = EmptyEmail::whereBetween('created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])->get();
        $parameters =[
            'fromDate'=>$fromDate,
            'toDate'=>$toDate,
        ];
      

        return view('admin.csv.empty', compact('emptyRecords','parameters'));

        
    }
}