<?php

namespace App\Http\Controllers\Admin;

use App\BankRecord;
use App\BankRepo;
use App\Client;
use App\ClientRecord;
use App\ClientRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BankImport;
use App\Imports\RepoImport;
use App\Investment;
use App\TempInvestment;
use App\Withdraw;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Carbon\Cli\Invoker;
use Illuminate\Support\Facades\DB;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Mail;

class BankRepoController extends Controller
{

    public function index(){
        $today = Carbon::today()->toDateString();
        // dd($today);

        $bankRecords = BankRepo::whereBetween('created_at', [$today." 00:00:00", $today." 23:59:59"])->get();
        $clientRecords = ClientRepo::whereBetween('created_at',[$today." 00:00:00",$today." 23:59:59"])->get();   
        // dd($bankRecords);

        return view('admin.csv.repo',compact('bankRecords','clientRecords'));
    }

    public function viewRecords(){

        $bankRecords = BankRepo::all();
        $clientRecords = ClientRepo::all();

        return view('admin.bankRepos.index',compact('bankRecords','clientRecords'));

    }

    public function clean(){
        BankRepo::truncate();
        return redirect()->back();
    }

    public function fileImport(Request $request) 
    {
        BankRepo::truncate();
        Excel::import(new RepoImport, $request->file('file')->store('temp'));
        return back();
    }

