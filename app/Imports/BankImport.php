<?php

namespace App\Imports;

use App\BankRecord;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BankImport implements ToModel,WithValidation, SkipsOnFailure,WithStartRow
{
    use Importable, SkipsFailures;

    public function rules(): array
    {
        return [
            // '0' => \Illuminate\Validation\Rule::unique('bank_records', 'ref_no'),
        ];
    }
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        config(['excel.import.startRow' => 2]);
        //  dd($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9]);

        $data=[

            'ref_no'=>$row[0],
            'nic'=>$row[1],
            'type'=>$row[2],
            'name'=>$row[3],
            'cus_id1'=>$row[4],
            'cus_id2'=>$row[5],
            'cus_id3'=>$row[6],
            'investment_type' => $row[7],
            'value_date'=>Carbon::createFromFormat('m/d/Y', ltrim($row[8]))->format('Y-m-d'),
            'maturity_date'=>Carbon::createFromFormat('m/d/Y', ltrim($row[9]))->format('Y-m-d'),
            'price'=>$row[10],
            'yield'=>$row[11],
            'coupon'=>$row[12],
            'face_value'=>str_replace(",", "", $row[13]),
            'invested_amount'=>str_replace(",", "", $row[14]),
            'stock_ref'=> str_replace(",", "", $row[15]),
            'method' => $row[16],
            'ref_investment' => $row[17]

        ];
        
       
        return new BankRecord($data);
    }
}