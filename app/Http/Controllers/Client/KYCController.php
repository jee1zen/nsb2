<?php

namespace App\Http\Controllers\Client;

use App\Account;
use App\AccountJointHolder;
use App\Client;
use App\Company;
use App\CompanySignature;
use App\Http\Controllers\Controller;
use App\Investment;
use App\JoinHolderChange;
use App\JointHolder;
use App\KYCCompany;
use App\KYCCompanyForeignInvestor;
use App\KYCCompanySignatureForms;
use App\KYCForm;
use App\KYCJointForm;
use App\User;
use Illuminate\Http\Request;
use Auth;

class KYCController extends Controller
{
    public function index()
    {

        $client = Auth::user()->client;





        return view('client.kycClient', compact('client'));
    }

    public function kycLink($id)
    {

        $investment = Investment::findOrFail($id);
        $user = $investment->client->user;
        Auth::login($user);

        return redirect()->route('client.kyc.client', $id);
    }


    public function clientForm($id)
    {


        $client = Auth::user()->client;
        // dd($client);


        return view('client.kycForm', compact('client', 'id'));
    }

    public function store(Request $request)
    {

        $user  = Auth::user();
        $client = $user->client;
        $request->validate([
            'kyc_account_at_NSB_FMC' => 'required',
            'kyc_purpose_of_opening_account' => 'required',
            'kyc_source_of_funds' => 'required',
            'kyc_anticipated_volume' => 'required',
            'kyc_expected_mode_of_transacation' => 'required',
            'kyc_operation_authority' => 'required',


        ]);
        $investment = Investment::findOrFail($request->investment_id);
        $account =  $investment->account;

        // dd($client->investments()->first()->investment_type_id);


        $kyc = new KYCForm;
        $kyc->client_id = $client->id;
        $kyc->account_id = $account->id;
        $kyc->investment_id = $request->investment_id;
        $kyc->kyc_account_at_NSB_FMC = $request->kyc_account_at_NSB_FMC;
        $kyc->kyc_ownership_of_premises = $request->kyc_ownership_of_premises;
        $kyc->kyc_foreign_address = $request->kyc_foreign_address;
        $kyc->kyc_citizenship = $request->kyc_citizenship;
        $kyc->kyc_residence = $request->kyc_residence;
        $kyc->kyc_country_of_birth = $request->kyc_country_of_birth;
        $kyc->kyc_country_of_residence = $request->kyc_country_of_residence;
        $kyc->kyc_nationality = $request->kyc_nationality;
        $kyc->kyc_type_of_visa = $request->kyc_type_of_visa;
        $kyc->kyc_other_visa_type = $request->kyc_other_visa_type;
        $kyc->kyc_expiry_date = $request->kyc_expiry_date;
        $kyc->kyc_purpose_account_foreign = $request->kyc_purpose_account_foreign;
        $kyc->kyc_purpose_of_opening_account = $request->kyc_purpose_of_opening_account;
        $kyc->kyc_other_purpose = $request->kyc_other_purpose;
        $kyc->kyc_source_of_funds = $request->kyc_source_of_funds;
        $kyc->kyc_other_source = $request->kyc_other_source;
        $kyc->kyc_anticipated_volume = $request->kyc_anticipated_volume;
        $kyc->kyc_expected_mode_of_transacation = $request->kyc_expected_mode_of_transacation;
        $kyc->kyc_other_connected_businesses = $request->kyc_other_connected_businesses;
        $kyc->kyc_expected_types_of_counterparties = $request->kyc_expected_types_of_counterparties;
        $kyc->kyc_operation_authority = $request->kyc_operation_authority;
        $kyc->kyc_other_name = $request->kyc_other_name;
        $kyc->kyc_other_address = $request->kyc_other_address;
        $kyc->kyc_other_nic = $request->kyc_other_nic;
        $kyc->kyc_relationship = $request->kyc_relationship;
        $kyc->kyc_pep = $request->kyc_pep;
        $kyc->kyc_us_person = $request->kyc_us_person;
        $kyc->kyc_employment_status = $request->kyc_employment_status;
        $kyc->kyc_other_employement = $request->kyc_other_employement;
        $kyc->kyc_nature_of_business = $request->kyc_nature_of_business;
        $kyc->kyc_nature_of_business_specify = $request->kyc_nature_of_business_specify;
        $kyc->kyc_marital_status = $request->kyc_marital_status;
        $kyc->kyc_spouse_name = $request->kyc_spouse_name;
        $kyc->kyc_spouse_job = $request->kyc_spouse_job;

        $kyc->save();


        if ($account->type == 1) {

            $investment->kyc = 1;
            $investment->save();
        } elseif ($client->client_type == 2) {

            if ($client->joint_permission == 1) {
                $jointcount = $client->jointHolders()->count();
                $count = 0;
                foreach ($account->jointHolders()->get() as $jointHolder) {

                    if ($jointHolder->hasKyc()) {
                        $count = $count + 1;
                    }
                }
                if ($jointcount == $count) {

                    // dd($thisInvestment);
                    $investment->kyc = 1;
                    $investment->save();
                }
            } else {


                $investment->kyc = 1;
                $investment->save();
            }
        } elseif ($client->client_type == 3) {

            $companySignaturesCount = $client->companySignatures()->count();
            $count = 0;
            foreach ($client->companySignatures()->get() as $signature) {

                if ($signature->hasKyc()) {
                    $count = $count + 1;
                }
            }
            if ($companySignaturesCount == $count) {

                $thisInvestment = $client->investmentsWithType($request->investment_id);
                $thisInvestment->kyc = 1;
                $thisInvestment->save();
            }
        } else {
        }


        if ($user->id == $account->client_id) { //if  mainholder
            if ($request->investment_id == 0) {
                return redirect()->route('client.kyc.index');
            } else {

                return redirect()->route('client.investment.form', $request->investment_id);
            }
        } else { // if joint holder
            if ($request->investment_id == 0) {
                Auth::logout();
                return view('client.jointHolderMessage');
            } else {
                return redirect(route('client.investment.proceed'))->with('message', "KYC filled Now you can Accept Request");
            }
        }
    }

