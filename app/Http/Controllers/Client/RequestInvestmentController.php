<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Investment;
use App\InvestmentType;
use App\JointInvestmentApproval;
use App\KYCForm;
use App\KYCJointForm;
use App\NewInvestmentProcess;
use Illuminate\Http\Request;
use Auth;

class RequestInvestmentController extends Controller
{
    public function index(){

        $client = Auth::user()->client;
        $selectedAccount = $client->selectedAccount;
        $account = $selectedAccount->account;

        $investmentTypes = InvestmentType::all();
        $bankAccounts = $account->bankParticulars()->get();
        


        return view('client.newInvestment.add',compact('client','investmentTypes','bankAccounts','account'));
        


    }
    public function post(Request $request){

        $client = Auth::user()->client;
        $selectedAccount = $client->selectedAccount;
        $account = $selectedAccount->account;

        


        $type = $request->investment_type;

       
           $investment =Investment::create([
                'client_id'=>$client->id,
                'account_id' => $account->id,
                'investment_type_id'=>$type,
                'amount'=>str_replace(",", "",$request->amount ),
                'value_date'=>$request->value_date,
                'maturity_date'=>$request->maturity_date,
                'instruction' =>$request->instruction,
                'bank_id'=>$request->bank_id,
                'status'=>-100,

            ]);

            if($client->investmentCount()==1 && $client->hasClientKYC($account->id)){

                  $kyc = new KYCForm;
                  $clientKYC = $client->clientKYC($account->id);

                  $kyc->client_id = $client->id;
                  $kyc->account_id = $account->id;
                  $kyc->investment_id = $investment->id;
                  $kyc->kyc_account_at_NSB_FMC = $clientKYC->kyc_account_at_NSB_FMC;
                  $kyc->kyc_ownership_of_premises = $clientKYC->kyc_ownership_of_premises;
                  $kyc->kyc_foreign_address = "";
                  $kyc->kyc_citizenship = $clientKYC->kyc_citizenship;
                  $kyc->kyc_residence = $clientKYC->kyc_residence;
                  $kyc->kyc_country_of_birth = $clientKYC->kyc_country_of_birth;
                  $kyc->kyc_country_of_residence = $clientKYC->kyc_country_of_residence;
                  $kyc->kyc_nationality = $clientKYC->kyc_nationality;
                  $kyc->kyc_type_of_visa = $clientKYC->kyc_type_of_visa;
                  $kyc->kyc_other_visa_type = $clientKYC->kyc_other_visa_type;
                  $kyc->kyc_expiry_date = $clientKYC->kyc_expiry_date;
                  $kyc->kyc_purpose_account_foreign = $clientKYC->kyc_purpose_account_foreign;
                  $kyc->kyc_purpose_of_opening_account = $clientKYC->kyc_purpose_of_opening_account;
                  $kyc->kyc_other_purpose = $clientKYC->kyc_other_purpose;
                  $kyc->kyc_source_of_funds = $clientKYC->kyc_source_of_funds;
                  $kyc->kyc_other_source = $clientKYC->kyc_other_source;
                  $kyc->kyc_anticipated_volume = $clientKYC->kyc_anticipated_volume;
                  $kyc->kyc_expected_mode_of_transacation = $clientKYC->kyc_expected_mode_of_transacation;
                  $kyc->kyc_other_connected_businesses = $clientKYC->kyc_other_connected_businesses;
                  $kyc->kyc_expected_types_of_counterparties = $clientKYC->kyc_expected_types_of_counterparties;
                  $kyc->kyc_operation_authority = $clientKYC->kyc_operation_authority;
                  $kyc->kyc_other_name= $clientKYC->kyc_other_name;
                  $kyc->kyc_other_address = $clientKYC->kyc_other_address;
                  $kyc->kyc_other_nic = $clientKYC->kyc_other_nic;
                  $kyc->kyc_relationship=$clientKYC->kyc_relationship;
                  $kyc->kyc_pep = $clientKYC->kyc_pep;
                  $kyc->kyc_us_person = $clientKYC->kyc_us_person;
                  $kyc->kyc_employment_status = $clientKYC->kyc_employment_status;
                  $kyc->kyc_other_employement = $clientKYC->kyc_other_employement;
                  $kyc->kyc_nature_of_business = $clientKYC->kyc_nature_of_business;
                  $kyc->kyc_nature_of_business_specify = $clientKYC->kyc_nature_of_business_specify;
                  $kyc->kyc_marital_status = $clientKYC->kyc_marital_status;
                  $kyc->kyc_spouse_name = $clientKYC->kyc_spouse_name;
                  $kyc->kyc_spouse_job = $clientKYC->kyc_spouse_job;
                  $kyc->save();

                  if($account->type==2){

                        if($account->hasJointHolders()){

                            foreach($account->jointHolders()->get() as $jointHolder)

                            $jointKYC = KYCJointForm::where('joint_id',$jointHolder->id)->where('investment_id',0)->first();

                            if($jointKYC!=null){


                                $newJointKyc = new KYCJointForm;
                                $newJointKyc->joint_id = $jointHolder->id;
                                $newJointKyc->investment_id = $investment->id;
                                $newJointKyc->kyc_account_at_NSB_FMC = $jointKYC->kyc_account_at_NSB_FMC;
                                $newJointKyc->kyc_ownership_of_premises = $jointKYC->kyc_ownership_of_premises;
                                $newJointKyc->kyc_foreign_address = "";
                                $newJointKyc->kyc_citizenship = $jointKYC->kyc_citizenship;
                                $newJointKyc->kyc_residence = $jointKYC->kyc_residence;
                                $newJointKyc->kyc_country_of_birth = $jointKYC->kyc_country_of_birth;
                                $newJointKyc->kyc_country_of_residence = $jointKYC->kyc_country_of_residence;
                                $newJointKyc->kyc_nationality = $jointKYC->kyc_nationality;
                                $newJointKyc->kyc_type_of_visa = $jointKYC->kyc_type_of_visa;
                                $newJointKyc->kyc_other_visa_type = $jointKYC->kyc_other_visa_type;
                                $newJointKyc->kyc_expiry_date = $jointKYC->kyc_expiry_date;
                                $newJointKyc->kyc_purpose_account_foreign = $jointKYC->kyc_purpose_account_foreign;
                                $newJointKyc->kyc_purpose_of_opening_account = $jointKYC->kyc_purpose_of_opening_account;
                                $newJointKyc->kyc_other_purpose = $jointKYC->kyc_other_purpose;
                                $newJointKyc->kyc_source_of_funds = $jointKYC->kyc_source_of_funds;
                                $newJointKyc->kyc_other_source = $jointKYC->kyc_other_source;
                                $newJointKyc->kyc_anticipated_volume = $jointKYC->kyc_anticipated_volume;
                                $newJointKyc->kyc_expected_mode_of_transacation = $jointKYC->kyc_expected_mode_of_transacation;
                                $newJointKyc->kyc_other_connected_businesses = $jointKYC->kyc_other_connected_businesses;
                                $newJointKyc->kyc_expected_types_of_counterparties = $jointKYC->kyc_expected_types_of_counterparties;
                                $newJointKyc->kyc_operation_authority = $jointKYC->kyc_operation_authority;
                                $newJointKyc->kyc_other_name= $jointKYC->kyc_other_name;
                                $newJointKyc->kyc_other_address = $jointKYC->kyc_other_address;
                                $newJointKyc->kyc_other_nic = $jointKYC->kyc_other_nic;
                                $newJointKyc->kyc_relationship=$jointKYC->kyc_relationship;
                                $newJointKyc->kyc_pep = $jointKYC->kyc_pep;
                                $newJointKyc->kyc_us_person = $jointKYC->kyc_us_person;
                                $newJointKyc->save();



                            }

                            
            




                        }




                  }



            }




        
       
        return redirect()->route('client.investment.form',$investment->id);


    }