    public function synchronize(){

        DB::beginTransaction();
        try {
            set_time_limit(0);
            // $bankRecords = BankRecord::all();

            $matchingRecords = DB::select('SELECT bank_repos.*,clients.id as client_id  FROM  bank_repos , clients WHERE  
                                          bank_repos.nic = clients.nic And clients.status!=100 And clients.status>7');


        
            //    dd($matchingRecords);

           foreach($matchingRecords as $match){

              
               $checkClientRecords = ClientRepo::where('deal_no','=',$match->deal_no)->where('invested_value',$match->invested_value)->where('method',$match->method)->count();
          

                   if($checkClientRecords==0){   

                        $clientRecord = new ClientRepo;
                        $clientRecord->client_id = $match->client_id;
                        $clientRecord->deal_no  = $match->deal_no;
                        $clientRecord->cus_id  = $match->cus_id;
                        $clientRecord->nic  = $match->nic;
                        $clientRecord->cus_name  = $match->cus_name;
                        $clientRecord->cus_id2  = $match->cus_id2;
                        $clientRecord->nic2  = $match->nic2;
                        $clientRecord->cus_name2  = $match->cus_name2;
                        $clientRecord->cus_id3  = $match->cus_id3;
                        $clientRecord->nic3  = $match->nic3;
                        $clientRecord->cus_name3  = $match->cus_name3;
                        $clientRecord->value_date = $match->value_date;
                        $clientRecord->mat_date = $match->mat_date;
                        $clientRecord->invested_value  = $match->invested_value;
                        $clientRecord->yield = $match->yield;
                        $clientRecord->interest  = $match->interest;
                        $clientRecord->maturity_value  = $match->maturity_value;
                        $clientRecord->isin  = $match->isin;
                        $clientRecord->face_value  = $match->face_value;
                        $clientRecord->market_value  = $match->market_value;
                        $clientRecord->maturity_date  = $match->maturity_date;
                        $clientRecord->haircut  = $match->haircut;
                        $clientRecord->method = $match->method;
                        $clientRecord->ref_investment = $match->ref_investment;

                        $clientRecord->save();

                   }

                }
                foreach($matchingRecords as $match){
                    $clientRecord = ClientRepo::where('deal_no','=',$match->deal_no)->where('invested_value',$match->invested_value)->where('method',$match->method)->latest()->first(); 


                    $totalInvestedAmount = ClientRepo::where('deal_no',$match->deal_no)->where('method','!=','Maturity')->sum('invested_value');
                    $totalMaturedAmount = ClientRepo::where('deal_no',$match->deal_no)->where('method','!=','Maturity')->sum('maturity_value');

                    $totalInvestedAmountOfMaturity = ClientRepo::where('deal_no',$match->deal_no)->where('method','=','Maturity')->sum('invested_value');
                    $totalMaturedAmountOfMaturity = ClientRepo::where('deal_no',$match->deal_no)->where('method','=','Maturity')->sum('maturity_value');

                    $isin_array=[];

                    $isin_data = ClientRepo::where('deal_no',$match->deal_no)->groupBy('isin')->get();

                    foreach ($isin_data as $key => $isin){
                        $ISIN = $isin->isin;
                        $faceValue = ClientRepo::where('isin',$ISIN)->where('method','!=','Maturity')->sum('face_value');
                        $marketValue = ClientRepo::where('isin',$ISIN)->where('method','!=','Maturity')->sum('market_value');

                        $isin_array[$key]['isin'] = $ISIN;
                        $isin_array[$key]['face_value'] =$faceValue;
                        $isin_array[$key]['market_value'] =$marketValue;
                        $isin_array[$key]['maturity_date'] =Carbon::createFromFormat('Y-m-d', $isin->maturity_date)->format('j-F-Y');
                        $isin_array[$key]['haircut'] =$isin->haircut;

                    }

                    //   dd($isin_array);
                    //    dd($totalInvestedAmount);
                 
                            $client = Client::find($match->client_id);
                            $maturityDate = $match->mat_date." 23:59:59";
                            $valueDate    = $match->value_date." 23:59:59";
                            // dd($maturityDate);
                            $today_ymd =  Carbon::now()->format('Y-m-d H:s:i');
                            $value_ymd =  Carbon::createFromFormat('Y-m-d H:s:i',$valueDate);
                            $maturity_ymd  = Carbon::createFromFormat('Y-m-d H:s:i',$maturityDate);
                            $data = [
                                'ref_no' => $match->deal_no,
                                'client' => $client,
                                'cus_id' => $match->cus_id,
                                'today'  => Carbon::now()->format('j-F-Y'),
                                'cus_name' => $match->cus_name,
                                'invested_value' => $totalInvestedAmount,
                                'interest' => $match->interest,
                                'maturity_value' => $totalMaturedAmount,
                                'isin' => $match->isin,
                                'isin_array'=> $isin_array,
                                'face_value'=>$match->face_value,
                                'market_value'=>$match->market_value,
                                'maturity_date'=>Carbon::createFromFormat('Y-m-d', $match->maturity_date)->format('j-F-Y'),
                                'mat_date'=>Carbon::createFromFormat('Y-m-d', $match->mat_date)->format('j-F-Y'),
                                'value_date'=>Carbon::createFromFormat('Y-m-d', $match->value_date)->format('j-F-Y'),
                                'haircut' =>$match->haircut,
                                'days_to_maturity'=> Carbon::createFromFormat('Y-m-d H:s:i', $value_ymd)->diffInDays( Carbon::createFromFormat('Y-m-d H:s:i', $maturity_ymd))
                            ];

                            $client_name = strtoupper($client->name_by_initials);
                            $passwordNamePart = substr($client_name, strlen($client_name)-3, 3);
                            // dd($passwordNamePart);
                            $doc_password = Carbon::createFromFormat('Y-m-d H:i:s', $client->dob)->year;
                            $doc_password = $passwordNamePart.$doc_password;

                            $pdf =  PDF::loadView('certificates.repo',$data);
                            $pdf->setEncryption($doc_password);
                            $pdf->setPaper('a4', 'landscape');
                            $pdf->save(storage_path('app/public/downloads/'.$match->deal_no.'.pdf'));


                          if($match->method == 'Maturity'){
                            $investment = Investment::where('investment_type_id',3)->where('client_id',$match->client_id)
                            ->where('amount',$totalInvestedAmountOfMaturity)->where('value_date',$match->value_date)->where('maturity_date',$match->mat_date)
                            ->where('ref_no',null)
                            ->orwhere('ref_no','')->latest()->first();

                          }else{
                            $investment = Investment::where('investment_type_id',3)->where('client_id',$match->client_id)
                            ->where('amount',$totalInvestedAmount)->where('value_date',$match->value_date)->where('maturity_date',$match->mat_date)
                            ->where('ref_no',null)
                            ->orwhere('ref_no','')->latest()->first();
                          }
                        //    dd($investment);

                            
                        
                            if($investment==null){

                                $existingInvestment = Investment::where('ref_no',$match->deal_no)->first();
                                // dd($existingInvestment);
                                if($existingInvestment==null){

                                    // dd("came here");
                                
                                    $investment = new Investment;
                                    $investment->client_id = $match->client_id;
                                    $investment->ref_no=$match->deal_no;
                                    $investment->amount = 0;
                                    $investment->invested_amount = $totalInvestedAmount;
                                    $investment->maturity_date = $match->mat_date;
                                    $investment->matured_amount = $totalMaturedAmount;
                                    $investment->value_date = $match->value_date;
                                    $investment->investment_type_id = 3;
                                    $investment->status =3;
                                    $investment->method = $match->method;
                                    $investment->yield = $match->yield;
                                    $investment->ref_investment = $match->ref_investment;
                                    $investment->save();

                                    if($match->method!='Maturity'){
                                        Mail::send('emails.accountActivate', 
                                        ['name' => $client->name,
                                        'email'=>$client->user->email,
                                        'investment'=>$investment->InvestmentType->name,
                                        'today'=> date('Y-m-d')], 
                                        function($message) use($client,$investment,$match){
                                            $message->to($client->user->email);
                                            $message->subject('Customer Confirmation'.$investment->InvestmentType->name)->attach(storage_path('app/public/downloads/'.$match->deal_no.'.pdf'));
                                        });
                                    }


                                
                                    continue;
                                
                                    }else{

                             

                                    if($existingInvestment->hasWithdraws()){
                                                                    
                                        $instruction = $existingInvestment->withdraw()->where('status',2)->latest()->first();
                                        // dd($instruction);
                                      
                                            if($instruction!=null){    
                                                $instruction->status = 3;
                                                $instruction->save();
                                              } 
                                                $existingInvestment->invested_amount = $totalInvestedAmount;
                                                $existingInvestment->matured_amount =  $totalMaturedAmount;
                                                $existingInvestment->value_date = $match->value_date;
                                                $existingInvestment->maturity_date = $match->mat_date;
                                                $existingInvestment->method = $match->method;
                                                $existingInvestment->yield = $match->yield;
                                                $existingInvestment->ref_investment = $match->ref_investment;
                                                $existingInvestment->save();

                                            // Mail::send('emails.accountActivate', 
                                            // ['name' => $client->name,
                                            // 'email'=>$client->user->email,
                                            // 'investment'=>$investment->InvestmentType->name,
                                            // 'today'=> date('Y-m-d')], 
                                            // function($message) use($client,$investment,$match){
                                            //     $message->to($client->user->email);
                                            //     $message->subject('Customer Confirmation'.$investment->InvestmentType->name)->attach(storage_path('app/public/downloads/'.$match->deal_no.'.pdf'));
                                            // });

                                            continue;
                                       
                                }else{

                                    if(($existingInvestment->method != $match->method) || 
                                        ($existingInvestment->invested_amount != $match->invested_value) ||
                                        ($existingInvestment->value_date != $match->value_date) ||
                                        ($existingInvestment->maturity_date != $match->mat_date)){

                                            $existingInvestment->ref_no=$match->deal_no;
                                            $existingInvestment->invested_amount = $totalInvestedAmount;
                                            $existingInvestment->maturity_date = $match->mat_date;
                                            $existingInvestment->matured_amount = $totalMaturedAmount;
                                            $existingInvestment->value_date = $match->value_date;
                                            $existingInvestment->method = $match->method;
                                            $existingInvestment->yield = $match->yield;
                                            $existingInvestment->status =3;
                                            $existingInvestment->ref_investment = $match->ref_investment;
                                            $existingInvestment->save();

                                            



                                        // continue;



                                    }else{


                                        $existingInvestment->ref_no=$match->deal_no;
                                        $existingInvestment->invested_amount = $totalInvestedAmount;
                                        $existingInvestment->maturity_date = $match->mat_date;
                                        $existingInvestment->matured_amount = $totalMaturedAmount;
                                        $existingInvestment->value_date = $match->value_date;
                                        $existingInvestment->method = $match->method;
                                        $existingInvestment->yield = $match->yield;
                                        $existingInvestment->status =3;
                                        $existingInvestment->ref_investment = $match->ref_investment;
                                        $existingInvestment->save();

                                    }

                               

                                }
                            
                            }
                        }else{

                        //   dd("came here else investment is null ");


                                // PDF::setOptions(['isHtml5ParserEnabled'=>true,'adminPassword'=> $doc_password]);
                                // PDF::loadView('certificates.repo',$data)->save(storage_path('app/public/downloads/'.$match->deal_no.'.pdf'));
                         
            

                            if($client->status==8 ){


                                $client->status=9;
                                $client->save();
                            }


                             if($investment->status==2){

                                if($match->method=='New'){ 

                                Mail::send('emails.accountActivate', 
                                ['name' => $client->name,
                                'email'=>$client->user->email,
                                'investment'=>$investment->InvestmentType->name,
                                'today'=> date('Y-m-d')], 
                                function($message) use($client,$investment,$match){
                                    $message->to($client->user->email);
                                    $message->subject('Customer Confirmation'.$investment->InvestmentType->name)->attach(storage_path('app/public/downloads/'.$match->deal_no.'.pdf'));
                                });
                               }
                                $investment->ref_no=$match->deal_no;
                                $investment->invested_amount = $totalInvestedAmount;
                                $investment->maturity_date = $match->mat_date;
                                $investment->matured_amount = $totalMaturedAmount;
                                $investment->value_date = $match->value_date;
                                $investment->method = $match->method;
                                $investment->yield = $match->yield;
                                $investment->status =3;
                                $investment->ref_investment = $match->ref_investment;
                                $investment->save();

                            }else{
                                if($match->method=='New'){ 

                                    Mail::send('emails.accountActivate', 
                                    ['name' => $client->name,
                                    'email'=>$client->user->email,
                                    'investment'=>$investment->InvestmentType->name,
                                    'today'=> date('Y-m-d')], 
                                    function($message) use($client,$investment,$match){
                                        $message->to($client->user->email);
                                        $message->subject('Customer Confirmation'.$investment->InvestmentType->name)->attach(storage_path('app/public/downloads/'.$match->deal_no.'.pdf'));
                                    });
                                   }

                                $investment->ref_no=$match->deal_no;
                                $investment->invested_amount = $totalInvestedAmount;
                                $investment->maturity_date = $match->mat_date;
                                $investment->matured_amount = $totalMaturedAmount;
                                $investment->value_date = $match->value_date;
                                $investment->method = $match->method;
                                $investment->yield = $match->yield;
                                $investment->status =3;
                                $investment->ref_investment = $match->ref_investment;
                                $investment->save();

                            }


                              



                            
                        }
        
           }

    
        DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }


        return redirect()->back();
    }

}