    public function jointKYC($account_id, $id, $link)
    {

        $jointHolder_id = AccountJointHolder::where('kyc_link', $link)->first()->client_id;

        $user = User::find($jointHolder_id);
        $jointHolder = $user->client;
        $investment_id = $id;
        if (!Auth::check()) {
            Auth::logout();
        }


        //    $user->login();
        Auth::login($user);


        return view('client.kycJointClient', compact('jointHolder', 'user', 'investment_id', 'account_id'));
    }


    public function joint($account_id, $id, $investment_id)
    {

        $jointHolder = Client::where('id', $id)->first();






        return view('client.kycJointForm', compact('jointHolder', 'investment_id', 'account_id'));
    }
    public function jointStore(Request $request, $account_id, $id, $investment_id)
    {

        $request->validate([
            'kyc_nature_of_business' => 'required',
            'kyc_employment' => 'required',
            'kyc_employer_address' => 'required',
            'kyc_account_at_NSB_FMC' => 'required',
            'kyc_purpose_of_opening_account' => 'required',
            'kyc_source_of_funds' => 'required',
            'kyc_anticipated_volume' => 'required',
            'kyc_expected_mode_of_transacation' => 'required',
            'kyc_operation_authority' => 'required',

        ]);

        $client = Client::find($id);
        $account = Account::find($account_id);


        $kyc = new KYCForm();
        $kyc->client_id = $id;
        $kyc->account_id = $account_id;
        $kyc->investment_id = $request->investment_id;
        $kyc->kyc_nature_of_business = $request->kyc_nature_of_business;

        $kyc->kyc_account_at_NSB_FMC = $request->kyc_account_at_NSB_FMC;
        $kyc->kyc_ownership_of_premises = $request->kyc_ownership_of_premises;
        $kyc->kyc_foreign_address = $request->kyc_foreign_address;
        $kyc->kyc_citizenship = $request->kyc_citizenship;
        $kyc->kyc_residence = $request->kyc_residence;
        $kyc->kyc_country_of_birth = $request->kyc_country_of_birth;
        $kyc->kyc_country_of_residence = $request->kyc_country_of_residence;
        $kyc->kyc_nationality = $request->kyc_nationality;
        $kyc->kyc_type_of_visa = $request->kyc_type_of_visa;
        $kyc->kyc_other_visa_type = $request->kyc_other_visa_type;
        $kyc->kyc_expiry_date = $request->kyc_expiry_date;
        $kyc->kyc_purpose_account_foreign = $request->kyc_purpose_account_foreign;
        $kyc->kyc_purpose_of_opening_account = $request->kyc_purpose_of_opening_account;
        $kyc->kyc_other_purpose = $request->kyc_other_purpose;
        $kyc->kyc_source_of_funds = $request->kyc_source_of_funds;
        $kyc->kyc_other_source = $request->kyc_other_source;
        $kyc->kyc_anticipated_volume = $request->kyc_anticipated_volume;
        $kyc->kyc_expected_mode_of_transacation = $request->kyc_expected_mode_of_transacation;
        $kyc->kyc_other_connected_businesses = $request->kyc_other_connected_businesses;
        $kyc->kyc_expected_types_of_counterparties = $request->kyc_expected_types_of_counterparties;
        $kyc->kyc_operation_authority = $request->kyc_operation_authority;
        $kyc->kyc_other_name = $request->kyc_other_name;
        $kyc->kyc_other_address = $request->kyc_other_address;
        $kyc->kyc_other_nic = $request->kyc_other_nic;
        $kyc->kyc_relationship = $request->kyc_relationship;
        $kyc->kyc_pep = $request->kyc_pep;
        $kyc->kyc_us_person = $request->kyc_us_person;
        $kyc->kyc_employment_status = $request->kyc_employment_status;
        $kyc->kyc_other_employement = $request->kyc_other_employement;
        $kyc->kyc_nature_of_business = $request->kyc_nature_of_business;
        $kyc->kyc_nature_of_business_specify = $request->kyc_nature_of_business_specify;
        $kyc->kyc_marital_status = $request->kyc_marital_status;
        $kyc->kyc_spouse_name = $request->kyc_spouse_name;
        $kyc->kyc_spouse_job = $request->kyc_spouse_job;
        $kyc->save();

        $jointcount = $account->jointHolders()->count();
        $count = 0;
        foreach ($account->jointHolders()->get() as $jointHolder) {

            if ($jointHolder->hasKycWithInvestmentId($investment_id, $account_id)) {
                $count = $count + 1;
            }
        }

        if ($investment_id == 0) {
            if ($jointcount == $count) {
                $account->kyc = 1;
                $account->pre = 0;
                $account->save();
            }

            Auth::logout();
            return view('client.jointHolderMessage');
        } else {

            return redirect(route('client.investment.proceed'))->with('message', "KYC filled Now you can Accept Request");
        }
    }
    public function jointKYCChange($id, $link)
    {


        $jointHolder = JoinHolderChange::where('kyc_link', $link)->first();
        $user = $jointHolder->user;
        $investment_id = $id;
        if (!Auth::check()) {
            Auth::logout();
        }


        //    $user->login();
        Auth::login($user);
        //    dd($jointHolder);


        return view('client.kycJointClientChanges', compact('jointHolder', 'user', 'investment_id'));
    }

