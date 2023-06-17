<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Withdraw;
use App\WithdrawProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    
    public function withdraws()
    {

        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();

        if ($officer_role->id == 5) {

            $withdraws = Withdraw::where('status', '=', 0)->get();
        } elseif ($officer_role->id == 6) {

            $withdraws = Withdraw::where('status', '=', 0)->get();
        } elseif ($officer_role->id == 7) {

            $withdraws = Withdraw::where('status', '=', 1)->get();
        } else {

            $withdraws = '';
        }




        return view('admin.withdraws.index', compact('withdraws', 'officer_role'));
    }

    public function withdrawShow($id)
    {
        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();

        $withdraw = Withdraw::findOrFail($id);


        return view('admin.withdraws.show', compact('withdraw', 'officer_role'));
    }

    
    public function withdrawProcess(Request $request)
    {


        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();


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



        $withdraw = Withdraw::findOrFail($withdraw_id);


        return view('admin.withdraws.show', compact('withdraw', 'officer_role'));
    }



}
