<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Investment;
use App\TempInvestment;
use App\Withdraw;
use App\WithdrawProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NonInstructedRecordsController extends Controller
{
    public function index(){

        $officer_role = Auth::user()->roles()->first();
          // dd($current_user->id);

        

          if ($officer_role->id == 5) {
  
              $investments = TempInvestment::where('status',0)->get();
          
  
          } elseif ($officer_role->id == 6) {
              $investments = TempInvestment::where('status',0)->get();
            
                          
          } elseif ($officer_role->id == 7) {
               $investments = TempInvestment::where('status',1)->get();
             
          
  
          }elseif($officer_role->id ==1){
              return redirect()->route('admin.clients.management');
          
          }
          
          else{
  
          }
             
          return view('admin.noninstructed.index', compact('investments','officer_role'));


    }

    public function show($id){

      
    
        $tempInvestment = TempInvestment::find($id);
     
        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();
        // dd($kyc);
        // $kyc =DB::select('select * from k_y_c_forms where id = ?', [$id]);
        // dd($kyc);
    

        return view('admin.noninstructed.show', compact('officer_role','tempInvestment'));

    }

    public function store(Request $request){
       
       

        if($request->request_type_value==3 || $request->request_type_value==5){

            $bank_id = $request->bank_id;

        }else{

            $bank_id = 0;
        }

        if($request->request_type_value==3 || $request->request_type_value==4 ){

            $amount = $request->amount;
        }else{

            $amount = 0;
        }
            $investment =Investment::find($request->investment_id);
            $client_id = $investment->client->id;
            


         

                $withdraw = new Withdraw;
                $withdraw->client_id = $client_id;
                $withdraw->request_type = $request->request_type_value;
                $withdraw->investment_id = $request->investment_id;
                $withdraw->bank_id = $bank_id;
                $withdraw->amount = $amount;
                $withdraw->is_backend = 1;
                $withdraw->status =1;
                $withdraw->save();

                $tempInvestment = TempInvestment::find($request->tempInvestment_id);
                $tempInvestment->status =1 ;
                $tempInvestment->save();




        
                return back()->with('success',"Instruction Saved, Send to Middle Office!");


    
    }

    public function process(Request $request){
        
        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();


        $client_id = $request->client_id;
        $request_type = $request->request_type;
        $request_comment = $request->request_comment;
        $withdraw_id = $request->withdraw_id;
        $tempInvestment_id = $request->tempInvestment_id;

        $tempInvestment = TempInvestment::findorFail($tempInvestment_id);

        $tempInvestment->investment->invested_amount = $tempInvestment->invested_amount;
        $tempInvestment->investment->matured_amount = $tempInvestment->matured_amount;
        $tempInvestment->investment->value_date = $tempInvestment->value_date;
        $tempInvestment->investment->maturity_date = $tempInvestment->maturity_date;
        $tempInvestment->investment->method = $tempInvestment->method;
        $tempInvestment->investment->save();
        $tempInvestment->is_synced =1;
        $tempInvestment->save();



        $withdraw = Withdraw::findOrFail($withdraw_id);


        $prev_state = $withdraw->status;

        $withdraw->status = 3;
        $withdraw->save();

        WithdrawProcess::create([
            'withdraw_id' => $withdraw_id,
            'user_id' => $officer->id,
            'client_id' => $client_id,
            'previous_state' => $prev_state,
            'current_state' => $prev_state + $request_type,
            'comment' => $request_comment

        ]);

        return back()->with('success'," Synced Records, Instrctuions recorded");

    }


}
