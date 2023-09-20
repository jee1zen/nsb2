<?php

namespace App\Http\Controllers\Admin;

use App\AccountChange;
use App\AccountChangeProcess;
use App\Http\Controllers\Controller;
use App\KYCForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountChangesController extends Controller
{
    

    public function index(){

        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();

        if ($officer_role->id == 5) {
            
            $accountChanges = AccountChange::where('pre',0)->where('status',0)->get();
            
        
        } elseif ($officer_role->id == 6) {
            $accountChanges = AccountChange::where('pre',0)->where('status',0)->get();
           
        } elseif ($officer_role->id == 7) {

            $accountChanges = AccountChange::where('pre',0)->where('status',1)->get();

           
        }

        return view('admin.accountEdits.index', compact('accountChanges', 'officer_role'));
    }

    public function show($id){

        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();
      

        $accountChange = AccountChange::findorFail($id);
        // dd($accountChange->status);
        $account = $accountChange->account;
        $client = $account->client;
        $authorizedPerson = $client->authorizedPerson;
        // $employmentDetails = Client::find($id)->employmentDetails;
        $employmentDetails = $client->employmentDetails;
        $otherDetails = $client->otherDetails;


        $clientChange = $account->clientChange;
        $employmentDetailsChanges = $account->employmentChange->first();
        // dd($employmentDetailsChanges);

        $kyc_change = $account->kycChange;
        $kyc = null;
        $kyc_rating = null;

        if ($account->hasKyc()) {



            $kyc = KYCForm::where('account_id',$account->id)->where('investment_id',0)->latest()->first();
          
            if($kyc!=null){

           
            $totalRiskRate = 0;
            $rateLabel = "Unrated";
            $rateColor = "light";
            //risk calculation..

            if ($account->type == 1) {
                $type_rate = 0.05;
            } elseif ($client->client_type == 2) {
                $type_rate = 0.10;
            } else {
                $type_rate = 0.15;
            }




            if ($account->type != 3) {
                //ownership..
                if ($kyc->kyc_ownership_of_premises == 'Owner' || $kyc->kyc_ownership_of_premises == "Parent's") {
                    $ownership_rate = 0.05;
                } elseif ($kyc->kyc_ownership_of_premises == "Lease/Rent" || $kyc->kyc_ownership_of_premises == "Official") {
                    $ownership_rate = 0.10;
                } else {
                    $ownership_rate = 0.15;
                }



                //citizenship and residence..
                if ($kyc->kyc_citizenship == 'Sri Lankan') {
                    $citizenship_rate = 0.05;
                } elseif ($kyc->kyc_citizenship == "Sri Lankan") {
                    $citizenship_rate = 0.10;
                } elseif ($kyc->kyc_citizenship == "Sri Lankan with dual citizenship") {
                    $citizenship_rate = 0.10;
                } else {
                    $citizenship_rate = 0.15;
                }

                //purpose of opening account

                if ($kyc->kyc_purpose_of_opening_account == "Employment/Professional income") {
                    $purpose_rate = 0.20;
                } elseif (
                    $kyc->kyc_purpose_of_opening_account == "Savings" ||
                    $kyc->kyc_purpose_of_opening_account == "Investment purposes" ||
                    $kyc->kyc_purpose_of_opening_account == "Remittances"
                ) {
                    $purpose_rate = 0.0;
                } else {
                    $purpose_rate = 0.60;
                }


                // source of fund

                if ($kyc->kyc_source_of_funds == "Salary/Profit/Professional Income") {
                    $source_rate = 0.25;
                } elseif (
                    $kyc->kyc_source_of_funds == "Sales and Business Turnover" ||
                    $kyc->kyc_source_of_funds == "Sale of Property/Assets" ||
                    $kyc->kyc_source_of_funds == "Sales and Business Turnover" ||
                    $kyc->kyc_source_of_funds == "Rent Income" ||
                    $kyc->kyc_source_of_funds == "Remittances" ||
                    $kyc->kyc_source_of_funds == "Investment Proceeds" ||
                    $kyc->kyc_source_of_funds == "Export Proceeds"
                ) {
                    $source_rate = 0.50;
                } else {
                    $source_rate = 0.75;
                }

                // volunme...
                if (
                    $kyc->kyc_anticipated_volume == "Less than Rs.200,000 (or equivalent FC value)" ||
                    $kyc->kyc_anticipated_volume == "Rs.200,001 to Rs.500,000 (or equivalent FC value)"
                ) {
                    $volume_rate = 0.20;
                } elseif ($kyc->kyc_anticipated_volume == "Rs.500,001 to Rs.1,000,000 (or equivalent FC value") {
                    $volume_rate = 0.20;
                } else {
                    $volume_rate = 0.30;
                }

                //mode of transaction..
                if (
                    $kyc->kyc_expected_mode_of_transacation == "Cheque" ||
                    $kyc->kyc_expected_mode_of_transacation == "Standing Orders"
                ) {
                    $mode_rate = 0.15;
                } elseif ($kyc->kyc_expected_mode_of_transacation == "Cash") {
                    $mode_rate = 0.30;
                } else {
                    $mode_rate = 0.45;
                }


                //relationship rate
                if ($kyc->kyc_relationship == 'Existing customer (more than 5 years)') {
                    $relationship_rate = 0.05;
                } elseif ($kyc->kyc_relationship == 'Existing customer (1 to 5 years)') {
                    $relationship_rate = 0.10;
                } else {
                    $relationship_rate = 0.15;
                }

                //pep rate
                if ($kyc->kyc_pep == 'Yes') {
                    $pep_rate = 0.05;
                } else {
                    $pep_rate = 0;
                }

                $indentification_rate = 0.10;


                $totalRiskRate = $type_rate + $citizenship_rate + $purpose_rate + $source_rate + $volume_rate + $mode_rate + $relationship_rate + $pep_rate + $indentification_rate;
                //  dd($totalRiskRate);
                if ($kyc->risk_rate != null) {
                    if ($kyc->risk_rate == "HIGH") {
                        $rateLabel = "HIGH";
                        $rateColor = "danger";
                    } elseif ($kyc->risk_rate == "MEDIUM") {
                        $rateLabel = "MEDIUM";
                        $rateColor = "warning";
                    } elseif ($kyc->risk_rate == "LOW") {
                        $rateLabel = "LOW";

                        $rateColor = "secondary";
                    } else {
                    }
                } else {



                    if (($totalRiskRate < 3 && $totalRiskRate > 2.4) || $kyc->kyc_pep=="Yes") {

                        $rateLabel = "HIGH";
                        $rateColor = "danger";
                    } elseif ($totalRiskRate < 2.33 && $totalRiskRate > 1.67) {
                        $rateLabel = "MEDIUM";
                        $rateColor = "warning";
                    } elseif ($totalRiskRate < 1.66 && $totalRiskRate > 1.00) {

                        $rateLabel = "LOW";

                        $rateColor = "secondary";
                    } else {
                    }
                }
            }


            $kyc_rating =
                [

                    'ownership_rate' => $ownership_rate,
                    'citizenship_rate' => $citizenship_rate,
                    'purpose_rate' => $purpose_rate,
                    'source_rate' => $source_rate,
                    'volume_rate' => $volume_rate,
                    'mode_rate' => $mode_rate,
                    'relationship_rate' => $relationship_rate,
                    'pep_rate' => $pep_rate,
                    'indentification_rate' => $indentification_rate,
                    'rateLabel' => $rateLabel,
                    'rateColor' => $rateColor,
                    'totalRiskRate' => $totalRiskRate,


                ];
            }
        }

        //   dd($kyc);

        // $kyc =DB::select('select * from k_y_c_forms where id = ?', [$id]);
        // dd($kyc);

        //   dd($kyc_rating['totalRiskRate']);
        // dd($employmentDetailsChanges);
        return view('admin.accountEdits.show', compact('client','account', 'accountChange','authorizedPerson',
         'employmentDetails', 'otherDetails', 'kyc_rating', 'kyc','clientChange','employmentDetailsChanges','kyc_change','officer_role'));



    }

    public function process(Request $request,$id)
    {
       
        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();

        $accountChange = AccountChange::findOrFail($id);


   
        $request_type = $request->request_type;
        $request_comment = $request->request_comment;
       

     
       
        $prev_state = $accountChange->status;

        if ($request_type == 1) {
            $accountChange->status = $accountChange->status + $request_type;
        } else {

            $accountChange->status = -100;
        }


        $accountChange->save();

        AccountChangeProcess::create([

            'user_id' => $officer->id,
            'account_id' => $accountChange->account_id,
            'previous_state' => $prev_state,
            'current_state' => $prev_state + $request_type,
            'comment' => $request_comment

        ]);

        return $this->index();
    }
}