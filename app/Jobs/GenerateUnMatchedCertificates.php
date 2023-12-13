<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade as PDF;
class GenerateUnMatchedCertificates implements ShouldQueue
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
            $pdf = PDF::loadView('certificates.'.$unMatch->type, $data);
            $pdf->setPaper('a4');
            $pdf->save(storage_path('app/public/downloads/' . $unMatch->ref_no . '.pdf'));
        }

        $job2 = new SendMailsToUnMatchedCertificates($jobData) ;
        event ($job2->handle($jobData));
    }
}