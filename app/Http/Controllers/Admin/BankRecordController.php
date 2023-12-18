<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\BankRecord;
use App\Client;
use App\ClientRecord;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BankImport;
use App\Investment;
use App\Jobs\GenerateUnMatchedCertificates;
use App\TempInvestment;
use App\Withdraw;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Mail;

class BankRecordController extends Controller
{

    public function index(){
        $today = Carbon::today()->toDateString();
        // dd($today);

        $bankRecords = BankRecord::whereBetween('created_at', [$today." 00:00:00", $today." 23:59:59"])->get();
        $clientRecords = ClientRecord::whereBetween('created_at',[$today." 00:00:00",$today." 23:59:59"])->get();   
        // dd($bankRecords);

        return view('admin.csv.index',compact('bankRecords','clientRecords'));
    }

    public function viewRecords(){

        $bankRecords = BankRecord::all();
        $clientRecords = ClientRecord::all();

        return view('admin.bankRecords.index',compact('bankRecords','clientRecords'));

    }

    public function clean(){
        BankRecord::truncate();
        return redirect()->back();
    }

    public function fileImport(Request $request) 
    {
        BankRecord::truncate();
        Excel::import(new BankImport, $request->file('file')->store('temp'));
        return back();
    }

    public function synchronize(){

        // DB::beginTransaction();
        // try {
            set_time_limit(0);
            // $bankRecords = BankRecord::all();

            $matchingRecords = DB::select('SELECT bank_records.*  FROM  bank_records , accounts  WHERE  
                                          bank_records.account_id = accounts.id AND accounts.status!=100 AND accounts.status>7');


            



                        

           foreach($matchingRecords as $match){

              
               $checkClientRecords = ClientRecord::where('ref_no','=',$match->ref_no)->where('account_id',$match->account_id)->where('invested_amount',$match->invested_amount)->where('method',$match->method)->count();
             
                if($match->type=='tbill'){
                    $type = 1;
                }elseif($match->type=='tbond'){
                    $type=2;
                }elseif($match->type=='repo'){
                    $type=3;
                }else{
                    $type=0;
                } 

                  $account = Account::find($match->account_id);
                  $client = $account->client;
                  $client_id = $client->id;


                   if($checkClientRecords==0){   
                        $clientRecord = new ClientRecord;
                        $clientRecord->account_id = $match->account_id;
                        $clientRecord->client_id = $client_id;
                        $clientRecord->cus_id1 = $match->cus_id1;
                        $clientRecord->cus_id2 = $match->cus_id2;
                        $clientRecord->cus_id3 = $match->cus_id3;
                        $clientRecord->name = $match->name;
                        $clientRecord->nic = $match->nic;
                        $clientRecord->ref_no = $match->ref_no;
                        $clientRecord->type = $type;
                        $clientRecord->investment_type = $match->investment_type;
                        $clientRecord->value_date = $match->value_date;
                        $clientRecord->maturity_date = $match->maturity_date;
                        $clientRecord->invested_amount = $match->invested_amount;
                        $clientRecord->price = $match->price;
                        $clientRecord->yield = $match->yield;
                        $clientRecord->coupon = $match->coupon;
                        $clientRecord->face_value = $match->face_value;
                        $clientRecord->stock_ref = $match->stock_ref;
                        $clientRecord->method = $match->method;
                        $clientRecord->ref_investment = $match->ref_investment;
                        $clientRecord->trade_date = $match->trade_date;
                        $clientRecord->coupon_dates = $match->coupon_dates;
                        $clientRecord->save();

                    }

                }
                foreach($matchingRecords as $match){

                    if ($match->type == 'tbill') {
                        $type = 1;
                    } elseif ($match->type == 'tbond') {
                        $type = 2;
                    } elseif ($match->type == 'repo') {
                        $type = 3;
                    } else {
                        $type = 0;
                    }

                        $clientRecord = ClientRecord::where('ref_no','=',$match->ref_no)->where('invested_amount',$match->invested_amount)->where('method',$match->method)->latest()->first();

                            $investment = Investment::where('investment_type_id',$type)->where('client_id',$client_id)->where('account_id',$match->account_id)
                            ->where('amount',$match->invested_amount)->where('value_date',$match->value_date)->where('maturity_date',$match->maturity_date)->where('status','!=',-100)
                            ->where('ref_no',null)->orWhere('ref_no','')->latest()->first();
                        //  dd($investment);
                        $account = Account::find($match->account_id);
                        $client = $account->client;
                        // dd($client);
                        // dd($client);
                        
                            if($investment==null){
                                $existingInvestment = Investment::where('ref_no',$match->ref_no)->first();
                                //  dd($existingInvestment);                                
                                if($existingInvestment==null){
                                    $investment = new Investment;
                                    $investment->client_id = $client_id;
                                    $investment->account_id = $match->account_id;
                                    $investment->ref_no=$match->ref_no;
                                    $investment->invested_amount = $match->invested_amount;
                                    $investment->maturity_date = $match->maturity_date;
                                    $investment->amount = 0;
                                    $investment->matured_amount = $match->face_value;
                                    $investment->value_date = $match->value_date;
                                    $investment->investment_type_id = $type;
                                    $investment->method = $match->method;
                                    $investment->ref_investment = $match->ref_investment;
                                    $investment->yield = $match->yield;
                                    $investment->status =3;
                                    $investment->save();
                                    if($match->method=='New'){

                                        $maturityDate = $match->maturity_date." 23:59:59";
                                        $valueDate    = $match->value_date." 23:59:59";
                                        // dd($maturityDate);
                                        $today_ymd =  Carbon::now()->format('Y-m-d H:s:i');
                                        $value_ymd =  Carbon::createFromFormat('Y-m-d H:s:i',$valueDate);
                                        $maturity_ymd  = Carbon::createFromFormat('Y-m-d H:s:i',$maturityDate);
                                        // $client = Client::find($match->client_id);
                                        $data = [
                                            'match' => $match,
                                            'client_title' => $client->title,
                                            'client_name' => $client->name_by_initials,
                                            'client_address_line_1' => $client->address_line_1,
                                            'client_address_line_2' => $client->address_line_2,
                                            'client_address_line_3' => $client->address_line_3,
                                            'today'  => Carbon::now()->format('j-F-Y'),
                                            'maturity_date' => Carbon::createFromFormat('Y-m-d', $match->maturity_date)->format('j-F-Y'),
                                            'value_date' => Carbon::createFromFormat('Y-m-d', $match->value_date)->format('j-F-Y'),
                                            'trade_date' => Carbon::createFromFormat('Y-m-d', $match->trade_date)->format('j-F-Y'),
                                            'days_to_maturity' => Carbon::createFromFormat('Y-m-d H:s:i', $value_ymd)->diffInDays(Carbon::createFromFormat('Y-m-d H:s:i', $maturity_ymd))
                                        ];
        
                                        $client_name = strtoupper($client->name_by_initials);
                                        $passwordNamePart = substr($client_name, strlen($client_name)-3, 3);
                                        $doc_password = Carbon::createFromFormat('Y-m-d', $client->dob)->year;
                                        $doc_password = $passwordNamePart.$doc_password;
                                        if($match->type=='tbill'){
                                            $pdf =  PDF::loadView('certificates.tbill',$data);
                                            // $pdf->setEncryption($doc_password);
                                            $pdf->setPaper('a4');
                                            $pdf->save(storage_path('app/public/downloads/'.$match->ref_no.'.pdf'));
        
                                        }elseif($match->type=='tbond'){
                                            $pdf =  PDF::loadView('certificates.tbond',$data);
                                            // $pdf->setEncryption($doc_password);
                                            $pdf->setPaper('a4');
                                            $pdf->save(storage_path('app/public/downloads/'.$match->ref_no.'.pdf'));    
                                        }else{
                                            // PDF::loadView('certificates.repo',$data)->save(storage_path('app/public/downloads/'.$match->ref_no.'.pdf'));
                                        }
        
                                        //  dd($doc_password);
        
        
                                        Mail::send('emails.accountActivate', 
                                        ['name' => $client->name,
                                        'email'=>$client->user->email,
                                        'investment'=>$investment->InvestmentType->name,
                                        'today'=> date('Y-m-d')], 
                                        function($message) use($client,$investment,$match){
                                            $message->to($client->user->email);
                                            $message->subject('Customer Confirmation'.$investment->InvestmentType->name)->attach(storage_path('app/public/downloads/'.$match->ref_no.'.pdf'));
                                        });
                                    }
                                    
                                    
                                    if($account->status==8 ){

                                        $account->status =9;
                                        $account->save();
                                    }
                            
                                    continue;



                                }else{


                                    if($existingInvestment->hasWithdraws()){
                                     
                                    
                                        $instruction = $existingInvestment->withdraw()->where('status',2)->latest()->first();
                                           
                                           if($instruction!=null){
                                       
                                            $instruction->status = 3;
                                            $instruction->save();
                                            $existingInvestment->invested_amount = $match->invested_amount;
                                            $existingInvestment->matured_amount = $match->face_value;
                                            $existingInvestment->maturity_date = $match->maturity_date;
                                            $existingInvestment->value_date = $match->value_date;
                                            $existingInvestment->method = $match->method;
                                            $existingInvestment->yield = $match->yield;
                                            $existingInvestment->ref_investment = $match->ref_investment;
                                            $existingInvestment->save();
                                           }
                                           if($match->method=='Maturity'){
                                            $existingInvestment->method = $match->method;
                                            $existingInvestment->save();
                                        }
                                     
                                            continue;
                                          
                                    }else{
                                         
                                        if($match->method=='Maturity'){
                                            $existingInvestment->method = $match->method;
                                            $existingInvestment->save();

                                        }else{
                                            $existingInvestment->method = $match->method;
                                            $existingInvestment->save();
                                            // if(($existingInvestment->method != $match->method) || 
                                            // ($existingInvestment->invested_amount != $match->invested_amount) ||
                                            // ($existingInvestment->value_date != $match->value_date) ||
                                            // ($existingInvestment->maturity_date != $match->maturity_date)){
    
    
                                            //     $tempInvestment =  new TempInvestment;
                                            //     $tempInvestment->investment_id = $existingInvestment->id;
                                            //     $tempInvestment->client_record_id = $clientRecord->id;
                                            //     $tempInvestment->client_id = $client_id;
                                            //     $tempInvestment->ref_no = $match->ref_no;
                                            //     $tempInvestment->investment_type_id = $type;
                                            //     $tempInvestment->invested_amount = $match->invested_amount;
                                            //     $tempInvestment->matured_amount = $match->face_value;
                                            //     $tempInvestment->value_date = $match->value_date;
                                            //     $tempInvestment->maturity_date = $match->maturity_date;
                                            //     $tempInvestment->status = 0;
                                            //     $tempInvestment->method = $match->method;
                                            //     $tempInvestment->yield = $match->yield;
                                            //     $tempInvestment->ref_investment = $match->ref_investment;
                                            //     $tempInvestment->save();
                                                continue;
                                                
                                            }

                                     
                                       
                                        continue;
                                    
                                    }
                                   
                                }

                            }else{
                               
                            
                        
                                // $client->status = 9;
                                // $client->is_active=1;
                                //email the client..

                                if($account->status==8 ){

                                    $account->status =9;
                                    $account->save();
                                }
                                if($investment->status==2){
                                    $investment->status =3;
                                    $investment->ref_no=$match->ref_no;
                                    $investment->invested_amount = $match->invested_amount;
                                    $investment->maturity_date = $match->maturity_date;
                                    $investment->matured_amount = $match->face_value;
                                    $investment->value_date = $match->value_date;
                                    $investment->method = $match->method;
                                    $investment->ref_investment = $match->ref_investment;
                                    $investment->yield = $match->yield;

                                    if($match->method=='New'){

                                        $maturityDate = $match->maturity_date." 23:59:59";
                                        $valueDate    = $match->value_date." 23:59:59";
                                        // dd($maturityDate);
                                        $today_ymd =  Carbon::now()->format('Y-m-d H:s:i');
                                        $value_ymd =  Carbon::createFromFormat('Y-m-d H:s:i',$valueDate);
                                        $maturity_ymd  = Carbon::createFromFormat('Y-m-d H:s:i',$maturityDate);
                                        $account = Account::find($match->account_id);
                                        $client = $account->client;
                                        $data = [
                                            'match' => $match,
                                            'client_title' => $client->title,
                                            'client_name' => $client->name_by_initials,
                                            'client_address_line_1' => $client->address_line_1,
                                            'client_address_line_2' => $client->address_line_2,
                                            'client_address_line_3' => $client->address_line_3,
                                            'today'  => Carbon::now()->format('j-F-Y'),
                                            'maturity_date' => Carbon::createFromFormat('Y-m-d', $match->maturity_date)->format('j-F-Y'),
                                            'value_date' => Carbon::createFromFormat('Y-m-d', $match->value_date)->format('j-F-Y'),
                                            'trade_date' => Carbon::createFromFormat('Y-m-d', $match->trade_date)->format('j-F-Y'),
                                            'days_to_maturity' => Carbon::createFromFormat('Y-m-d H:s:i', $value_ymd)->diffInDays(Carbon::createFromFormat('Y-m-d H:s:i', $maturity_ymd))
                                        ];
        
        
                                        $client_name = strtoupper($client->name_by_initials);
                                        $passwordNamePart = substr($client_name, strlen($client_name)-3, 3);
                                        $doc_password = Carbon::createFromFormat('Y-m-d', $client->dob)->year;
                                        $doc_password = $passwordNamePart.$doc_password;
        
                                        //  dd($doc_password);
        
        
                                    
                                        if($match->type=='tbill'){
                                            $pdf =  PDF::loadView('certificates.tbill',$data);
                                            // $pdf->setEncryption($doc_password);
                                            $pdf->setPaper('a4');
                                            $pdf->save(storage_path('app/public/downloads/'.$match->ref_no.'.pdf'));
        
                                        }elseif($match->type=='tbond'){
                                            $pdf =  PDF::loadView('certificates.tbond',$data);
                                            // $pdf->setEncryption($doc_password);
                                            $pdf->setPaper('a4');
                                            $pdf->save(storage_path('app/public/downloads/'.$match->ref_no.'.pdf'));    
                                        }else{
                                            // PDF::loadView('certificates.repo',$data)->save(storage_path('app/public/downloads/'.$match->ref_no.'.pdf'));
                                        }

                                        Mail::send('emails.accountActivate', 
                                        ['name' => $client->name,
                                        'email'=>$client->user->email,
                                        'investment'=>$investment->InvestmentType->name,
                                        'today'=> date('Y-m-d')], 
                                        function($message) use($client,$investment,$match){
                                            $message->to($client->user->email);
                                            $message->subject('Customer Confirmation'.$investment->InvestmentType->name)->attach(storage_path('app/public/downloads/'.$match->ref_no.'.pdf'));
                                        });
                                    }
                                    $investment->save();
                                }else{
                                    continue;
                                }

                        }
                               
        
           }

           $unMatchingRecords = DB::select('SELECT *  FROM  bank_records  WHERE  
           bank_records.account_id =0');


            $job = new GenerateUnMatchedCertificates([
                'unMatchingRecords' => $unMatchingRecords,
            ]);

            $job->handle(['unMatchingRecords' => $unMatchingRecords]);

    
        // DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return $e->getMessage();
        // }


        return redirect()->back();
    }

}