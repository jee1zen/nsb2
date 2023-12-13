<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class GenerateAndSendCertificateEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  
    public function handle($jobData)
    {
        // dd($jobData);
        // Generate the certificates
        foreach ($jobData['unMatchingRecords'] as $unMatch) {
            $valueDate    = $unMatch->value_date . " 23:59:59";
            $maturityDate = $unMatch->maturity_date . " 23:59:59";
            $value_ymd =  Carbon::createFromFormat('Y-m-d H:s:i', $valueDate);
            $maturity_ymd  = Carbon::createFromFormat('Y-m-d H:s:i', $maturityDate);
            $data = [
                        'match' => $unMatch,
                        'client_title' => "",
                        'client_name' => $unMatch->name,
                        'client_address_line_1' =>$unMatch->address_line_1,
                        'client_address_line_2' => $unMatch->address_line_2,
                        'client_address_line_3' => $unMatch->address_line_3,
                        'today'  => Carbon::now()->format('j-F-Y'),
                        'maturity_date' => Carbon::createFromFormat('Y-m-d', $unMatch->maturity_date)->format('j-F-Y'),
                        'value_date' => Carbon::createFromFormat('Y-m-d', $unMatch->value_date)->format('j-F-Y'),
                        'days_to_maturity' => Carbon::createFromFormat('Y-m-d H:s:i', $value_ymd)->diffInDays(Carbon::createFromFormat('Y-m-d H:s:i', $maturity_ymd))
                    ];
            $pdf = PDF::loadView('certificates.tbill', $data);
            $pdf->setPaper('a4', 'landscape');
            $pdf->save(storage_path('app/public/downloads/' . $unMatch->ref_no . '.pdf'));
        }

        // Send the emails
        foreach ($jobData['unMatchingRecords'] as $unMatch) {
            if ($unMatch->method == 'New') {
                Mail::send(
                    'emails.accountActivate',
                    [
                        'name' => $unMatch->name,
                        'email' => $unMatch->email,
                        'investment' => $unMatch->type,
                        'today' => date('Y-m-d')
                    ],
                    function ($message) use ($unMatch) {
                        $message->to($unMatch->email);
                        $message->subject('Customer Confirmation' . $unMatch->type)->attach(storage_path('app/public/downloads/' . $unMatch->ref_no . '.pdf'));
                    }
                );
            }
        }
    
     }
    
}