    public function jointChange($id, $investment_id)
    {

        $jointHolder = JoinHolderChange::where('id', $id)->first();






        return view('client.kycJointChangeForm', compact('jointHolder', 'investment_id'));
    }
    public function jointChangeStore(Request $request, $id, $investment_id)
    {

        $request->validate([
            'kyc_nature_of_business' => 'required',
            'kyc_employment' => 'required',
            'kyc_employer_address' => 'required',
            'kyc_account_at_NSB_FMC' => 'required',
            'kyc_purpose_of_opening_account' => 'required',
            'kyc_source_of_funds' => 'required',
            'kyc_anticipated_volume' => 'required',
            'kyc_expected_mode_of_transacation' => 'required',
            'kyc_operation_authority' => 'required',

        ]);

        $jointHolderChange = JoinHolderChange::find($id);
        $account = Account::find($jointHolderChange->account_id);
        $accounChange = $account->accountChange;



        $kyc = new KYCJointForm();
        $kyc->joint_id = $id;
        $kyc->investment_id = $request->investment_id;
        $kyc->kyc_nature_of_business = $request->kyc_nature_of_business;
        $kyc->kyc_employment = $request->kyc_employment;
        $kyc->kyc_employer_address = $request->kyc_employer_address;
        $kyc->kyc_account_at_NSB_FMC = $request->kyc_account_at_NSB_FMC;
        $kyc->kyc_ownership_of_premises = $request->kyc_ownership_of_premises;
        $kyc->kyc_foreign_address = $request->kyc_foreign_address;
        $kyc->kyc_citizenship = $request->kyc_citizenship;
        $kyc->kyc_residence = $request->kyc_residence;
        $kyc->kyc_country_of_birth = $request->kyc_country_of_birth;
        $kyc->kyc_country_of_residence = $request->kyc_country_of_residence;
        $kyc->kyc_nationality = $request->kyc_nationality;
        $kyc->kyc_type_of_visa = $request->kyc_type_of_visa;
        $kyc->kyc_other_visa_type = $request->kyc_other_visa_type;
        $kyc->kyc_expiry_date = $request->kyc_expiry_date;
        $kyc->kyc_purpose_account_foreign = $request->kyc_purpose_account_foreign;
        $kyc->kyc_purpose_of_opening_account = $request->kyc_purpose_of_opening_account;
        $kyc->kyc_other_purpose = $request->kyc_other_purpose;
        $kyc->kyc_source_of_funds = $request->kyc_source_of_funds;
        $kyc->kyc_other_source = $request->kyc_other_source;
        $kyc->kyc_anticipated_volume = $request->kyc_anticipated_volume;
        $kyc->kyc_expected_mode_of_transacation = $request->kyc_expected_mode_of_transacation;
        $kyc->kyc_other_connected_businesses = $request->kyc_other_connected_businesses;
        $kyc->kyc_expected_types_of_counterparties = $request->kyc_expected_types_of_counterparties;
        $kyc->kyc_operation_authority = $request->kyc_operation_authority;
        $kyc->kyc_other_name = $request->kyc_other_name;
        $kyc->kyc_other_address = $request->kyc_other_address;
        $kyc->kyc_other_nic = $request->kyc_other_nic;
        $kyc->kyc_relationship = $request->kyc_relationship;
        $kyc->kyc_pep = $request->kyc_pep;
        $kyc->kyc_us_person = $request->kyc_us_person;
        $kyc->kyc_employment_status = $request->kyc_employment_status;
        $kyc->kyc_other_employement = $request->kyc_other_employement;
        $kyc->kyc_nature_of_business = $request->kyc_nature_of_business;
        $kyc->kyc_nature_of_business_specify = $request->kyc_nature_of_business_specify;
        $kyc->kyc_marital_status = $request->kyc_marital_status;
        $kyc->kyc_spouse_name = $request->kyc_spouse_name;
        $kyc->kyc_spouse_job = $request->kyc_spouse_job;

        $kyc->save();






        $jointcount = $account->jointHolders()->count();
        $count = 0;
        foreach ($account->joinHolderChanges()->get() as $jointHolder) {

            if ($jointHolder->hasKyc()) {
                $count = $count + 1;
            }
        }
        if ($jointcount == $count) {
            $accounChange->kyc = 1;
            $accounChange->pre = 0;
            $accounChange->save();
        }




        if ($investment_id == 0) {
            Auth::logout();
            return view('client.jointHolderMessage');
        } else {

            return redirect(route('client.investment.proceed'))->with('message', "KYC filled Now you can Accept Request");
        }
    }



