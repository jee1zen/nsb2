<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use App\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class StepController extends Controller
{

    public function investmentsView(){

        
        abort_if(Gate::denies('step_investment'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $investments = Investment::where('status','>',0)->where('status','<',3)->get();


        return view('admin.stepChange.investment.index', compact('investments'));
    }

    public function investment($id,$investment_id){

        

        abort_if(Gate::denies('step_investment'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client = Client::findOrFail($id);
    
        $investment = Investment::find($investment_id);
        $kyc = $client->kycByInvestmentid($investment_id);

      
       
       
 
    

        return view('admin.stepChange.investment.show', compact('client','kyc','investment_id',
        'investment'));

    }

    public function investmentUpdate(Request $request,$id,$investment_id){
        // dd("came here");
        abort_if(Gate::denies('step_investment'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $investment = Investment::findOrFail($investment_id);
      $client = Client::findOrFail($id);
      $kyc = $client->kycByInvestmentid($investment_id);

        $investment->status = $request->status;
        $investment->save();




        return  back()->with('success', 'Investment Status Changed!');


    }

    


}