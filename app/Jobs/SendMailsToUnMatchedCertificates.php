<?php

namespace App\Jobs;

use App\SyncRef;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailsToUnMatchedCertificates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($jobData)
    {
        foreach ($jobData as $unMatch) {

                  if($unMatch->type=="tbill"){
                    $type = "TBill";
                  }else{
                    $type="TBond";
                  }
          
                    Mail::send(
                        'emails.accountActivate',
                        [
                            'name' => $unMatch->name,
                            'email' => $unMatch->email,
                            'investment' => $unMatch->type,
                            'today' => date('Y-m-d')
                        ],
                        function ($message) use ($unMatch,$type) {
                            $message->to($unMatch->email);
                            $message->subject('Customer Confirmation  ' . $type)->attach(storage_path('app/public/downloads/' . $unMatch->ref_no . '.pdf'));
                        }
                    );


                    SyncRef::create([
                        'ref'=>$unMatch->ref_no,
                        'name'=>$unMatch->name,
                        'email'=>$unMatch->email,
                    ]);
                  
                
            
        }
    }
}