<?php

namespace App\Http\Controllers\Client;

use App\Account;
use App\Bank;
use App\BankParticular;
use App\BidForAuction;
use App\ChangeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Client;
use App\ClientInfoChange;
use App\ClientRecord;
use App\EmploymentDetails;
use App\Inquiry;
use App\Investment;
use App\InvestmentType;
use App\JointHolder;
use App\JointReverseRepoApproval;
use App\JointWidthdrawAprroval;
use App\JointWithdrawApproval;
use App\ReverseRepo;
use App\ReverseRepoProcess;
use App\SelectedAccount;
use App\UserManual;
use App\Withdraw;
use App\WithdrawProcess;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use PDO;

class CustomerController extends Controller
{


  public function selectAccount(Request $request)
  {
    $selectedAccount = SelectedAccount::where('client_id', $request->client_id)->delete();
    SelectedAccount::create([
      'client_id' => $request->client_id,
      'account_id' => $request->account_id
    ]);

    $send['success'] = true;
    return response()->json($send);
  }


  public function index()
  {

    $user = Auth::user();
    if ($user->roles()->first()->id == 4) {
      $client = $user->client;
      if ($user->hasSelectedAccount()) {
        $selectedAccount = $user->selectedAccount;
        $account = $selectedAccount->account;
      }
    } elseif ($user->roles()->first()->id == 10) {

      $client = Client::findorFail($user->jointHolder->client->id);
    } else {

      $client = Client::findorFail($user->companySignature->client->id);
    }
    $investments = [];

    $clientRecords = $client->clientRecords()->get();
    if ($user->hasSelectedAccount()) {
      $investments = $account->investments()->where('invested_amount', '>', 0)->where('method', '!=', 'Maturity')->get();
    }
    $investmentTypes = InvestmentType::all();

    return view('client.dashboard', compact('client', 'user', 'clientRecords', 'investmentTypes', 'investments'));
  }

  public function history()
  {
    $user = Auth::user();
    if ($user->roles()->first()->id == 4) {
      $client = $user->client;
     
      if ($user->hasSelectedAccount()) {
        $selectedAccount = $user->selectedAccount;
        $account = $selectedAccount->account;
      }
    } elseif ($user->roles()->first()->id == 10) {

      $client = Client::findorFail($user->jointHolder->client->id);
    } else {

      $client = Client::findorFail($user->companySignature->client->id);
    }
    $investments = [];
    $clientRecords = $client->clientRecords()->get();
    if ($user->hasSelectedAccount()) {
      $investments = $account->investments()->where('invested_amount', '>', 0)->where('method', '=', 'Maturity')->get();
    }


    return view('client.history', compact('client', 'user', 'clientRecords', 'investments'));
  }

  public function staging()
  {

    $client = Auth::user()->client;
    $client_name = $client->title . " " . $client->name;
    $investmentTypes = InvestmentType::all();


    return view('client.staging.index', compact('client_name'));
  }





  public function blank()
  {

    $user = Auth::user();
    if ($user->roles()->first()->id == 4) {

      $client = Client::findorFail($user->id);
      $clientRecords = $client->clientRecords()->get();
      $investmentTypes = InvestmentType::all();
    } else {

      $client = Client::findorFail($user->companySignature->client->id);
      $clientRecords = $client->clientRecords()->get();
      $investmentTypes = InvestmentType::all();
    }


    // dd($client);


    return view('client.blank', compact('client', 'user', 'clientRecords', 'investmentTypes'));
  }


  public function userManual()
  {
  }



  public function inquiries()
  {

    $user = Auth::user();
    if ($user->roles()->first()->id == 4) {

      $client = Client::findorFail($user->id);
      $clientRecords = $client->clientRecords()->get();
      $investmentTypes = InvestmentType::all();
    } else {

      $client = Client::findorFail($user->companySignature->client->id);
      $clientRecords = $client->clientRecords()->get();
      $investmentTypes = InvestmentType::all();
    }


    // dd($client);


    return view('client.inquiries', compact('client', 'user', 'clientRecords', 'investmentTypes'));
  }



  public function inquiryPost(Request $request)
  {

    $request->validate([
      'inquiryType' => 'required',
      'message' => 'required',

    ]);

    $inquiry = new Inquiry;

    $inquiry->user_id = Auth::user()->id;
    $inquiry->type = $request->inquiryType;
    $inquiry->message = $request->message;
    $inquiry->save();

    return back()->with('success', 'Your message Has been, NSB FMC Team will Attend to it soon');
  }







  //    public function transactions(){

  //       $user = Auth::user();
  //       $client= Client::findOrFail($user->id);