    public function form($id){


    $client = Auth::user()->client; 
  
    $investment =Investment::findOrFail($id);
    $account = $investment->account;




    return view('client.newInvestment.new',compact('client','investment','account'));
    }   


    public function formPost(Request $request,$id){

        $user = Auth::user();


         $investment = Investment::find($id);
         $account  = $investment->account;
        //  $investment->amount = $request->amount;
        //  $investment->status = 1;
        //  $investment->save();
        if($account->type==2 && $account->joint_permission==1){


            $count = $account->jointHolders()->count();
            $status = -$count;
            $investment->status =  $status;
            $investment->save();

            foreach($account->jointHolders()->get() as $jointHolder){
                $approval = new JointInvestmentApproval;
                $approval->investment_id = $investment->id;
                $approval->joint_holder_id = $jointHolder->id;
                $approval->save();

            }

        }else{
            $status = 0;
            $investment->status =  $status;
            $investment->save();
        }



        return redirect()->route('client.investment.index')->with('success',"Investment Saved, Request will be Send to NSB FM Team to Be approved!");

    }

    public function proceed(){
    
        $client = Auth::user();
        $selectedAccount = $client->selectedAccount;
        $account = $selectedAccount->account;
    
      
    
   
           
        
        
    
          
           $newInvestments = $account->investments()->where('status','<',0)->where('status','<>',-100)->paginate(10);
        //    dd($newInvestments);
            
      
    
    
        return view('client.subUser.requests.newInvestments.show',compact('client','newInvestments','newInvestments','account'));
    
       }


    public function process(Request $request){
    
    
        $officer = Auth::user();
        $officer_role = $officer->roles()->first()->id;
        $selectedAccount = $officer->selectedAccount;
        $account = $selectedAccount->account;
       


        $client_id = $request->client_id;
        $request_type = $request->request_type;
        $request_comment = $request->request_comment;
        $investment_id = $request->investment_id;

        $investment = Investment::findOrFail($investment_id);


        $prev_state = $investment->status;

        $investment->status = $investment->status + $request_type;
        $investment->save();

        NewInvestmentProcess::create([
            'investment_id' => $investment_id,
            'user_id' => $officer->id,
            'client_id' => $client_id,
            'previous_state' => $prev_state,
            'current_state' => $prev_state + $request_type,
            'comment' => $request_comment

        ]);
        if($officer_role==4 && $account->client_id != $officer->id){
            $jointApproval = JointInvestmentApproval::where('investment_id',$investment_id)->where('joint_holder_id',$officer->id)->first();
            if($request_type==1){
            $jointApproval->status = 1;
            }else{
            $jointApproval->status = 2;

            }
            $jointApproval->save();
        }
    

        return redirect()->route('client.investment.proceed');

   }



    public function list(){

        $client = Auth::user()->client;
        $selectedAccount = $client->selectedAccount;
       
        $account = $selectedAccount->account;
        $investments = $account->investments()->where('is_main',0)->where('status','<',3)->where('status','!=',-100)->get();

       

        return view('client.investmentList',compact('investments'));

    }   


}