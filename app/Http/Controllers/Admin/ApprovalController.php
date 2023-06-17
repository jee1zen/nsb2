<?php

namespace App\Http\Controllers\Admin;

use App\AuthorizedPerson;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\Team;
use App\User;
use App\Client;
use App\ClientOfficer;
use App\Document;
use App\EmploymentDetails;
use App\GovernmentVerifyDoc;
use App\Inquiry;
use App\Investment;
use App\JointHolder;
use App\KYCCompany;
use App\KYCForm;
use App\KYCJointForm;
use App\Process;
use App\Upload;
use App\Meeting;
use App\MoneyLaunderingVerifyDoc;
use App\RealTimeNotificationSetting;
use App\ReverseRepo;
use App\ReverseRepoProcess;
use App\UserManual;
use App\Withdraw;
use App\WithdrawProcess;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApprovalController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('client_approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $officer_role = Auth::user()->roles()->first();
        // dd($current_user->id);

        $clients = '';

        if ($officer_role->id == 5) {

            $clients = Client::where('officer_id', '=', Auth::user()->id)->orWhere('status', '<', 5)->get()->sortByDesc("create_at");
        } elseif ($officer_role->id == 6) {

            // $clients = Client::Where('officer_id', '!=', null)->orWhere('officer_id', '=', Auth::user()->id)
            // ->investments()->where('is_main','=',1)->where('status', '<', 6)->get();
            // dd($clients);

            // $clients =  Client::select('clients.id as id','clients.title','clients.name','clients.client_type','investments.status','users.name as officerName')
            //              ->join('users','clients.officer_id','=','users.id')
            //              ->join('investments','investments.client_id','=','clients.id')
            //              ->where('investments.status','<',6)->where('is_main','=',1)
            //              ->Where('officer_id', '!=', null)->orWhere('officer_id', '=', Auth::user()->id)->groupBy('id')
            //              ->get();

            $clients = Client::where('officer_id', '=', null)->orWhere('officer_id', '=', Auth::user()->id)->orWhere('status', '<=', 6)->get()->sortByDesc("created_at");

            //  dd($clients);

        } elseif ($officer_role->id == 7) {

            // $clients = Client::where('status', '<=', 7)->get();

            // $clients =  Client::select('clients.id as id','clients.title','clients.name','clients.client_type','investments.status','users.name as officerName')
            //  ->join('users','clients.officer_id','=','users.id')
            //  ->join('investments','investments.client_id','=','clients.id')->where('is_main','=',1)
            //  ->where('investments.status','=',7)->get();
            $clients = Client::where('status', '=', 7)->get()->sortByDesc("created_at");
        } elseif ($officer_role->id == 1) {
            return redirect()->route('admin.clients.management');
        } else {
        }



        // $clients = Client::all();


        return view('admin.clients.index', compact('clients', 'officer_role'));
    }

    public function pick($client_id)
    {

        $officer = Auth::user();
        abort_if(Gate::denies('client_approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Client::where('id', $client_id)->update(['officer_id' => $officer->id]);
        $client = Client::findorFail($client_id);

        $client->status = 1;
        $client->save();



        Process::create([

            'user_id' => $officer->id,
            'client_id' => $client_id,
            'previous_state' => 0,
            'current_state' => 1,
            'comment' => "picked the client for verifying process"

        ]);


        return redirect()->route('admin.clients.index');
    }

    public function verify(Request $request)
    {

        $data = unserialize(base64_decode($request->data));
        $result = DB::select('select ' . $data[1] . ' as value from ' . $data[0] . ' where id = ?', [$data[3]]);
        $setValue = 0;

        if ($result[0]->value == 0) {

            $setValue = 1;
        } else {

            $setValue = 0;
        }

        DB::update('update ' . $data[0] . ' set ' . $data[1] . ' = ' . $setValue . ' where id = ?', [$data[3]]);
    }
    public function verifyAll(Request $request)
    {
        DB::beginTransaction();
        try {
            $client_id = $request->client_id;
            $client = Client::find($client_id);



            //update all in clients details verification
            DB::update('update clients set dob_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set nic_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set address_line_1_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set address_line_2_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set address_line_3_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set correspondence_address_line_1_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set correspondence_address_line_2_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set correspondence_address_line_3_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set title_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set name_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set name_by_initials_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set telephone_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set nationality_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set nic_front_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set nic_back_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set pro_pic_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set passport_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set signature_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set billing_proof_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set client_type_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set verification_from_GOV_verify = 1 where id = ?', [$client_id]);
            DB::update('update clients set money_laundering_verification_verify = 1 where id = ?', [$client_id]);


            //update all employment details verification
            DB::update('update employment_details set occupation_verify = 1 where id = ?', [$client_id]);
            DB::update('update employment_details set company_name_verify = 1 where id = ?', [$client_id]);
            DB::update('update employment_details set company_address_verify = 1 where id = ?', [$client_id]);
            DB::update('update employment_details set telephone_verify = 1 where id = ?', [$client_id]);
            DB::update('update employment_details set fax_verify = 1 where id = ?', [$client_id]);
            DB::update('update employment_details set nature_verify = 1 where id = ?', [$client_id]);



            // update all authorized person verfication..
            DB::update('update authorized_person set name_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update authorized_person set address_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update authorized_person set nic_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update authorized_person set telephone_verify = 1 where client_id = ?', [$client_id]);


            // update verify in bank Particulars
            DB::update('update bank_particulars set verified = 1 where client_id = ?', [$client_id]);

            //update verify in 

            DB::update('update other_details set nsb_staff_fund_management_verify = 1 where id = ?', [$client_id]);
            DB::update('update other_details set nsb_staff_verify = 1 where id = ?', [$client_id]);
            DB::update('update other_details set related_nsb_staff_verify = 1 where id = ?', [$client_id]);
            DB::update('update other_details set staff_relationship_verify = 1 where id = ?', [$client_id]);
            DB::update('update other_details set member_holding_company_verify = 1 where id = ?', [$client_id]);
            DB::update('update other_details set member_holding_company_state_verify = 1 where id = ?', [$client_id]);





            //update jointHolders verification..
            if ($client->client_type == 2) {

                if ($client->hasJointHolders()) {
                    DB::update('update joint_holders set dob_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set nic_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set address_line_1_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set address_line_2_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set address_line_3_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set name_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set name_by_initials_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set mobile_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set telephone_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set nationality_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set nic_front_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set nic_back_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set passport_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set signature_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update joint_holders set pro_pic_verify = 1 where client_id = ?', [$client_id]);
                }

                // dd($client->jointHolders()->first()->hasKycWithType($client->investments()->first()->investment_type_id));

                // if($client->hasJointHolders() ){
                //     foreach($client->jointHolders()->get() as $jointHolder){






                //         DB::update('update k_y_c_joint_forms set kyc_account_at_NSB_FMC_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_nature_of_business_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_employment_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);    
                //         DB::update('update k_y_c_joint_forms set kyc_employer_address_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_ownership_of_premises_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_foreign_address_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_citizenship_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_country_of_residence_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_country_of_birth_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_nationality_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_type_of_visa_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_other_visa_type_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_expiry_date_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_purpose_account_foreign_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_purpose_of_opening_account_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id,$mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_other_purpose_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_source_of_funds_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_other_source_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id,$mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_anticipated_volume_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_expected_mode_of_transacation_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_other_connected_businesses_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id,$mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_expected_types_of_counterparties_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_operation_authority_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id,$mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_other_name_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_other_address_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_other_nic_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_residence_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_relationship_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);
                //         DB::update('update k_y_c_joint_forms set kyc_pep_verify = 1 where joint_id = ? AND investment_id = ?', [$jointHolder->id, $mainInvestment->id]);

                //     }                                         
                // }     

            }
            if ($client->client_type == 3) {

                DB::update('update companies set name_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set address_line_1_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set address_line_2_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set address_line_3_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set business_registration_no_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set nature_of_business_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set telephone_1_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set telephone_2_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set telephone_3_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set email_1_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set email_2_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set email_3_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set fax_1_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set fax_2_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set fax_3_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set business_registraton_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set business_act_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set trust_deed_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set board_resolution_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set society_constitution_verify = 1 where id = ?', [$client_id]);
                DB::update('update companies set power_of_attorney_verify = 1 where id = ?', [$client_id]);


                if ($client->hasCompanySignatures()) {


                    DB::update('update company_signatures set dob_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set nic_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set address_line_1_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set address_line_2_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set address_line_3_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set name_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set mobile_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set telephone_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set nationality_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set nic_front_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set nic_back_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set passport_verify = 1 where client_id = ?', [$client_id]);
                    DB::update('update company_signatures set signature_verify = 1 where client_id = ?', [$client_id]);

                    // DB::update('update k_y_c_company_signature_forms set kyc_account_at_NSB_FMC_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_nature_of_business_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_employment_verify = 1 where id = ?', [$signature->id]);    
                    // DB::update('update k_y_c_company_signature_forms set kyc_employer_address_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_ownership_of_premises_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_foreign_address_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_citizenship_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_country_of_residence_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_country_of_birth_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_nationality_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_type_of_visa_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_other_visa_type_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_expiry_date_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_purpose_account_foreign_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_purpose_of_opening_account_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_other_purpose_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_source_of_funds_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_other_source_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_anticipated_volume_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_expected_mode_of_transacation_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_other_connected_businesses_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_expected_types_of_counterparties_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_operation_authority_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_other_name_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_other_address_verify = 1 where id = ?', [$signature->id]);
                    // DB::update('update k_y_c_company_signature_forms set kyc_other_nic_verify = 1 where id = ?', [$signature->id]);




                }








                // DB::update('update k_y_c_companies set kyc_account_at_NSB_FMC_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_foreign_address_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_countries_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_purpose_of_opening_account_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_other_purpose_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_source_of_funds_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_other_source_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_anticipated_volume_verify = 1 where company_id = ? AND  investment_id=?', [$client_id, $mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_expected_mode_of_transacation_verify = 1 where company_id = ? AND  investment_id=?', [$client_id, $mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_other_connected_businesses_verify = 1 where company_id = ? AND  investment_id=?', [$client_id, $mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_property_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_motor_vehicles_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_financial_assets_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set kyc_investments_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set other_asset_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
                // DB::update('update k_y_c_companies set has_foreign_investors_verify = 1 where company_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);


                // if($client->company->kyc()->hasKycForiegnInvestors()){


                // $kyc_company_id = KYCCompany::where('company_id','=',$client->id)->where('investment_id','=',$mainInvestment->id)->first()->id;


                // DB::update('update k_y_c_company_foreign_investors set verify = 1 where company_id = ? And investment_id = ?', [$kyc_company_id,$mainInvestment->id]);


                // }




            }




            //kyc verify..
            // $invesment_type = $client->investments()->first()->investment_type_id;
            // $kyc_id = $client->kyc()->first()->id;

            // DB::update('update k_y_c_forms set kyc_account_at_NSB_FMC_verify = 1 where client_id  = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_ownership_of_premises_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_foreign_address_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_citizenship_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_residence_verify = 1 where client_id = ? AND  investment_id=?', [$client_id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_country_of_residence_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_country_of_birth_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_nationality_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_type_of_visa_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_other_visa_type_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_expiry_date_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_purpose_account_foreign_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_purpose_of_opening_account_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_other_purpose_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_source_of_funds_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_other_source_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_anticipated_volume_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_expected_mode_of_transacation_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_other_connected_businesses_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_expected_types_of_counterparties_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_operation_authority_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_other_name_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_other_address_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_other_nic_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_relationship_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);
            // DB::update('update k_y_c_forms set kyc_pep_verify = 1 where client_id = ? And investment_id=?', [$client->id,$mainInvestment->id]);






            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function kyc($id)
    {


        $kyc = KYCForm::where('client_id', $id)->where('investment_id', 0)->latest()->first();
        $client = Client::findOrFail($id);


        return view('admin.clients.kyc', compact('client', 'kyc'));
    }

    public function kycRemark(Request $request)
    {

        $id = $request->kyc_id;
        $user = Auth::user()->id;
        $kyc = KYCForm::findOrFail($id);
        $kyc->risk_rate = $request->risk_rate;
        $kyc->officer_remarks = $request->remark;
        $kyc->officer = $user;
        $kyc->save();
        return redirect()->back();
    }

    public function updateRefEmail(Request $request)
    {

        $client_id = $request->client_id;
        $reference_email = $request->reference_email;

        $client = Client::findorFail($client_id);
        $client->reference_email = $reference_email;
        $client->save();

        return redirect()->back();
    }


    public function process(Request $request)
    {
        set_time_limit(0);
        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();


        $client_id = $request->client_id;
        $request_type = $request->request_type;
        $request_comment = $request->request_comment;

        $client = Client::findorFail($client_id);
        $prev_state = $client->status;

        if ($request_type == 1) {

            if ($prev_state == 1 && $client->is_ex == 0) {
                $data = [
                    'client' => $client,
                    'today' => $today_ymd =  Carbon::now()->format('Y-m-d')
                ];

                $pdf =  PDF::loadView('forms.profile', $data);
                $pdf->setPaper('a4', 'portrait');
                $pdf->save(storage_path('app/public/downloads/profiles/' . $client->id . '.pdf'));

                Mail::send('emails.clientform', ['name' => $client->title . ' ' . $client->name], function ($message) use ($client) {
                    $message->to($client->user->email);
                    $message->subject('Client Form')->attach(storage_path('app/public/downloads/profiles/' . $client->id . '.pdf'));
                });

                if ($client->reference_email != null) {
                    Mail::send('emails.clientform', ['name' => $client->title . ' ' . $client->name], function ($message) use ($client) {
                        $message->to($client->reference_email);
                        $message->subject('Client Form')->attach(storage_path('app/public/downloads/profiles/' . $client->id . '.pdf'));
                    });
                }
            }

            if ($prev_state == 4) {


                Mail::send('emails.managerEmail', ['name' => $client->title . ' ' . $client->name, 'phone' => $client->mobile], function ($message) use ($client) {
                    $message->to('bankmanagernsb@gmail.com');
                    $message->subject('Client to be Approved');
                });
            }


            if ($prev_state == 6) {


                Mail::send('emails.managerEmail', ['name' => $client->title . ' ' . $client->name, 'phone' => $client->mobile], function ($message) use ($client) {
                    $message->to('bankmiddlensb@gmail.com');
                    $message->subject('Client to be Approved');
                });
            }




            if ($prev_state == 7) {

                Mail::send('emails.bankofficerVerified', ['name' => $client->title . ' ' . $client->name], function ($message) use ($client) {
                    $message->to($client->user->email);
                    $message->subject('Bank Details of NSB FMC');
                });
                Mail::send('emails.welcome', ['name' => $client->title . ' ' . $client->name, 'email' => $client->user->email, 'password' => $client->password], function ($message) use ($client) {
                    $message->to($client->user->email);
                    $message->subject('Account Credentials of NSB FMC Online Portal');
                });

                if ($client->client_type == 2) {

                    foreach ($client->jointHolders()->get() as $jointHolder) {
                        Mail::send('emails.welcome', ['name' => $jointHolder->title . ' ' . $jointHolder->name, 'email' => $jointHolder->user->email, 'password' => $jointHolder->password], function ($message) use ($jointHolder) {
                            $message->to($jointHolder->user->email);
                            $message->subject('Welcome to NSB FMC ' . $jointHolder->title . ' ' . $jointHolder->name);
                        });
                    }
                }
            }

            $client->status = $client->status + $request_type;
        } else {


            $client->status = 100;
            // if ($officer_role->id != 7) {
                Mail::send('emails.applicationRejected', ['name' => $client->title . ' ' . $client->name, 'email' => $client->user->email, 'id' => $client->id], function ($message) use ($client) {
                    $message->to($client->user->email);
                    $message->subject(' Your Application is Rejected - Please Refill Your Application');
                });
            // }
        }


        $client->save();

        Process::create([

            'user_id' => $officer->id,
            'client_id' => $client_id,
            'previous_state' => $prev_state,
            'current_state' =>  $client->status,
            'comment' => $request_comment

        ]);

        return redirect()->route('admin.clients.show', $client_id);
    }

    public function show($id)
    {
        abort_if(Gate::denies('client_approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client = Client::findOrFail($id);
        $authorizedPerson = Client::find($id)->authorizedPerson;
        // $employmentDetails = Client::find($id)->employmentDetails;
        $employmentDetails = $client->employmentDetails;
        $otherDetails = $client->otherDetails;

        $kyc = null;
        $kyc_rating = null;

        if ($client->hasClientKYC()) {



            $kyc = $client->clientKYC();

            $totalRiskRate = 0;
            $rateLabel = "Unrated";
            $rateColor = "light";
            //risk calculation..

            if ($client->client_type == 1) {
                $type_rate = 0.05;
            } elseif ($client->client_type == 2) {
                $type_rate = 0.10;
            } else {
                $type_rate = 0.15;
            }




            if ($client->client_type != 3) {
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

        //   dd($kyc);

        // $kyc =DB::select('select * from k_y_c_forms where id = ?', [$id]);
        // dd($kyc);

        //   dd($kyc_rating['totalRiskRate']);
        return view('admin.clients.show', compact('client', 'authorizedPerson', 'employmentDetails', 'otherDetails', 'kyc_rating', 'kyc'));
    }

    public function verifyType(Request $request, $client_id)
    {

        $request->validate([
            'verify_type' => 'required',



        ]);
        $officer = Auth::user();

        $client = Client::findOrFail($client_id);
        $client->verify_type = $request->verify_type;
        $client->verify_comment = $request->verityTypeComment;
        $client->save();

        if ($request->verifyType == 0) {
            $request_type = 2;
        } else {
            $request_type = 1;
        }


        $request_comment = 'physically verified';

        $client = Client::findorFail($client_id);
        $prev_state = $client->status;
        $client->status = $client->status + $request_type;
        $client->save();

        Process::create([

            'user_id' => $officer->id,
            'client_id' => $client_id,
            'previous_state' => $prev_state,
            'current_state' => $prev_state + $request_type,
            'comment' => $request_comment

        ]);


        return redirect()->route('admin.clients.show', $client_id);
    }


    public function sheduleMeeting(Request $request, $client_id)
    {



        abort_if(Gate::denies('client_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        DB::beginTransaction();
        try {
            $officer = Auth::user();
            $client = Client::find($client_id);

            $meeting = Meeting::create([

                'client_id' => $client_id,
                'officer_id' => $officer->id,
                'date' => $request->date,
                'time' => $request->time,
                'link' => $request->link,
                'description' => $request->description,
                'status' => '0'
            ]);





            Mail::send('emails.meetingSheduled', ['name' => $client->name, 'email' => $client->user->email, 'meeting' => $meeting], function ($message) use ($client, $meeting) {
                $message->to($client->user->email);
                $message->subject('NSB FMC Confirmation Video Conference' . $client->title . " " . $client->name);
            });

            if ($client->client_type == 2) {

                if ($client->hasJointHolders()) {

                    foreach ($client->jointHolders()->get() as $jointHolder) {

                        Mail::send('emails.meetingSheduled', ['name' => $jointHolder->name, 'email' => $jointHolder->user->email, 'meeting' => $meeting], function ($message) use ($jointHolder, $meeting) {
                            $message->to($jointHolder->user->email);
                            $message->subject('NSB FMC Confirmation Video Conference' . $jointHolder->title . " " . $jointHolder->name);
                        });
                    }
                }
            }






            $request_type = 1;
            $request_comment = 'Sheduled Meeting!';

            $client = Client::findorFail($client_id);
            $client->verify_type = 1;
            $client->save();

            $prev_state = $client->status;
            $client->status = $client->status + $request_type;
            $client->save();

            Process::create([

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


        return redirect()->route('admin.clients.show', $client_id);
    }
    public function updateMeeting(Request $request, $client_id)
    {

        abort_if(Gate::denies('client_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $officer = Auth::user();
        $meeting = Meeting::findorFail($request->meetingId);

        if ($request->meetingStatus == 1) {

            $date = date('m/d/Y h:i:s a', time());
            // $video = $request->file('video');
            // $videoName = time() . '.' . $video->extension();
            // $destinationPath = storage_path('app/public/uploads/');
            // $upload = $video->move($destinationPath, $videoName);
            // if($upload){

            // $meeting->video = $videoName;
            $meeting->status = 1;
            $meeting->save();

            $request_type = 1;
            $request_comment = 'Conference Done!';

            $client = Client::findorFail($client_id);

            $prev_state = $client->status;
            $client->status = $client->status + $request_type;
            $client->save();
            Process::create([
                'user_id' => $officer->id,
                'client_id' => $client_id,
                'previous_state' => $prev_state,
                'current_state' => $prev_state + $request_type,
                'comment' => $request_comment
            ]);
            // }
        }

        return redirect()->route('admin.clients.show', $client_id);
    }


    public function deleteClient(Request $request)
    {

        abort_if(Gate::denies('client_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        set_time_limit(0);

        // dd($request->all());
        DB::beginTransaction();
        try {

            $client = Client::findOrFail($request->id);
            if ($client->status <= 1) {
                if ($client->cleint_type == 2 && $client->hasJointHoders()) {


                    foreach ($client->jointHolders()->get() as $jointHolder) {


                        KYCJointForm::where('joint_id', $jointHolder->id)->Delete();
                        DB::table('role_user')->where('user_id', $jointHolder->id)->Delete();
                        $jointHolder->user->forceDelete();
                        $jointHolder->forceDelete();
                    }
                }


                $client->employmentDetails->Delete();

                if ($client->hasOtherDetails()) {
                    $client->otherDetails->Delete();
                }


                KYCForm::where('client_id', $client->id)->Delete();
                $client->bankParticulars()->Delete();
                $client->uploads()->Delete();
                $client->investments()->Delete();
                // $client->authorizedPerson->delete();
                DB::table('role_user')->where('user_id', $client->id)->Delete();
                $client->realTimeNotification->Delete();
                $client->user->forceDelete();
                $client->forceDelete();
            }else{


                return redirect()->back()->with('message','client is above the level of deleting');
            }




            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }






        return redirect(route('admin.clients.index'))->with('message', 'Client Deleted!');
    }
}