  //       $withdraws = $client->withdraws()->paginate(20);

  //       return view('client.transaction',compact('withdraws','client'));



  //    }




  public function bankAccounts()
  {

    $user = Auth::user();
    $client = Client::findOrFail($user->id);

    $bankAccounts  = $client->bankParticulars()->get();




    return view('client.bankParticulars.index', compact('bankAccounts', 'client'));
  }

  public function addBankAccount()
  {

    $user = Auth::user();
    $client = Client::findOrFail($user->id);
    $banks = Bank::orderBy('name', 'ASC')->with('branches')->get();
    $banksJson = $banks->toJson();



    return view('client.bankParticulars.create', compact('client', 'banks', 'banksJson'));
  }

  public function bankAccountStore(Request $request)
  {

    $user = Auth::user();
    $client = Client::findOrFail($user->id);

    $request->validate([
      'bank_name' => 'required',
      'accountType' => 'required',
      'account_no' => 'required'
    ]);

    $bank = new BankParticular;
    $bank->name   = $request->name;
    $bank->bank_name = $request->bank_name;
    $bank->client_id = $user->id;
    $bank->branch = $request->branch;
    $bank->account_no = $request->account_no;
    $bank->Account_type = $request->accountType;
    $bank->save();
    return redirect()->route('client.bankAccounts.view');
  }

  public function profile()
  {

    $user = Auth::user();

    $client = Client::findOrFail($user->id);
    $authorizedPerson = Client::find($user->id)->authorizedPerson;
    $employmentDetails = Client::find($user->id)->employmentDetails;
    $otherDetails = Client::find($user->id)->otherDetails;

    return view('client.profile.index', compact('client', 'authorizedPerson', 'employmentDetails', 'otherDetails'));
  }



  public function profileEdit()
  {
    $user = Auth::user();

    $client = Client::findOrFail($user->id);
    $employmentDetails = Client::find($client->id)->employmentDetails;
    $jointHolders = Client::find($client->id)->jointHolders;
    return view('client.profile.edit', compact('client', 'employmentDetails', 'jointHolders'));
  }

  public function customer_BasicInfo_update(Request $request, $id)
  {

    $client = Client::findorFail($id);

    $changeRequest = new ChangeRequest;

    if ($client->title != $request->title) {
      $changeRequest->title_state = 1;
      $changeRequest->title = $request->title;
    }

    if ($client->name != $request->name) {
      $changeRequest->name_state = 1;
      $changeRequest->name = $request->name;
    }

    if ($client->address_line_1 != $request->address_line_1) {
      $changeRequest->address_state = 1;
      $changeRequest->address_line_1 = $request->address_line_1;
    }

    if ($client->address_line_2 != $request->address_line_2) {
      $changeRequest->address_state = 1;
      $changeRequest->address_line_2 = $request->address_line_2;
    }

    if ($client->address_line_3 != $request->address_line_3) {
      $changeRequest->address_state = 1;
      $changeRequest->address_line_3 = $request->address_line_3;
    }


    if ($client->correspondence_address_line_1 != $request->correspondence_address_line_1) {
      $changeRequest->correspondence_address_state = 1;
      $changeRequest->correspondence_address_line_1 = $request->correspondence_address_line_1;
    }
    if ($client->correspondence_address_line_2 != $request->correspondence_address_line_2) {
      $changeRequest->correspondence_address_state = 1;
      $changeRequest->correspondence_address_line_2 = $request->correspondence_address_line_2;
    }
    if ($client->correspondence_address_line_3 != $request->correspondence_address_line_3) {
      $changeRequest->correspondence_address_state = 1;
      $changeRequest->correspondence_address_line_3 = $request->correspondence_address_line_3;
    }


    if ($client->nic != $request->nic) {

      $changeRequest->nic_state = 1;
      $changeRequest->nic = $request->nic;
    }




    //   $deleteNicFront = $client->nic_front;
    //   $deleteNicBack = $client->nic_back;
    //   $deleteSignatrure = $client->signature;
    //   $deletePassport = $client->passport;




    $destinationPath = storage_path('app/public/uploads/');

    if ($request->file('nic_front') != '') {
      $nic_front = $request->file('nic_front');
      $nic_front_edit = time() . '_' . $nic_front->getClientOriginalName();
      if ($nic_front->move($destinationPath, $nic_front_edit)) {



        $changeRequest->nic_front = $nic_front_edit;



        //   unlink(storage_path('app/public/uploads/'.$deleteNicFront));

        $changeRequest->nic_state = 1;
      }
    }

    if ($request->file('nic_back') != '') {
      $nic_back = $request->file('nic_back');
      $nic_back_edit = time() . '_' . $nic_back->getClientOriginalName();
      if ($nic_back->move($destinationPath, $nic_back_edit)) {

        $changeRequest->nic_back = $nic_back_edit;



        //   unlink(storage_path('app/public/uploads/'.$deleteNicBack));
        $changeRequest->nic_state = 1;
      }
    }


    if ($request->file('passport') != '') {
      $passport = $request->file('passport');
      $passport_edit = time() . '_' . $passport->getClientOriginalName();
      if ($passport->move($destinationPath, $passport_edit)) {

        $changeRequest->passport = $passport_edit;



        //   unlink(storage_path('app/public/uploads/'.$deletePassport));
        $changeRequest->nic_state = 1;
      }
    }


    if ($request->file('name_proof_doc') != '') {
      $name_proof_doc = $request->file('name_proof_doc');
      $name_proof_doc_edit = time() . '_' . $name_proof_doc->getClientOriginalName();
      if ($name_proof_doc->move($destinationPath, $name_proof_doc_edit)) {

        $changeRequest->name_proof_doc = $name_proof_doc_edit;



        //   unlink(storage_path('app/public/uploads/'.$deleteSignatrure));

      }
    }
    $changeRequest->client_id = $client->id;
    $changeRequest->save();


    return back()->with('message', 'Your Information is updated!, Changes will be applied after  reviewed By NSB FMC Team');
  }