    public function signature($id)
    {

        $signature = CompanySignature::findOrFail($id);





        return view('client.kycSignatureForm', compact('signature'));
    }


    public function signatureStore(Request $request, $id)
    {

        $request->validate([
            'kyc_nature_of_business' => 'required',
            'kyc_employment' => 'required',
            'kyc_employer_address' => 'required'

        ]);

        $client = Auth::user()->client;

        $kyc = new KYCCompanySignatureForms();
        $kyc->id = $id;
        $kyc->kyc_nature_of_business = $request->kyc_nature_of_business;
        $kyc->kyc_employment = $request->kyc_employment;
        $kyc->kyc_employer_address = $request->kyc_employer_address;
        $kyc->kyc_account_at_NSB_FMC = $request->kyc_account_at_NSB_FMC;
        $kyc->kyc_ownership_of_premises = $request->kyc_ownership_of_premises;
        $kyc->kyc_foreign_address = $request->kyc_foreign_address;
        $kyc->kyc_citizenship = $request->kyc_citizenship;
        $kyc->kyc_country_of_birth = $request->kyc_country_of_birth;
        $kyc->kyc_country_of_residence = $request->kyc_country_of_residence;
        $kyc->kyc_nationality = $request->kyc_nationality;
        $kyc->kyc_type_of_visa = $request->kyc_type_of_visa;
        $kyc->kyc_other_visa_type = $request->kyc_other_visa_type;
        $kyc->kyc_expiry_date = $request->kyc_expiry_date;
        $kyc->kyc_purpose_account_foreign = $request->kyc_purpose_account_foreign;
        $kyc->kyc_purpose_of_opening_account = $request->kyc_purpose_of_opening_account;
        $kyc->kyc_other_purpose = $request->kyc_other_purpose;
        $kyc->kyc_source_of_funds = $request->kyc_source_of_funds;
        $kyc->kyc_other_source = $request->kyc_other_source;
        $kyc->kyc_anticipated_volume = $request->kyc_anticipated_volume;
        $kyc->kyc_expected_mode_of_transacation = $request->kyc_expected_mode_of_transacation;
        $kyc->kyc_other_connected_businesses = $request->kyc_other_connected_businesses;
        $kyc->kyc_expected_types_of_counterparties = $request->kyc_expected_types_of_counterparties;
        $kyc->kyc_operation_authority = $request->kyc_operation_authority;
        $kyc->kyc_other_name = $request->kyc_other_name;
        $kyc->kyc_other_address = $request->kyc_other_address;
        $kyc->kyc_other_nic = $request->kyc_other_nic;


        $kyc->save();




        if ($client->hasKyc()) {
            $companySignaturesCount = $client->companySignatures()->count();
            $count = 0;
            foreach ($client->companySignatures()->get() as $signature) {

                if ($signature->hasKyc()) {
                    $count = $count + 1;
                }
            }
            if ($companySignaturesCount == $count) {

                $thisInvestment = $client->investmentsWithType($request->investment_type);
                $thisInvestment->kyc = 1;
                $thisInvestment->save();
            }
        }

        return redirect()->back();
    }


