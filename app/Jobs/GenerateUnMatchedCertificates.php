<?php

namespace App\Jobs;

use App\EmptyEmail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
        $filteredEmptyRecords = array_filter($jobData['unMatchingRecords'], function($record) {
            return (empty($record->email) && $record->method=="New");
          });

          foreach($filteredEmptyRecords as $emptyRecord){

            EmptyEmail::updateOrCreate(
                ['ref' => $emptyRecord->ref_no],
               [
                'cus_id'=>$emptyRecord->cus_id1,
                'name' => $emptyRecord->name
               ]
            );

          }

        $filteredRecords = array_filter($jobData['unMatchingRecords'], function ($record) {
         
          // Check if email is empty or method is not "New"
          if ( !filter_var($record->email, FILTER_VALIDATE_EMAIL)|| $record->method != "New") {
           
              return false;
          }
      
          // Check if ref_no exists in sync_refs table
          $exists = DB::table('sync_refs')->where('ref', $record->ref_no)->exists();
      
          // Return true only if email is not empty, method is "New", and ref_no doesn't exist in sync_refs
          return !$exists;
      });

    
        
        foreach ($filteredRecords as $unMatch) {
           
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
                            'client_address_line_4' => $unMatch->address_line_4,
                            'today'  => Carbon::now()->format('j-F-Y'),
                            'maturity_date' => Carbon::createFromFormat('Y-m-d', $unMatch->maturity_date)->format('j-F-Y'),
                            'value_date' => Carbon::createFromFormat('Y-m-d', $unMatch->value_date)->format('j-F-Y'),
                            'trade_date' => Carbon::createFromFormat('Y-m-d', $unMatch->trade_date)->format('j-F-Y'),
                            'days_to_maturity' => Carbon::createFromFormat('Y-m-d H:s:i', $value_ymd)->diffInDays(Carbon::createFromFormat('Y-m-d H:s:i', $maturity_ymd)),
                           
                        ];
                $pdf = PDF::loadView('certificates.'.$unMatch->type, $data);
                $pdf->setPaper('a4');
                $pdf->save(storage_path('app/public/downloads/' . $unMatch->ref_no . '.pdf'));
                
           
        }

      

        $job2 = new SendMailsToUnMatchedCertificates($filteredRecords) ;
        event ($job2->handle($filteredRecords));
    }
}