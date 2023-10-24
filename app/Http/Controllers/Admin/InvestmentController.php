<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Investment;
use App\Client;
use App\NewInvestmentProcess;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use DB;
use Gate;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        abort_if(Gate::denies('client_approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $officer_role = Auth::user()->roles()->first();
        // dd($current_user->id);

        $clients = '';

        if ($officer_role->id == 5) {

            $investments = Investment::where('status',0)->where('is_main',0)->get();
        

        } elseif ($officer_role->id == 6) {
            $investments = Investment::where('status',0)->where('is_main',0)->get();
          
                        
        } elseif ($officer_role->id == 7) {
             $investments = Investment::where('status',1)->where('is_main',0)->get();

        }elseif($officer_role->id ==1){
            return redirect()->route('admin.clients.management');
        
        }
        
        else{

        }
           
        return view('admin.investment.index', compact('investments', 'officer_role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show($id,$investment_id)
    {
        abort_if(Gate::denies('client_approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client = Client::findOrFail($id);
    
        $investment = Investment::find($investment_id);
        $account = $investment->account;
        $kyc = $client->kycByInvestmentId($investment_id,$investment->account_id);
        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();
        $investments = $client->investments()->where('invested_amount','>',0)->where('method','!=','Maturity')->get();
        $total_investments = $investments->sum('invested_amount');
        $total_maturity    =  $investments->sum('matured_amount');
       
        // $kyc =DB::select('select * from k_y_c_forms where id = ?', [$id]);
        // dd($kyc);
    

        return view('admin.investment.show', compact('client','kyc','investment_id',
        'investment','investments','total_investments','total_maturity','officer_role','account'));
    }
    public function process(Request $request,$id,$investment_id)
    {
       
        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();


        $client_id = $request->client_id;
        $request_type = $request->request_type;
        $request_comment = $request->request_comment;
        $type = $request->investment_type;

        $client = Client::findorFail($client_id);
        $thisInvestment = $client->investmentById($investment_id);
        $prev_state = $thisInvestment->status;

        if ($request_type == 1) {
            $thisInvestment->status = $thisInvestment->status + $request_type;
        } else {

            $thisInvestment->status = -100;
        }


        $thisInvestment->save();

        NewInvestmentProcess::create([

            'user_id' => $officer->id,
            'client_id' => $client_id,
            'previous_state' => $prev_state,
            'current_state' => $prev_state + $request_type,
            'comment' => $request_comment

        ]);

        return $this->index();
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

    public function update(Request $request){

        $investment = Investment::findorFail($request->investment_id);

        if(isset($request->yield)){
            $investment->yield = $request->yield;
        }
     
        $investment->investment_type_id = $request->investment_type;
        $investment->amount = str_replace(",", "",$request->amount);
        $investment->value_date = $request->value_date;
        $investment->maturity_date = $request->maturity_date;
        $investment->instruction = $request->instruction;
        $investment->save();

        return back()->with('success', 'Investment Values Updated');   ;

    }

    public function verifyAll(Request $request)
    {

        $client_id = $request->client_id;
        $client = Client::find($client_id);
        $type = $request->type;
        // DB::beginTransaction();
        // try {

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
        DB::update('update clients set telephone_verify = 1 where id = ?', [$client_id]);
        DB::update('update clients set nationality_verify = 1 where id = ?', [$client_id]);
        DB::update('update clients set nic_front_verify = 1 where id = ?', [$client_id]);
        DB::update('update clients set nic_back_verify = 1 where id = ?', [$client_id]);
        DB::update('update clients set passport_verify = 1 where id = ?', [$client_id]);
        DB::update('update clients set signature_verify = 1 where id = ?', [$client_id]);
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
        if($client->client_type==2){

            if($client->hasJointHolders()){
            DB::update('update joint_holders set dob_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set nic_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set address_line_1_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set address_line_2_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set address_line_3_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set name_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set mobile_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set telephone_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set nationality_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set nic_front_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set nic_back_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set passport_verify = 1 where client_id = ?', [$client_id]);
            DB::update('update joint_holders set signature_verify = 1 where client_id = ?', [$client_id]);
            }
            
            // dd($client->jointHolders()->first()->hasKycWithType($client->investments()->first()->investment_type_id));

        if($client->hasJointHolders() && $client->jointHolders()->first()->hasKycWithType($type)){
            foreach($client->jointHolders()->get() as $jointHolder){
    
    
              
               
    
    
                DB::update('update k_y_c_joint_forms set kyc_account_at_NSB_FMC_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_nature_of_business_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_employment_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);    
                DB::update('update k_y_c_joint_forms set kyc_employer_address_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_ownership_of_premises_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_foreign_address_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_citizenship_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_country_of_residence_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_country_of_birth_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_nationality_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_type_of_visa_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_other_visa_type_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_expiry_date_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_purpose_account_foreign_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_purpose_of_opening_account_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_other_purpose_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_source_of_funds_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_other_source_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_anticipated_volume_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_expected_mode_of_transacation_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_other_connected_businesses_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_expected_types_of_counterparties_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_operation_authority_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_other_name_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_other_address_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
                DB::update('update k_y_c_joint_forms set kyc_other_nic_verify = 1 where joint_id = ? AND investment_type = ?', [$jointHolder->id, $type]);
    
             }
           }     
    
        }
        if($client->client_type==3){

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


            if($client->hasCompanySignatures()){
               
        
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







            $invesment_type = $type;
            DB::update('update k_y_c_companies set kyc_account_at_NSB_FMC_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set kyc_foreign_address_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set kyc_countries_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set kyc_purpose_of_opening_account_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set kyc_other_purpose_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set kyc_source_of_funds_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set kyc_other_source_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set kyc_anticipated_volume_verify = 1 where company_id = ? AND  investment_type=?', [$client_id, $invesment_type]);
            DB::update('update k_y_c_companies set kyc_expected_mode_of_transacation_verify = 1 where company_id = ? AND  investment_type=?', [$client_id, $invesment_type]);
            DB::update('update k_y_c_companies set kyc_other_connected_businesses_verify = 1 where company_id = ? AND  investment_type=?', [$client_id, $invesment_type]);
            DB::update('update k_y_c_companies set kyc_property_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set kyc_motor_vehicles_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set kyc_financial_assets_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set kyc_investments_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set other_asset_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);
            DB::update('update k_y_c_companies set has_foreign_investors_verify = 1 where company_id = ? AND  investment_type=?', [$client_id,$invesment_type]);

            // if($client->company->kyc()->hasKycForiegnInvestors()){
                $invesment_type = $type;

                $kyc_company_id = KYCCompany::where('company_id','=',$client->id)->where('investment_type','=',$invesment_type)->first()->id;


                DB::update('update k_y_c_company_foreign_investors set verify = 1 where company_id = ?', [$kyc_company_id]);


            // }




        }
        $invesment_type = $type;
        DB::update('update k_y_c_forms set kyc_account_at_NSB_FMC_verify = 1 where client_id  = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_ownership_of_premises_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_foreign_address_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_citizenship_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_country_of_residence_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_country_of_birth_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_nationality_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_type_of_visa_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_other_visa_type_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_expiry_date_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_purpose_account_foreign_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_purpose_of_opening_account_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_other_purpose_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_source_of_funds_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_other_source_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_anticipated_volume_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_expected_mode_of_transacation_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_other_connected_businesses_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_expected_types_of_counterparties_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_operation_authority_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_other_name_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_other_address_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
        DB::update('update k_y_c_forms set kyc_other_nic_verify = 1 where client_id = ? And investment_type=?', [$client->id,$invesment_type]);
    }

 
}