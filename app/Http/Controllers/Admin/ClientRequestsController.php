<?php

namespace App\Http\Controllers\Admin;

use App\BidSet;
use App\Http\Controllers\Controller;
use App\Investment;
use App\ReverseRepo;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClientRequestsController extends Controller
{
    public function allRequests(){


        // $today = Carbon::today()->toDateString();
        // $newInvestments = Investment::where('is_main',0)->where('status','!=',-100)->whereBetween('created_at', [$today." 00:00:00", $today." 23:59:59"])->get();
        // $maturityInstruction = Withdraw::where('status','!=',-100)->whereBetween('created_at', [$today." 00:00:00", $today." 23:59:59"])->get();
        // $reverseRepo = ReverseRepo::where('status','!=',-100)->whereBetween('created_at', [$today." 00:00:00", $today." 23:59:59"])->get();
        $newInvestments='';
        $maturityInstruction='';
        $reverseRepo ='';
        $bidsets='';

       return view('admin.clients.allRequests',compact('newInvestments','maturityInstruction','reverseRepo','bidsets'));




    }
    public function allRequestsFilter(Request $request){


        $today = Carbon::today()->toDateString();

        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $type = $request->type;

        $newInvestments='';
        $maturityInstruction='';
        $reverseRepo ='';
        $bidsets ='';

         if($type==1){

            $newInvestments = Investment::where('is_main',0)->where('status','>=',0)->whereBetween('created_at', [$fromDate." 00:00:00", $toDate." 23:59:59"])->get();
         }

         if($type==2){
            $maturityInstruction = Withdraw::where('status','>=',0)->whereBetween('created_at', [$fromDate." 00:00:00", $toDate." 23:59:59"])->get();

         }

         if($type==3){
            $reverseRepo = ReverseRepo::where('status','>=',0)->whereBetween('created_at', [$fromDate." 00:00:00", $toDate." 23:59:59"])->get();
           
            
        }

        if($type==4){

            $bidsets = BidSet::where('status','>=',0)->whereBetween('created_at', [$fromDate." 00:00:00", $toDate." 23:59:59"])->get();


        }


        $parameters =[
            'fromDate'=>$fromDate,
            'toDate'=>$toDate,
            'type'=>$type,
        ];



       return view('admin.clients.allRequests',compact('newInvestments','parameters','maturityInstruction','reverseRepo','bidsets'));




    }
}