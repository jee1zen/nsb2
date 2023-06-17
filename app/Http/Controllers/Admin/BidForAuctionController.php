<?php

namespace App\Http\Controllers\Admin;

use App\Bid;
use App\BidForAuction;
use App\Bidprocess;
use App\BidSet;
use App\Http\Controllers\Controller;
use App\Investment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidForAuctionController extends Controller
{
    public function index(){

       $bid = BidForAuction::find(1);

     

       return view('admin.bidForAuction.index',compact('bid'));


    }
    public function post(Request $request){

        $destinationPath = storage_path('app/public/uploads/');
        $bid = BidForAuction::find(1);
        $deleteBidDoc1 = $bid->doc1;

        if ($request->file('doc1') != '') {
            $doc1 = $request->file('doc1');
            $doc1_edit = time() . '_' . $doc1->getClientOriginalName();
            if ($doc1->move($destinationPath, $doc1_edit)) {



                $bid->doc1 = $doc1_edit;
                $bid->save();

              if($deleteBidDoc1!=null){
                unlink(storage_path('app/public/uploads/' . $deleteBidDoc1));
              }
            }
        }

        $deleteBidDoc2 = $bid->doc2;
        if ($request->file('doc2') != '') {
            $doc2 = $request->file('doc2');
            $doc2_edit = time() . '_' . $doc2->getClientOriginalName();
            if ($doc2->move($destinationPath, $doc2_edit)) {



                $bid->doc2 = $doc2_edit;
                $bid->save();

              if($deleteBidDoc2!=null){
                unlink(storage_path('app/public/uploads/' . $deleteBidDoc2));
              }
            }
        }

     return back();

    }
    public function bids(){

      $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();

        if ($officer_role->id == 5) {

            $bids = BidSet::where('status', '=', 0)->get();
        } elseif ($officer_role->id == 6) {

            $bids = BidSet::where('status', '=', 0)->get();
        } elseif ($officer_role->id == 7) {

            $bids = BidSet::where('status', '=', 1)->get();
        } else {

            $bid = '';
        }




        return view('admin.bids.index', compact('bids', 'officer_role'));


    }

    public function bidShow($id){

      $officer = Auth::user();
      $officer_role = Auth::user()->roles()->first();

      $bid = BidSet::findOrFail($id);
     


      return view('admin.bids.show', compact('bid','officer_role'));

    }


    public function bidProcess(Request $request){
      
      DB::beginTransaction();
      try {
      $officer = Auth::user();
      $officer_role = Auth::user()->roles()->first();


      $client_id = $request->client_id;
      $request_type = $request->request_type;
      $request_comment = $request->request_comment;
      $bid_id = $request->bid_id;

      $bid = BidSet::findOrFail($bid_id);


      $prev_state = $bid->status;
      if($request_type==0){


        $bid->status = -100;
      }else{
        $bid->status = $bid->status + $request_type;

      }

 
      $bid->save();

      Bidprocess::create([
          'bid_id' => $bid_id,
          'user_id' => $officer->id,
          'client_id' => $client_id,
          'previous_state' => $prev_state,
          'current_state' => $prev_state + $request_type,
          'comment' => $request_comment

      ]);

      
      DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        return $e->getMessage();
    }




      $bid = BidSet::findOrFail($bid_id);

      if($request_type==0){

         return $this->bids();
      }else{

        return view('admin.bids.show', compact('bid', 'officer_role'));
      }
      



    }

    public function bidForAuctionInfo(Request $request){

          $today = Carbon::today()->toDateString();


          if(isset($request)){

            $fromDate = $request->fromDate;
            $toDate = $request->toDate;
  
          }else{
            $fromDate = $request->today;
            $toDate = $request->today;
          }

       


          $bidsets = BidSet::where('status','>=',0)->whereBetween('created_at', [$fromDate." 00:00:00", $toDate." 23:59:59"])->get();

          $parameters =[
            'fromDate'=>$fromDate,
            'toDate'=>$toDate,
          
        ];



      return view('admin.BidInfo.index',compact('bidsets'));

      
    }

    public function bidForAuctionApplication($id){

      $bidSet = BidSet::findOrFail($id);
      $client = $bidSet ->client;
      $kyc  = $client->kyc()->where('investment_id',0)->first();
      $totalRiskRate = 0;
      $rateLabel="Unrated";
      $rateColor="light";
      //risk calculation..
   

   if($kyc!=null){
      if($client->client_type==1){  
               $type_rate = 0.05;
           }elseif($client->client_type==2){
               $type_rate = 0.10;
           }else{
               $type_rate = 0.15;
           }
   
       
           
   
   
   
   
           if($client->client_type!=3){  
           //ownership..
                   if($kyc->kyc_ownership_of_premises=='Owner' || $kyc->kyc_ownership_of_premises=="Parent's"){
                       $ownership_rate = 0.05;
                   }elseif($kyc->kyc_ownership_of_premises=="Lease/Rent" || $kyc->kyc_ownership_of_premises=="Official"){
                       $ownership_rate = 0.10;
                   }else{
                       $ownership_rate = 0.15;
                   }
   
           
                   
                   //citizenship and residence..
                   if($kyc->kyc_citizenship=='Sri Lankan' && $kyc->kyc_residence=="Resident in Sri Lanka"){
                       $citizenship_rate = 0.05;
                   }elseif($kyc->kyc_citizenship=="Sri Lankan" &&  $kyc->kyc_residence=="Non-Resident"){
                       $citizenship_rate = 0.10;
                   }elseif($kyc->kyc_citizenship=="Sri Lankan with dual citizenship"){
                       $citizenship_rate = 0.10;
                   }else{
                       $citizenship_rate = 0.15;
                   }
   
                   //purpose of opening account
   
                   if($kyc->kyc_purpose_of_opening_account=="Employment/Professional income"){
                       $purpose_rate = 0.20;
                   }elseif($kyc->kyc_purpose_of_opening_account=="Savings" || 
                   $kyc->kyc_purpose_of_opening_account=="Investment purposes" ||
                   $kyc->kyc_purpose_of_opening_account=="Remittances" ){
                       $purpose_rate = 0.0;
                   }else{
                       $purpose_rate = 0.60;
                   }
   
   
                   // source of fund
   
                   if($kyc->kyc_source_of_funds=="Salary/Profit/Professional Income"){
                       $source_rate = 0.25;
                   
                   }elseif($kyc->kyc_source_of_funds=="Sales and Business Turnover" || 
                   $kyc->kyc_source_of_funds=="Sale of Property/Assets" ||
                   $kyc->kyc_source_of_funds=="Sales and Business Turnover" ||
                   $kyc->kyc_source_of_funds =="Rent Income" ||
                   $kyc->kyc_source_of_funds =="Remittances" ||
                   $kyc->kyc_source_of_funds =="Investment Proceeds" ||
                   $kyc->kyc_source_of_funds =="Export Proceeds" ){
                       $source_rate = 0.50;
                   
                   }else{
                       $source_rate = 0.75;
                   
                   }
   
               // volunme...
               if($kyc->kyc_anticipated_volume=="Less than Rs.200,000 (or equivalent FC value)" ||
               $kyc->kyc_anticipated_volume=="Rs.200,001 to Rs.500,000 (or equivalent FC value)"){
               $volume_rate = 0.20;
               
                   }elseif($kyc->kyc_anticipated_volume=="Rs.500,001 to Rs.1,000,000 (or equivalent FC value"){
                       $volume_rate = 0.20;
                   }else{
                       $volume_rate = 0.30;
                   
                   }
   
               //mode of transaction..
               if($kyc->kyc_expected_mode_of_transacation=="Cheque" ||
               $kyc->kyc_expected_mode_of_transacation=="Standing Orders"){
               $mode_rate = 0.15;
               
               }elseif($kyc->kyc_expected_mode_of_transacation=="Cash"){
                   $mode_rate = 0.30;
               }else{
                   $mode_rate = 0.45;
               }    
   
   
               //relationship rate
               if($kyc->kyc_relationship=='Existing customer (more than 5 years)'){
                   $relationship_rate = 0.05;
               }elseif($kyc->kyc_relationship=='Existing customer (1 to 5 years)'){
                   $relationship_rate = 0.10;
               }else{
                   $relationship_rate = 0.15;
               }
   
               //pep rate
               if($kyc->kyc_pep=='Yes'){
                   $pep_rate = 0.05;
               }else{
                   $pep_rate = 0;
               }
   
               $indentification_rate = 0.10;
   
   
               $totalRiskRate = $type_rate+$citizenship_rate+$purpose_rate+$source_rate+$volume_rate+$mode_rate+$relationship_rate+$pep_rate+ $indentification_rate ;
           //  dd($totalRiskRate);
               if($kyc->risk_rate!=null){
               if($kyc->risk_rate=="HIGH"){
                   $rateLabel = "HIGH";
                   $rateColor = "danger";
               }elseif($kyc->risk_rate=="MEDIUM"){
                   $rateLabel = "MEDIUM";
                   $rateColor = "warning";
               }elseif($kyc->risk_rate=="LOW"){
                   $rateLabel = "LOW";
                   
                   $rateColor = "secondary";
               }else{
   
               }
   
               }else{
   
   
   
               if($totalRiskRate<3 && $totalRiskRate> 2.4){
   
                   $rateLabel = "HIGH";
                   $rateColor = "danger";
   
               }elseif($totalRiskRate<2.33 && $totalRiskRate > 1.67){
                   $rateLabel = "MEDIUM";
                   $rateColor = "warning";
   
               }elseif($totalRiskRate<1.66 && $totalRiskRate > 1.00){
   
                   $rateLabel = "LOW";
                   
                   $rateColor = "secondary";
               }else{
   
               }
   
               }


               
           }  
        }
     

   return view('admin.BidInfo.show',compact('client','bidSet','totalRiskRate','rateLabel'));

    }


}