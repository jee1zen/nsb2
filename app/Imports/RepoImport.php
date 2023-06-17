<?php

namespace App\Imports;

use App\BankRecord;
use App\BankRepo;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RepoImport implements ToModel,WithValidation,SkipsOnFailure,WithStartRow
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
        // dd($row[20]);
        $data =[
            
            'cus_id'=>$row[1],
            'nic'=>$row[2],
            'cus_name'=>$row[3],
            'cus_id2'=>$row[4],
            'nic2'=>$row[5],
            'cus_name2'=>$row[6],
            'cus_id3'=>$row[7],
            'nic3'=>$row[8],
            'cus_name3'=>$row[9],
            'value_date'=>Carbon::createFromFormat('m/d/Y', ltrim($row[10]))->format('Y-m-d'),
            'mat_date'=>Carbon::createFromFormat('m/d/Y', ltrim($row[11]))->format('Y-m-d'),
            'deal_no' => $row[12],
            'invested_value'=> str_replace(",", "", $row[13]),
            'interest'=>str_replace(",", "", $row[14]),
            'yield'=>str_replace(",", "", $row[15]),
            'maturity_value'=>str_replace(",", "", $row[16]),
            'isin'=> $row[17],
            'face_value'=>str_replace(",", "", $row[18]),
            'market_value'=>str_replace(",", "", $row[19]),
            'maturity_date'=>Carbon::createFromFormat('m/d/Y', ltrim($row[20]))->format('Y-m-d'),
            'haircut'=>str_replace('%','',$row[21]),
            'method'=>$row[22],
            'ref_investment'=>$row[23]
        ];
       

        return new BankRepo($data);
  


      
       
       
    }
}