    public function company($id, $investment_id)
    {

        $company = Company::findOrFail($id);





        return view('client.kycCompany', compact('company', 'investment_id'));
    }


    public function companyStore(Request $request, $id, $investment_id)
    {


        $client = Auth::user()->client;
        $request->validate([
            'kyc_property' => 'required',
            'kyc_motor_vehicles' => 'required',
            'kyc_financial_assets' => 'required',
            'kyc_investments' => 'required',
            'kyc_account_at_NSB_FMC' => 'required',
            'kyc_purpose_of_opening_account' => 'required',
            'kyc_source_of_funds' => 'required',
            'kyc_anticipated_volume' => 'required',
            'kyc_expected_mode_of_transacation' => 'required',


        ]);


        $kyc = new KYCCompany;
        $kyc->company_id = $id;
        $kyc->investement_id = $request->investment_id;
        $kyc->kyc_account_at_NSB_FMC = $request->kyc_account_at_NSB_FMC;
        $kyc->kyc_foreign_address = $request->kyc_foreign_address;
        $kyc->kyc_countries = $request->kyc_countries;
        $kyc->kyc_purpose_of_opening_account = $request->kyc_purpose_of_opening_account;
        $kyc->kyc_other_purpose = $request->kyc_other_purpose;
        $kyc->kyc_source_of_funds = $request->kyc_source_of_funds;
        $kyc->kyc_other_source = $request->kyc_other_source;
        $kyc->kyc_anticipated_volume = $request->kyc_anticipated_volume;
        $kyc->kyc_expected_mode_of_transacation = $request->kyc_expected_mode_of_transacation;
        $kyc->kyc_other_connected_businesses = $request->kyc_other_connected_businesses;
        $kyc->kyc_property = $request->kyc_property;
        $kyc->kyc_motor_vehicles = $request->kyc_motor_vehicles;
        $kyc->kyc_financial_assets = $request->kyc_financial_assets;
        $kyc->kyc_investments = $request->kyc_investments;
        $kyc->other_assets_name = $request->other_assets_name;
        $kyc->other_assets_value = $request->other_assets_value;
        $kyc->has_foreign_investors = $request->has_foreign_investors;

        $kyc->save();

        if ($kyc->has_foreign_investors == 1) {

            for ($i = 0; $i < count($request->foreign_investor_name); $i++) {
                if ($request->foreign_investor_name[$i] != null) {
                    KYCCompanyForeignInvestor::create([
                        'company_id' => $kyc->id,
                        'name' => $request->foreign_investor_name[$i],
                        'country' => $request->country[$i],
                        'percentage' => $request->percentage[$i],
                    ]);
                }
            }
        }

        $thisInvestment = $client->investmentsWithType($request->investment_id);
        $thisInvestment->kyc = 1;
        $thisInvestment->save();

        //     $companySignaturesCount = $client->companySignatures()->count();
        //     $count =0;
        //    foreach($client->companySignatures()->get() as $signature){

        //        if($signature->hasKyc()){
        //            $count = $count+1;
        //        }
        //    }
        //    if($companySignaturesCount == $count){
        //        $client->kyc = 1;
        //        $client->save();

        //    }


        if ($thisInvestment->is_main == 1) {
            return redirect()->route('client.kyc.index');
        } else {


            return redirect()->route('client.investment.form', $request->investment_id);
        }
    }
}