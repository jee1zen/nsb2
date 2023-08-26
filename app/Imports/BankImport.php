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
            'account_id'=>$row[0],
            'ref_no'=>$row[1],
            'nic'=>$row[2],
            'type'=>$row[3],
            'name'=>$row[4],
            'cus_id1'=>$row[5],
            'cus_id2'=>$row[6],
            'cus_id3'=>$row[7],
            'investment_type' => $row[8],
            'value_date'=>Carbon::createFromFormat('m/d/Y', ltrim($row[9]))->format('Y-m-d'),
            'maturity_date'=>Carbon::createFromFormat('m/d/Y', ltrim($row[10]))->format('Y-m-d'),
            'price'=>$row[11],
            'yield'=>$row[12],
            'coupon'=>$row[13],
            'face_value'=>str_replace(",", "", $row[14]),
            'invested_amount'=>str_replace(",", "", $row[15]),
            'stock_ref'=> str_replace(",", "", $row[16]),
            'method' => $row[17],
            'ref_investment' => $row[18]

        ];
        
       
        return new BankRecord($data);
    }
}