  public function customer_employmentInfo_update(Request $request, $id)
  {
    //dd($id);
    $employmentDetails = EmploymentDetails::findorFail($id);
    $employmentDetails->occupation = $request->occupation;
    $employmentDetails->company_name = $request->company_name;
    $employmentDetails->nature = $request->nature;
    $employmentDetails->telephone = $request->telephone;
    $employmentDetails->fax = $request->fax;
    $employmentDetails->save();







    return back();
  }

  public function customer_jointHolder_update(Request $request, $id)
  {
    //dd($request->all());
    $jointHolder = JointHolder::findorFail($id);
    $jointHolder->name = $request->name;
    $jointHolder->dob = $request->dob;
    $jointHolder->nic = $request->nic;
    $jointHolder->email = $request->email;
    $jointHolder->residence_address = $request->residence_address;
    $jointHolder->telephone = $request->telephone;
    $jointHolder->mobile = $request->mobile;

    $deleteNicFront = $jointHolder->nic_front;
    $deleteNicBack = $jointHolder->nic_back;
    $deleteSignatrure = $jointHolder->signature;
    $deletePassport = $jointHolder->passport;


    $jointHolder->save();


    $destinationPath = storage_path('app/public/uploads/');

    if ($request->file('joint_nic_front') != '') {

      $joint_nic_front = $request->file('joint_nic_front');
      $joint_nic_front_edit = time() . '_' . $joint_nic_front->getClientOriginalName();
      if ($joint_nic_front->move($destinationPath, $joint_nic_front_edit)) {
        $jointHolder->nic_front = $joint_nic_front_edit;
        $jointHolder->save();
        unlink(storage_path('app/public/uploads/' . $deleteNicFront));
      }
    }

    //dd('without nic front ');

    if ($request->file('joint_nic_back') != '') {

      $joint_nic_back = $request->file('joint_nic_back');
      $joint_nic_back_edit = time() . '_' . $joint_nic_back->getClientOriginalName();
      if ($joint_nic_back->move($destinationPath, $joint_nic_back_edit)) {

        $jointHolder->nic_back = $joint_nic_back_edit;
        $jointHolder->save();


        unlink(storage_path('app/public/uploads/' . $deleteNicBack));
      }
    }
    //dd('without nic back');


    if ($request->file('joint_passport') != '') {

      $joint_passport = $request->file('joint_passport');
      $joint_passport_edit = time() . '_' . $joint_passport->getClientOriginalName();
      if ($joint_passport->move($destinationPath, $joint_passport_edit)) {

        $jointHolder->passport = $joint_passport_edit;
        $jointHolder->save();


        unlink(storage_path('app/public/uploads/' . $deletePassport));
      }
    }
    // dd('without passport');

    if ($request->file('joint_signature') != '') {

      $joint_signature = $request->file('joint_signature');
      $joint_signature_edit = time() . '_' . $joint_signature->getClientOriginalName();
      if ($joint_signature->move($destinationPath, $joint_signature_edit)) {

        $jointHolder->signature = $joint_signature_edit;
        $jointHolder->save();


        unlink(storage_path('app/public/uploads/' . $deleteSignatrure));
      }
    }
    //dd('Without signature');




    return back();
  }
}