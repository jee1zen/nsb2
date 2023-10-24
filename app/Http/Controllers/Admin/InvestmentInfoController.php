<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Client;
use App\Http\Controllers\Controller;
use App\Investment;
use App\KYCForm;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InvestmentInfoController extends Controller
{
    
    public function index(){
        
        $today = Carbon::today()->toDateString();
        $before = Carbon::now()->subDays(30);
        $investments = Investment::where('is_main',0)->where('status','=',2)->orWhere('status',3)->whereBetween('created_at', [$before." 00:00:00", $today." 23:59:59"])->get();
       


       return view('admin.investmentInfo.index',compact('investments'));

        
    }
    public function filter(Request $request){
        
      $today = Carbon::today()->toDateString();
      $before = Carbon::now()->subDays(30);

      $fromDate = $request->fromDate;
      $toDate = $request->toDate;



      $investments = Investment::where('is_main',0)->where('status','=',2)->orWhere('status',3)->whereBetween('created_at', [$fromDate." 00:00:00", $toDate." 23:59:59"])->get();
     


     return view('admin.investmentInfo.index',compact('investments','fromDate','toDate'));

      
  }
 public function client($id){

    $account = Account::findOrFail($id);
    $client = $account->client;
   
    return view('admin.investmentInfo.client',compact('client','account'));



 }
 public function investment($id,$investment_id){

   $client = Client::findOrFail($id);
   $investment = Investment::findOrFail($investment_id);
   $totalRiskRate = 0;
   $rateLabel="Unrated";
   $rateColor="light";
   //risk calculation..


if($investment->hasKyc()){
   if($client->client_type==1){  
            $type_rate = 0.05;
        }elseif($client->client_type==2){
            $type_rate = 0.10;
        }else{
            $type_rate = 0.15;
        }

        $kyc = $investment->kyc()->first();
        




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



   

   return view('admin.investmentInfo.investment',compact('client','investment','totalRiskRate','rateLabel'));



}



public function kyc($id,$investment_id){


      $kyc = KYCForm::where('account_id',$id)->where('investment_id',$investment_id)->latest()->first();
      $account = Account::findOrFail($id);
      $client =  $account->client;
      $investment = Investment::find($investment_id);

      

      return view('admin.investmentInfo.kyc',compact('client','investment','investment_id','kyc','account','id'));


}


}