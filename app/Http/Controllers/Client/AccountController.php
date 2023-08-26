<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Account;
use App\AuthorizedPerson;
use App\Bank;
use App\BankParticular;
use App\Branch;
use App\Client;
use App\EmploymentDetails;
use App\InvestmentType;
use App\JointHolder;
use App\KYCForm;
use App\OtherDetails;
use App\RealTimeNotificationSetting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function all(){

        $user = Auth::user();
        $client = $user->client;
        $accounts = $client->accounts()->get();

         return view('client.accounts.all', compact('client', 'user','accounts'));
    }
    public function index($account_id=0)
    {

        $user = Auth::user();

       


        $investment_types = InvestmentType::all();
        $banks = Bank::orderBy('name', 'ASC')->with('branches')->get();
        $banksJson = $banks->toJson();
        $account="";

        $branches = Branch::orderBy('name', 'ASC')->get();
        $branches = $branches->toJson();
        if ($account_id != 0) {
            $account = Account::findOrFail($account_id);
            if ($account->pre == 0) {


                return redirect()->route('registration.end');
            } else {

                $account_type = $account->type;

                return view('client.accounts.accountType', compact('banksJson', 'branches', 'investment_types', 'banks', 'user', 'account','account_id', 'account_type'));
            }
        } else {
            $account_type = 1;
            
            return view('client.accounts.accountType', compact('banksJson', 'branches', 'investment_types', 'banks', 'user', 'account','account_id', 'account_type'));
        }
    }

    public function accountTypeSave(Request $request,$account_id=0)
    {

        $user = Auth::user();

       
        // dd($account);

        if ($account_id == 0) {

            $account = Account::create([
                'client_id' => $user->id,
                'type' => $request->client_type,
                'joint_permission' => $request->joint_permission,
                'pre' => 1,

            ]);
        } else {
            $account = Account::findOrFail($account_id);
            $account->update([
                'type' => $request->client_type,
                'joint_permission' => $request->joint_permission,
                'pre' => 1,
            ]);
        }

        return redirect()->route('client.newAccountBasicInfo',$account->id);
    }
    public function basicInfoShow($account_id=0)
    {

        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);

        return view('client.accounts.mainUserInfo', compact('user', 'account', 'client'));
    }

    public function basicinfoSave(Request $request,$account_id=0)
    {



        $user = Auth::user();

        if ($request->nationality == "other") {

            $nationality = $request->other_nationality;
        } else {
            $nationality = 'Sri Lankan';
        }
        $account = Account::findOrFail($account_id);


        $user_id = $user->id;
        $client = $user->client;

        if ($client == null) {

            $client = Client::create([
                'id' => $user->id,
                'password' => '',
                'name' => $request->name,
                'name_by_initials' => $request->name_initials,
                'dob' => $request->dob,
                'nic' => $request->nic,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'address_line_3' => $request->address_line_3,
                'correspondence_address_line_1' => $request->corresponding_address_line_1,
                'correspondence_address_line_2' => $request->corresponding_address_line_2,
                'correspondence_address_line_3' => $request->corresponding_address_line_3,
                'client_type' => $account->type,
                'title' => $request->title,
                'nationality' => $nationality,
                'telephone' => $request->telephone,
                'mobile' => $request->full_mobile,


            ]);
        } else {


            $client->update([

                // 'id' => $user->id,
                'password' => '',
                'name' => $request->name,
                'name_by_initials' => $request->name_initials,
                'dob' => $request->dob,
                'nic' => $request->nic,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'address_line_3' => $request->address_line_3,
                'correspondence_address_line_1' => $request->corresponding_address_line_1,
                'correspondence_address_line_2' => $request->corresponding_address_line_2,
                'correspondence_address_line_3' => $request->corresponding_address_line_3,
                'client_type' => $account->type,
                'title' => $request->title,
                'nationality' => $nationality,
                'telephone' => $request->telephone,
                'mobile' => $request->full_mobile,



            ]);
        }



        $destinationPath = storage_path('app/public/uploads/');



        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');



            $signature_name = time() . '_' . $signature->getClientOriginalName();
            $signature->move($destinationPath, $signature_name);
            Client::where('id', $user_id)->update([

                'signature' => $signature_name,
            ]);
        }




        //billing proof... save
        if ($request->hasFile('billing_proof')) {

            $billing_proof = $request->file('billing_proof');
            $billing_proof_name = time() . '_' . $billing_proof->getClientOriginalName();
            $billing_proof->move($destinationPath, $billing_proof_name);



            Client::where('id', $user_id)->update([

                'billing_proof' => $billing_proof_name,
            ]);
        }

        //profile_pic... save
        if ($request->hasFile('pro_pic')) {

            $pro_pic = $request->file('pro_pic');
            $pro_pic_name = time() . '_' . $pro_pic->getClientOriginalName();
            $pro_pic->move($destinationPath, $pro_pic_name);

            Client::where('id', $user_id)->update([

                'pro_pic' => $pro_pic_name,
            ]);
        }




        if ($request->nationality == "other") {

            AuthorizedPerson::create([
                'client_id' => $user_id,
                'name' => $request->authorized_name,
                'address' => $request->authorized_address,
                'nic' => $request->authorized_nic,
                'telephone' => $request->authorized_telephone,
            ]);

            if ($request->hasFile('nic_front')) {
                $passport = $request->file('passport');
                $passport_name = time() . '.' . $passport->extension();
                $passport->move($destinationPath, $passport_name);

                Client::where('id', $user_id)->update([
                    'passport' => $passport_name

                ]);
            }
        } else {

            if ($request->hasFile('nic_front')) {

                $nic_front = $request->file('nic_front');
                $nic_front_name = time() . '_' . $nic_front->getClientOriginalName();
                $nic_front->move($destinationPath, $nic_front_name);
                Client::where('id', $user_id)->update([

                    'nic_front' => $nic_front_name,
                ]);
            }
            if ($request->hasFile('nic_front')) {

                $nic_back = $request->file('nic_back');
                $nic_back_name = time() . '_' . $nic_back->getClientOriginalName();
                $nic_back->move($destinationPath, $nic_back_name);

                Client::where('id', $user_id)->update([

                    'nic_back' => $nic_back_name,
                ]);
            }
        }

        if ($account->type == 2) {



            // Client::where('id', $user_id)->update([
            //     'joint_permission' => $request->joint_permission,

            // ]);


            $joint_signature_array = $request->file('joint_signature');
            $joint_nic_front_array = $request->file('joint_nic_front');
            $joint_nic_back_array = $request->file('joint_nic_back');
            $joint_passport_array = $request->file('joint_passport');
            $joint_pro_pic_array = $request->file('joint_pro_pic');



            for ($i = 0; $i < count($request->joint_name); $i++) {

                $password_joint = Str::random(8);
                $kyc_link_1 = Str::random(15);
               

                $joint_user = User::where('email', $request->joint_email[$i])->first();

                if ($request->joint_nationality[$i] == "other") {
                    $joint_nationality = $request->joint_nationality_other[$i];
                } else {
                    $joint_nationality = 'Sri Lankan';
                }


                if ($joint_user == null) {
                    $joint_user = User::create([
                        'email' => $request->joint_email[$i],
                        'name' => $request->joint_name[$i],
                        'password' => Hash::make($password_joint),

                    ]);

                    $joint_user->roles()->attach(10);
                    $link = $joint_user->id . $kyc_link_1;
                } else {

                    $joint_user->update([
                        'name' => $request->joint_name[$i],
                        'password' => Hash::make($password_joint),
                    ]);
                    $link = $joint_user->id . $kyc_link_1;

                }

                $jointHolder = JointHolder::where('user_id',$joint_user->id)->first();

                    if($jointHolder==null){


                        $jointHolder = JointHolder::create([
                            'client_id' => $user_id,
                            'account_id' => $account->id,
                            'user_id' => $joint_user->id,
                            'password' => $password_joint,
                            'name' => $request->joint_name[$i],
                            'name_by_initials' => $request->joint_name_initials[$i],
                            'title' => $request->joint_title[$i],
                            'dob' => $request->joint_dob[$i],
                            'nic' => $request->joint_nic[$i],
                            'nationality' => $joint_nationality,
                            'email' => $request->joint_email[$i],
                            'address_line_1' => $request->joint_address_line_1[$i],
                            'address_line_2' => $request->joint_address_line_2[$i],
                            'address_line_3' => $request->joint_address_line_3[$i],
                            'correspondence_address_line_1' => $request->joint_address_line_1[$i],
                            'correspondence_address_line_2' => $request->joint_address_line_2[$i],
                            'correspondence_address_line_3' => $request->joint_address_line_3[$i],
                            'telephone' => $request->joint_telephone[$i],
                            'mobile' => $request->full_joint_mobile[$i],
                            // 'occupation' => $request->joint_emp_occupation[$i],
                            // 'company_name' => $request->joint_emp_company_name[$i],
                            // 'company_address' => $request->joint_emp_company_address[$i],
                            // 'company_telephone' => $request->joint_emp_company_telephone[$i],
                            // 'company_fax' => $request->joint_emp_fax[$i],
                            // 'company_nature' => $request->joint_emp_nature[$i],
                            'kyc_link' =>  $link,
    
                        ]);
                   
    


                    }else{

                        $jointHolder = JointHolder::where('client_id', $user_id)->where('account_id', $account->id)->first();
                        $jointHolder->update([
    
                            'client_id' => $user_id,
                            'account_id' => $account->id,
                            'user_id' => $joint_user->id,
                            'password' => $password_joint,
                            'name' => $request->joint_name[$i],
                            'name_by_initials' => $request->joint_name_initials[$i],
                            'title' => $request->joint_title[$i],
                            'dob' => $request->joint_dob[$i],
                            'nic' => $request->joint_nic[$i],
                            'nationality' => $joint_nationality,
                            'email' => $request->joint_email[$i],
                            'address_line_1' => $request->joint_address_line_1[$i],
                            'address_line_2' => $request->joint_address_line_2[$i],
                            'address_line_3' => $request->joint_address_line_3[$i],
                            'correspondence_address_line_1' => $request->joint_address_line_1[$i],
                            'correspondence_address_line_2' => $request->joint_address_line_2[$i],
                            'correspondence_address_line_3' => $request->joint_address_line_3[$i],
                            'telephone' => $request->joint_telephone[$i],
                            'mobile' => $request->full_joint_mobile[$i],
    
                        ]);





                    }

                 
                if ($joint_signature_array != null) {

                    $joint_signature = $joint_signature_array[$i];
                    $joint_signature_name = time() . '_' . $joint_signature->getClientOriginalName();
                    $joint_signature->move($destinationPath, $joint_signature_name);
                    JointHolder::where('id', $jointHolder->id)->update([

                        'signature' => $joint_signature_name,
                    ]);
                }

                if ($joint_pro_pic_array != null) {
                    $joint_pro_pic = $joint_pro_pic_array[$i];
                    $joint_pro_pic_name = time() . '_' . $joint_pro_pic->getClientOriginalName();
                    $joint_pro_pic->move($destinationPath, $joint_pro_pic_name);
                    JointHolder::where('id', $jointHolder->id)->update([

                        'pro_pic' => $joint_pro_pic_name,
                    ]);
                }

                if ($request->joint_nationality[$i] == "other") {
                    if ($joint_passport_array != null) {
                        $joint_passport = $joint_passport_array[$i];
                        $joint_passport_name = time() . '_' . $joint_passport->getClientOriginalName();
                        $joint_passport->move($destinationPath, $joint_passport_name);

                        JointHolder::where('id', $jointHolder->id)->update([
                            'passport' => $joint_passport_name

                        ]);
                    }
                } else {
                    if ($joint_nic_front_array != null && $joint_nic_back_array != null) {
                        $joint_nic_front = $joint_nic_front_array[$i];
                        $joint_nic_front_name = time() . '_' . $joint_nic_front->getClientOriginalName();
                        $joint_nic_front->move($destinationPath, $joint_nic_front_name);

                        $joint_nic_back = $joint_nic_back_array[$i];
                        $joint_nic_back_name = time() . '_' . $joint_nic_back->getClientOriginalName();
                        $joint_nic_back->move($destinationPath, $joint_nic_back_name);

                        JointHolder::where('id', $jointHolder->id)->update([
                            'nic_front' => $joint_nic_front_name,
                            'nic_back' => $joint_nic_back_name,
                        ]);
                    }
                }

                // Mail::send('emails.jointholderKyc', ['name' => $request->joint_name[$i],'email'=>$request->joint_email[$i],'link'=>$link,'joint_id'=>0], function($message) use($request,$i){
                //     $message->to($request->joint_email[$i]);
                //     $message->subject('Need to Fill KYC Forms NSB FMC '.$request->joint_name[$i]);
                // });

            }
        }
        return redirect()->route('client.newAccountEmpInfo',$account_id);
    }
    public function employmentDetailsShow($account_id=0)
    {

        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);

        return view('client.accounts.employement', compact('user', 'account', 'client'));
    }
    public function employmentDetailsSave(Request $request,$account_id=0)
    {

        $user = Auth::user();
        $client = $user->client;
        $empDetails = $client->employmentDetails;
        $account = Account::findOrFail($account_id);
        // dd($empDetails);
        if ($empDetails == null) {

            EmploymentDetails::create([
                'id' => $user->id,
                'occupation' => $request->emp_occupation,
                'company_name' => $request->emp_company_name,
                'company_address' => $request->emp_company_address,
                'telephone' => $request->emp_company_telephone,
                'fax' => $request->emp_fax,
                'nature' => $request->emp_nature,
            ]);
        } else {


            $empDetails->update([
                'occupation' => $request->emp_occupation,
                'company_name' => $request->emp_company_name,
                'company_address' => $request->emp_company_address,
                'telephone' => $request->emp_company_telephone,
                'fax' => $request->emp_fax,
                'nature' => $request->emp_nature

            ]);
        }

        if($account->type==2){
            for ($i = 0; $i < count($request->jointHolder_emp_id); $i++) {
                JointHolder::where('id', $request->jointHolder_emp_id[$i])->update([
    
                    'occupation' => $request->joint_emp_occupation[$i],
                    'company_name' => $request->joint_emp_company_name[$i],
                    'company_address' => $request->joint_emp_company_address[$i],
                    'company_telephone' => $request->joint_emp_company_telephone[$i],
                    'company_fax' => $request->joint_emp_fax[$i],
                    'company_nature' => $request->joint_emp_nature[$i],
    
    
    
                ]);
            }
        }

        





        // return view('client.registration.employement', compact('user', 'account'));

        return redirect()->route('client.newAccountBank',$account->id);
    }


    public function bankParticularsShow($account_id=0)
    {

        $user = Auth::user();
        $account = Account::findOrFail($account_id);


        $banks = Bank::orderBy('name', 'ASC')->with('branches')->get();
        $banksJson = $banks->toJson();

        $branches = Branch::orderBy('name', 'ASC')->get();
        $branches = $branches->toJson();
        $bankParticulars = BankParticular::where('client_id',$user->id)->where('account_id',$account->id)->get();



        return view('client.accounts.bankparticulars', compact('banksJson', 'branches', 'banks', 'user', 'account','bankParticulars'));
    }

    public function bankParticularsSave(Request $request,$account_id=0)
    {


        $user = Auth::user();
        $account = Account::findOrFail($account_id);
        BankParticular::where('client_id',$user->id)->where('account_id',$account->id)->delete();

        for ($i = 0; $i < count($request->accountType); $i++) {
            if ($request->accountType[$i] != null) {
                BankParticular::create([
                    'client_id' => $user->id,
                    'account_id' => $account->id,
                    'name' => $request->holder_name[$i],
                    'bank_name' => isset($request->bank[$i]) ? $request->bank[$i] : "",
                    'branch' => isset($request->branch[$i]) ? $request->branch[$i] : "",
                    'Account_type' => $request->accountType[$i],
                    'account_no' => $request->accountno[$i],
                ]);
            }
        }

        return redirect()->route('client.newAccountOtherInfo',$account_id);
    }

    public function otherInfoShow($account_id=0)
    {

        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);


        return view('client.accounts.otherInfo', compact('user', 'account','client'));
    }

    public function otherInfoSave(Request $request,$account_id=0)
    {

        $user = Auth::user();

        $client = $user->client;
        $otherInfo = $client->otherDetails;

        if ($otherInfo == null) {

            OtherDetails::create([
                'id' => $user->id,
                'nsb_staff_fund_management' => $request->nsb_staff_fund_management,
                'nsb_staff' => $request->nsb_staff,
                'related_nsb_staff' => $request->related_nsb_staff,
                'staff_relationship' => $request->relationship,
                'member_holding_company' => $request->member_holding_company,
                'member_holding_company_state' => $request->state,

            ]);
        } else {




            $otherInfo->update([

                'nsb_staff_fund_management' => $request->nsb_staff_fund_management,
                'nsb_staff' => $request->nsb_staff,
                'related_nsb_staff' => $request->related_nsb_staff,
                'staff_relationship' => $request->relationship,
                'member_holding_company' => $request->member_holding_company,
                'member_holding_company_state' => $request->state,

            ]);
        }


        if (!$client->hasRealTimeNotification()) {
            RealTimeNotificationSetting::create([

                'id' => $user->id,
                'on_email' => $request->notification_by_email == true ? 1 : 0,
                'email' => $request->notification_email,
                'on_mobile' => $request->notification_by_mobile == true ? 1 : 0,
                'mobile' => $request->notification_mobile,

            ]);
        } else {

            $realTimeNotification = $client->realTimeNotification;
            $realTimeNotification->update([
                'on_email' => $request->notification_by_email == true ? 1 : 0,
                'email' => $request->notification_email,
                'on_mobile' => $request->notification_by_mobile == true ? 1 : 0,
                'mobile' => $request->notification_mobile,

            ]);
        }




        return redirect()->route('client.newAccountKyc',$account_id);
    }

    public function KycShow($account_id=0)
    {

        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);
        
        $kyc = $client->clientKYC($account->id);

        // dd($kyc);

        return view('client.accounts.KYC', compact('user', 'account','kyc'));
    }

    public function KycSave(Request $request,$account_id=0)
    {

        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);
        if ($client->hasClientKYC($account->id)) {
            $kyc = $client->clientKYC($account->id);
            $kyc->kyc_account_at_NSB_FMC = $request->kyc_account_at_NSB_FMC;
            $kyc->kyc_ownership_of_premises = $request->kyc_ownership_of_premises;
            $kyc->kyc_foreign_address = "";
            $kyc->kyc_citizenship = $request->kyc_citizenship;
            $kyc->kyc_residence = $request->address_line_1 . ' ' . $request->address_line_2 . ' ' . $request->address_line_3;
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
        } else {

            $kyc = new KYCForm;
            $kyc->client_id = $user->id;
            $kyc->account_id = $account->id;
            $kyc->investment_id = 0;
            $kyc->kyc_account_at_NSB_FMC = $request->kyc_account_at_NSB_FMC;
            $kyc->kyc_ownership_of_premises = $request->kyc_ownership_of_premises;
            $kyc->kyc_foreign_address = "";
            $kyc->kyc_citizenship = $request->kyc_citizenship;
            $kyc->kyc_residence = $request->address_line_1 . ' ' . $request->address_line_2 . ' ' . $request->address_line_3;
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
        }
        return redirect()->route('client.newAccountStatement',$account_id);
    }
    public function statement($account_id=0)
    {
        $account = Account::findOrFail($account_id);

        return view('client.accounts.statement',compact('account'));
    }

    public function finish(Request $request,$account_id=0)
    {
        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);

      

        if ($request->acceptCheck) {

            if ($account->type == 2) {

                $jointHolders = JointHolder::where('account_id', $account->id)->where('client_id', $client->id)->get();

                foreach ($jointHolders as $jointHolder) {

                    Mail::send('emails.jointholderKyc', ['name' => $jointHolder->name, 'email' => $jointHolder->email, 'link' => $jointHolder->kyc_link, 'joint_id' => 0], function ($message) use ($jointHolder) {
                        $message->to($jointHolder->email);
                        $message->subject('Need to Fill KYC Forms NSB FMC ' . $jointHolder->name);
                    });
                }
            } else {

                $account->pre = 0;
                $account->save();
            }
        } else {
        }

        return redirect()->route('client.newAccountEnd',$account_id);
    }

    public function end($account_id=0)
    {
        $account = Account::findOrFail($account_id);

        return view('client.accounts.finish',compact('account'));
    }
}