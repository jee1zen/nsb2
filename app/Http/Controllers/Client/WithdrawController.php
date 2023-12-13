<?php

namespace App\Http\Controllers\Client;

use App\Client;
use App\Http\Controllers\Controller;
use App\InvestmentType;
use App\JointWithdrawApproval;
use App\ReverseRepo;
use App\SelectedAccount;
use App\Withdraw;
use App\WithdrawProcess;

use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function store(Request $request)
    {

        // dd($request->all());


        // $request->validate([
        //     'investment_type_value' => 'required | unique:withdraws,investment_type_value,NULL,id,request'

        // ]);


        $user = Auth::user();

        if ($request->request_type_value == 3 || $request->request_type_value == 5 | $request->request_type_value == 6) {

            $bank_id = $request->bank_id;
        } else {

            $bank_id = 0;
        }

        if ($request->request_type_value == 3 || $request->request_type_value == 4) {

            $amount = str_replace(",", "", $request->amount);
        } else {

            $amount = 0;
        }

        $checkRecords =  Withdraw::where('client_id', '=', $user->id)->where('investment_id', '=', $request->investment_id)->where('status', '<', 3)->count();

        //    dd($checkRecords);

        if ($checkRecords > 0) {

            $investment = InvestmentType::find($request->investment_id);
            // dd($investment);
            return redirect()->back()->with('error', 'You Have Already Given Maturity Instruction For This Investment, You Cannot Proceed Until Instruction Processed By NSB FMC Team ');
        } else {

            $withdraw = new Withdraw;
            $withdraw->client_id = $user->id;
            $withdraw->request_type = $request->request_type_value;
            $withdraw->investment_id = $request->investment_id;
            $withdraw->bank_id = $bank_id;
            $withdraw->amount = $amount;
            $withdraw->expected_date = $request->expected_date;

            if ($user->client->client_type == 3) {
                $status = -2;
                $withdraw->status =  $status;
                $withdraw->save();
            } else if ($user->client->client_type == 2 && $user->client->joint_permission == 1) {


                $count = $user->client->jointHolders()->count();
                $status = -$count;
                $withdraw->status =  $status;
                $withdraw->save();

                foreach ($user->client->jointHolders()->get() as $jointHolder) {
                    $approval = new JointWithdrawApproval;
                    $approval->withdraw_id = $withdraw->id;
                    $approval->joint_holder_id = $jointHolder->id;
                    $approval->save();
                }
            } else {
                $status = 0;
                $withdraw->status =  $status;
                $withdraw->save();
            }



            return redirect()->route('client.requests')->with('message', 'Maturity Instruction has been Submitted Recently');
        }
    }

    public function requestForm()
    {
        $user = Auth::user();
        $client = Client::findOrFail($user->id);

        $withDrawRequest = $client->withdraws()->where('status', '<', '3')->latest()->first();
        // dd($withDrawRequest);

        $bankAccounts = $client->bankParticulars()->get();


        return view('client.fundRequest', compact('withDrawRequest', 'bankAccounts', 'client'));
    }

    public function requests()
    {

        $user = Auth::user();
        $client = Client::findOrFail($user->id);


        $withdraws = "";
        $reverseRepos = "";
        // $bids = $client->bids()->paginate(20);

        return view('client.request', compact('withdraws', 'client', 'reverseRepos'));
    }

    public function requestsFilter(Request $request)
    {

        //   dd($request->all());



        $user = Auth::user();
        $client = $user->client;
        $selectedAccount = $client->selectedAccount;
        $account_id = $selectedAccount->account->id;

        $type = $request->investment_type;
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        // dd($type);

        if ($type == 4) {
            // $withdraws = $client->withdraws()->whereBetween('created_at', [$fromDate." 00:00:00", $toDate." 23:59:59"])->investment()->where('investment_type_id',$type)
            // ->paginate(20);
            $withdraws = '';
            $reverseRepos = ReverseRepo::select('reverse_repos.*')
                ->whereBetween('reverse_repos.created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
                ->join('investments', 'reverse_repos.investment_id', '=', 'investments.id')->where('investments.account_id', $account_id)
                ->where('reverse_repos.client_id', $user->id)
                ->paginate(20);
        } elseif ($type == 0) {

            $withdraws = Withdraw::select('withdraws.*')
                ->whereBetween('withdraws.created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
                ->join('investments', 'withdraws.investment_id', '=', 'investments.id')->where('investments.account_id', $account_id)
                ->paginate(20);
            $reverseRepos = ReverseRepo::select('reverse_repos.*')

                ->join('investments', 'reverse_repos.investment_id', '=', 'investments.id')->where('investments.account_id', $account_id)
                ->whereBetween('reverse_repos.created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
                ->where('reverse_repos.client_id', $user->id)
                ->paginate(20);
        } else {
            // dd('came here');
            $reverseRepos = '';
            $withdraws = Withdraw::join('investments', function ($join) use ($account_id, $type) {
                $join->on('withdraws.investment_id', '=', 'investments.id')->where('investments.account_id', '=', $account_id)
                    ->where('investments.investment_type_id', '=', $type);
            })
                ->select('withdraws.*')
                ->whereBetween('withdraws.created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
                ->where('withdraws.client_id', $user->id)
                ->paginate(20);
        }





        // $reverseRepos = $client->reverseRepos()->paginate(20);
        // $bids = $client->bids()->paginate(20);
        $parameters = [
            'type' => $type,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ];
        return view('client.request', compact('withdraws', 'client', 'reverseRepos', 'parameters'));
    }




    public function commonproceed()
    {

        $clientUser = Auth::user();

        $role = $clientUser->roles()->first()->id;

        if ($clientUser->hasClient()) {
            $client = $clientUser->client;
            $is_signatureB = $client->is_signatureB;
        } else {
            if ($role == 10) {
                $client = $clientUser->jointHolder->client;
                $is_signatureB = 0;
            } else {
                $client = $clientUser->companySignature->client;
                $is_signatureB = 0;
            }
        }

        $withdraws = '';
        $reverseRepos = '';


        if ($role == 8) {
            $withdraws = $client->withdraws()->where('status', '=', -1)->get();
            $reverseRepos = $client->reverseRepos()->where('status', -1)->get();
            $newInvestments = $client->investments()->where('status', -1)->get();
        } elseif ($role == 9  || $is_signatureB == 1) {
            $withdraws = $client->withdraws()->where('status', '=', -2)->get();
            $reverseRepos = $client->reverseRepos()->where('status', -2)->get();
            $newInvestments = $client->investments()->where('status', -2)->get();
        } elseif ($role == 10 && $client->joint_permission == 1) {

            $withdraws = $client->withdraws()->where('status', '<', 0)->get();
            $reverseRepos = $client->reverseRepos()->where('status', '<', 0)->get();
            $bids = $client->bids()->first()->bids()->where('status', '<', 0)->get();
            $newInvestments = $client->investments()->where('status', '!=', -100)->where('status', '<', 0)->get();
            dd($newInvestments);
        } else {
        }


        return view('client.subUser.requests.withdraws.show', compact('withdraws', 'reverseRepos', 'client', 'bids', 'newInvestments'));
    }

    public function proceed()
    {

        // $clientUser = Auth::user();
        // $role = $clientUser->roles()->first()->id;

        // if ($clientUser->hasClient()) {
        //     $client = $clientUser->client;
        //     $is_signatureB = $client->is_signatureB;
        // } else {
        //     if ($role == 10) {
        //         $client = $clientUser->jointHolder->client;
        //         $is_signatureB = 0;
        //     } else {
        //         $client = $clientUser->companySignature->client;
        //         $is_signatureB = 0;
        //     }
        // }

        // $withdraws = '';
        // $reverseRepos = '';


        // if ($role == 8) {
        //     $withdraws = $client->withdraws()->where('status', '=', -1)->paginate(10);
        // } elseif ($role == 9  || $is_signatureB == 1) {
        //     $withdraws = $client->withdraws()->where('status', '=', -2)->paginate(10);
        // } elseif ($role == 10 && $client->joint_permission == 1) {

        //     $withdraws = $client->withdraws()->where('status', '<', 0)->paginate(10);
        // } else {
        // }

        $client = Auth::user();
        $selectedAccount = $client->selectedAccount;
        $account = $selectedAccount->account;
        // $newInvestments = $account->investments()->where('status','<',0)->where('status','<>',-100)->paginate(10);
        $withdraws = $account->withdraws()->where('status', '<', 0)->paginate(10);

        return view('client.subUser.requests.withdraws.show', compact('withdraws', 'client'));
    }



    public function process(Request $request)
    {


        $officer = Auth::user();
        $officer_role = $officer->roles()->first()->id;



        $client_id = $request->client_id;
        $request_type = $request->request_type;
        $request_comment = $request->request_comment;
        $withdraw_id = $request->withdraw_id;

        $withdraw = Withdraw::findOrFail($withdraw_id);


        $prev_state = $withdraw->status;

        $withdraw->status = $withdraw->status + $request_type;
        $withdraw->save();

        WithdrawProcess::create([
            'withdraw_id' => $withdraw_id,
            'user_id' => $officer->id,
            'client_id' => $client_id,
            'previous_state' => $prev_state,
            'current_state' => $prev_state + $request_type,
            'comment' => $request_comment
        ]);

        if ($officer_role == 10) {
            $jointApproval = JointWithdrawApproval::where('withdraw_id', $withdraw_id)->where('joint_holder_id', $officer->jointHolder->id)->first();
            if ($request_type == 1) {
                $jointApproval->status = 1;
            } else {
                $jointApproval->status = 2;
            }
            $jointApproval->save();
        }


        return redirect()->route('client.requests.proceed');
    }
}