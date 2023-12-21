<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Account;
use App\AccountJointHolder;
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
    public function all()
    {

        $user = Auth::user();
        $client = $user->client;
        $accounts = $client->accounts()->get();

        return view('client.accounts.all', compact('client', 'user', 'accounts'));
    }
    public function index($account_id = 0)
    {
        $user = Auth::user();
        $account = '';
        $title = 'account';
        if ($account_id != 0) {
            $account = Account::findOrFail($account_id);
        
            if ($account->pre == 0) {

                return redirect()->route('client.newAccountEnd', $account_id);
            } else {
                $account_type = $account->type;
                $account_id = $account->id;
                return view('client.accounts.accountType', compact('user', 'account', 'account_id', 'account_type','title'));
            }
        } else {
            $account_type = 1;
            $account_id=0;

            return view('client.accounts.accountType', compact('user', 'account', 'account_id', 'account_type','title'));
        }
    }

    public function accountTypeSave(Request $request, $account_id = 0)
    {
        $user = Auth::user();
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

        return redirect()->route('client.newAccountBasicInfo', $account->id);
    }
    public function basicInfoShow($account_id = 0)
    {

        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);
        $account_type = $account->type;
        $account_id = $account->id;
        $title = 'basic';

        return view('client.accounts.mainUserInfo', compact('user', 'account', 'client','title','account_type','account_id'));
    }

    public function basicinfoSave(Request $request, $account_id = 0)
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

            if ($request->hasFile('passport')) {
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
        $send['success'] = true;
        return response()->json($send);
    }
    public function jointHolderShow($account_id)
    {
        $user = Auth::user();
        $client = $user->client;
        $account = Account::find($account_id);
        $account_type = $account->type;
        $title = 'joint';
        $account_id= $account->id;

        return view('client.accounts.jointHolder', compact('user', 'account', 'client', 'account_type', 'title','account_id'));
    }

    public function checkJointUser(Request $request)
    {

        $jointHolder = User::where('email', $request->existingjointEmail)->first();
        if ($jointHolder == null) {
            $send['success'] = false;
            return response()->json($send);
        } else {

            $mobile = $jointHolder->client->mobile;
            $mobile = str_replace("+", "", $mobile);
            $randomRef = rand(10000, 99999);


            // dd($mobile);


            $otp =  Otp::setValidity(1500)  // otp validity time in mins
                ->setLength(6)  // Lenght of the generated otp
                ->setMaximumOtpsAllowed(10) // Number of times allowed to regenerate otps
                ->setOnlyDigits(true)  // generated otp contains mixed characters ex:ad2312
                ->setUseSameToken(false) // if you re-generate OTP, you will get same token
                ->generate($mobile);


            //   dd($otp->token);

            // $verify = Otp::setAllowedAttempts(10) // number of times they can allow to attempt with wrong token
            //     ->validate($mobile, $otp->token);

            error_reporting(E_ALL);
            date_default_timezone_set('Asia/Colombo');
            $now = date("Y-m-d\TH:i:s");
            $username = "nsb_fundmgt";
            $password = "6101144018a53";
            $digest = md5($password);
            $body = '{
                "messages": [
                {
                "clientRef": "' . $randomRef . '",
                "number": "' . $mobile . '",
                "mask": "NSB FMC",
                "text": " Your OTP for registration is ' . $otp->token . '\n NSB Fund Management Co.Ltd",
                "campaignName":"NSB OTP"
                }
          
                ]
                }';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://richcommunication.dialog.lk/api/sms/send");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body); //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = [
                'Content-Type: application/json',
                'USER: ' . $username,
                'DIGEST: ' . $digest,
                'CREATED: ' . $now
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $server_output = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($server_output);
            // dd($result);
            // dd($result->messages[0]->resultDesc);

            if ($result->messages[0]->resultDesc == 'SUCCESS' && $result->messages[0]->clientRef == $randomRef) {


                $send['success'] = true;
                $send['mobile'] = $mobile;
                return response()->json($send);
            } else {

                $send['success'] = false;
                return response()->json($send);
            }
        }
    }
    public function addExistingUserAsJointParty(Request $request,$account_id)
    {
        $user = Auth::user();
        $account = Account::find($account_id);

        $jointHolder = User::where('email', $request->existingjointEmail)->first();
        if ($jointHolder == null) {
            $send['success'] = true;
            return response()->json($send);
        } else {

            $kyc_link_1 = Str::random(15);
            $link = $jointHolder->id . $kyc_link_1;

            $accountJointHolder = AccountJointHolder::where('account_id', $account->id)->where('client_id', $jointHolder->id)->first();
            if ($accountJointHolder == null) {
                $accountJointHolder = AccountJointHolder::create([
                    'account_id' => $account->id,
                    'client_id' => $jointHolder->id,
                    'kyc_link' => $link
                ]);
            }
            $send['success'] = true;
            return response()->json($send);
        }
    }

    public function removeJointHolder(Request $request,$account_id)
    {

        $user = Auth::user();
        $account = Account::find($account_id);
        $checkOtherAccountsOfJointHolder = AccountJointHolder::where('client_id', $request->id)->where('account_id', '!=', $account->id)->first();
        $ownAccount = Account::where('client_id', $request->id)->first();

        if ($checkOtherAccountsOfJointHolder == null && $ownAccount == null) {

            //delete user and client and all information  & remove from joint holder account
            $thisJointConnection = AccountJointHolder::where('client_id', $request->id)->where('account_id', $account->id)->first();
            $thisJointConnection->delete();

            $jointClient = Client::find($request->id);
            $jointClient->forceDelete();

            $jointUser = User::find($request->id);
            $jointUser->forceDelete();

        } else {
         

            $thisJointConnection = AccountJointHolder::where('client_id', $request->id)->where('account_id', $account->id)->first();
            $thisJointConnection->delete();
        }
        $send['success'] = true;
        return response()->json($send);

    }


    public function jointHolderSave(Request $request,$account_id)
    {
        $user = Auth::user();
        $account = Account::find($account_id);
        $destinationPath = storage_path('app/public/uploads/');

        $password_joint = Str::random(8);
        $kyc_link_1 = Str::random(15);

        $joint_user = User::where('email', $request->joint_email)->first();

        if ($request->joint_nationality == "other") {
            $joint_nationality = $request->joint_nationality_other;
        } else {
            $joint_nationality = 'Sri Lankan';
        }
        if ($joint_user == null) {
            $joint_user = User::create([
                'email' => $request->joint_email,
                'name' => $request->joint_name,
                'password' => Hash::make($password_joint),

            ]);

            $joint_user->roles()->attach(4);
            $link = $joint_user->id . $kyc_link_1;
        } else {

            $joint_user->update([
                'name' => $request->joint_name,
                // 'password' => Hash::make($password_joint),
            ]);
            $link = $joint_user->id . $kyc_link_1;
        }

        $jointHolder = Client::find($joint_user->id);

        if ($jointHolder == null) {

            $jointHolder = Client::create([
                'id' => $joint_user->id,
                'account_id' => $account->id,
                'password' => $password_joint,
                'name' => $request->joint_name,
                'name_by_initials' => $request->joint_name_initials,
                'title' => $request->joint_title,
                'dob' => $request->joint_dob,
                'nic' => $request->joint_nic,
                'nationality' => $joint_nationality,
                'email' => $request->joint_email,
                'address_line_1' => $request->joint_address_line_1,
                'address_line_2' => $request->joint_address_line_2,
                'address_line_3' => $request->joint_address_line_3,
                'correspondence_address_line_1' => $request->joint_address_line_1,
                'correspondence_address_line_2' => $request->joint_address_line_2,
                'correspondence_address_line_3' => $request->joint_address_line_3,
                'telephone' => $request->joint_telephone,
                'mobile' => $request->full_mobile,
            ]);
        } else {

            $jointHolder->update([
                'account_id' => $account->id,
                'user_id' => $joint_user->id,
                'password' => $password_joint,
                'name' => $request->joint_name,
                'name_by_initials' => $request->joint_name_initials,
                'title' => $request->joint_title,
                'dob' => $request->joint_dob,
                'nic' => $request->joint_nic,
                'nationality' => $joint_nationality,
                'email' => $request->joint_email,
                'address_line_1' => $request->joint_address_line_1,
                'address_line_2' => $request->joint_address_line_2,
                'address_line_3' => $request->joint_address_line_3,
                'correspondence_address_line_1' => $request->joint_address_line_1,
                'correspondence_address_line_2' => $request->joint_address_line_2,
                'correspondence_address_line_3' => $request->joint_address_line_3,
                'telephone' => $request->joint_telephone,
                'mobile' => $request->full_mobile,

            ]);
        }

        if ($request->hasFile('joint_signature')) {
            $joint_signature = $request->file('joint_signature');
            $joint_signature_name = time() . '_' . $joint_signature->getClientOriginalName();
            $joint_signature->move($destinationPath, $joint_signature_name);
            Client::where('id', $joint_user->id)->update([

                'signature' => $joint_signature_name,
            ]);
        }

        if ($request->hasFile('joint_pro_pic')) {
            $joint_pro_pic = $request->file('joint_pro_pic');
            $joint_pro_pic_name = time() . '_' . $joint_pro_pic->getClientOriginalName();
            $joint_pro_pic->move($destinationPath, $joint_pro_pic_name);
            Client::where('id', $joint_user->id)->update([

                'pro_pic' => $joint_pro_pic_name,
            ]);
        }

        if ($request->joint_nationality == "other") {
            if ($request->hasFile('joint_passport')) {
                $joint_passport = $request->file('joint_passport');
                $joint_passport_name = time() . '_' . $joint_passport->getClientOriginalName();
                $joint_passport->move($destinationPath, $joint_passport_name);

                Client::where('id', $joint_user->id)->update([
                    'passport' => $joint_passport_name

                ]);
            }
        } else {

            if ($request->hasFile('joint_nic_front')) {
                $joint_nic_front = $request->file('joint_nic_front');
                $joint_nic_front_name = time() . '_' . $joint_nic_front->getClientOriginalName();
                $joint_nic_front->move($destinationPath, $joint_nic_front_name);
                Client::where('id', $joint_user->id)->update([
                    'nic_front' => $joint_nic_front_name,

                ]);
            }

            if ($request->hasFile('joint_nic_back')) {
                $joint_nic_back = $request->file('joint_nic_back');
                $joint_nic_back_name = time() . '_' . $joint_nic_back->getClientOriginalName();
                $joint_nic_back->move($destinationPath, $joint_nic_back_name);
                Client::where('id', $joint_user->id)->update([

                    'nic_back' => $joint_nic_back_name,
                ]);
            }
        }
        $accountJointHolder = AccountJointHolder::where('account_id', $account->id)->where('client_id', $jointHolder->id)->first();
        if ($accountJointHolder == null) {
            $accountJointHolder = AccountJointHolder::create([
                'account_id' => $account->id,
                'client_id' => $joint_user->id,
                'kyc_link' => $link
            ]);
        }
    }

    public function employmentDetailsShow($account_id = 0)
    {

        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);
        $title = 'employment';
        $account_type = $account->type;

        return view('client.accounts.employement', compact('user', 'account', 'client','title','account_type','account_id'));
    }
    public function employmentDetailsSave(Request $request, $account_id = 0)
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

        if ($account->type == 2) {
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

        return redirect()->route('client.newAccountBank', $account->id);
    }


    public function bankParticularsShow($account_id = 0)
    {

        $user = Auth::user();
        $account = Account::findOrFail($account_id);


        $banks = Bank::orderBy('name', 'ASC')->with('branches')->get();
        $banksJson = $banks->toJson();

        $branches = Branch::orderBy('name', 'ASC')->get();
        $branches = $branches->toJson();
        $bankParticulars = BankParticular::where('client_id', $user->id)->where('account_id', $account->id)->get();
        $title = 'bank';
        $account_id = $account->id;
        $account_type = $account->type;



        return view('client.accounts.bankparticulars', compact('banksJson', 'branches', 'banks', 'user', 'account', 'bankParticulars','account_id','title','account_type'));
    }

    public function bankParticularsSave(Request $request, $account_id = 0)
    {


        $user = Auth::user();
        $account = Account::find($account_id);
        // BankParticular::where('client_id', $user->id)->where('account_id', $account->id)->delete();

        // for ($i = 0; $i < count($request->accountType); $i++) {
        if ($request->accountType != null) {
            $bankParticular = BankParticular::create([
                'client_id' => $user->id,
                'account_id' => $account->id,
                'name' => $request->holder_name,
                'bank_name' => $request->bank_name,
                'branch' => $request->branch,
                'Account_type' => $request->accountType,
                'account_no' => $request->accountNo,
            ]);
            $destinationPath =  storage_path('app/public/uploads/passBooks');;

            if ($request->hasFile('passbook')) {

                $passbook = $request->file('passbook');
                $passbook_name = time() . '_' . $passbook->getClientOriginalName();
                $passbook->move($destinationPath, $passbook_name);


                $bankParticular->passbook = $passbook_name;
                $bankParticular->save();
            }
        }
        // }

        return redirect()->back();
    }


    public function otherInfoShow($account_id = 0)
    {

        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);
        $account_type = $account->type;
        $title = 'other';
        $account_id = $account->id;
        return view('client.accounts.otherInfo', compact('user', 'account', 'client','title','account_id','account_type'));
    }

    public function otherInfoSave(Request $request, $account_id = 0)
    {

        $user = Auth::user();

        $client = $user->client;
        $otherInfo = $client->otherDetails;
        $account = Account::find($account_id);
     
        // $account = Account::findOrFail($account_id);
        

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




        return redirect()->route('client.newAccountKyc', $account_id);
    }

    public function KycShow($account_id = 0)
    {

        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);

        $kyc = $client->clientKYC($account->id);
        $title = 'KYC';
        $account_type = $account->type;
        $account_id  = $account->id;

        // dd($kyc);

        return view('client.accounts.KYC', compact('user', 'account', 'kyc','title','account_type','account_id'));
    }

    public function KycSave(Request $request, $account_id = 0)
    {

        $user = Auth::user();
        $client = $user->client;
        $account = Account::find($account_id);
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
        return redirect()->route('client.newAccountStatement', $account_id);
    }
    public function statement($account_id = 0)
    {
        $account = Account::findOrFail($account_id);

        return view('client.accounts.statement', compact('account'));
    }

    public function finish(Request $request, $account_id = 0)
    {
        $user = Auth::user();
        $client = $user->client;
        $account = Account::findOrFail($account_id);



        if ($request->acceptCheck) {

            if ($account->type == 2) {
                $jointHolders = $account->jointHolders()->withPivot('kyc_link')->get();
                foreach ($jointHolders as $jointHolder) {
                    $link = $jointHolder->pivot->kyc_link;
                    // dd($jointHolder->pivot->kyc_link);

                    Mail::send('emails.jointholderKyc', ['name' => $jointHolder->name, 'email' => $jointHolder->user->email, 'link' => $link, 'account_id' => $account->id, 'joint_id' => $jointHolder->id], function ($message) use ($jointHolder) {
                        $message->to($jointHolder->user->email);
                        $message->subject('Need to Fill KYC Forms NSB FMC ' . $jointHolder->name);
                    });
                }
            } else {

                $account->pre = 0;
                $account->save();
            }
        } else {
        }

        return redirect()->route('client.newAccountEnd', $account_id);
    }

    public function end($account_id = 0)
    {
        $account = Account::findOrFail($account_id);

        return view('client.accounts.finish', compact('account'));
    }
}
