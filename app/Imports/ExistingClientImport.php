<?php

namespace App\Imports;

use App\ExistingClient;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ExistingClientImport implements ToModel,WithValidation, SkipsOnFailure,WithStartRow
{
    use Importable, SkipsFailures;

    public function rules(): array
    {
        return [
             '0' => \Illuminate\Validation\Rule::unique('existing_clients', 'cus_id'),
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

        $addressArray = explode(",", $row[3]);

       

      $addressLineCount = count($addressArray);
      
      if($addressLineCount==4){

       $address_line_1 = $addressArray[0];
       $address_line_2 = $addressArray[1].','.$addressArray[2];
       $address_line_3 = $addressArray[3];

      }elseif($addressLineCount==3){

        $address_line_1 = $addressArray[0];
        $address_line_2 = $addressArray[1];
        $address_line_3 = $addressArray[2];

      }elseif($addressLineCount==2){

        $address_line_1 = $addressArray[0];
        $address_line_2 = $addressArray[1];
        $address_line_3 ="";

      }elseif($addressLineCount==1 || $addressLineCount==0){

        $address_line_1 = $row[3];
        $address_line_2 ="";
        $address_line_3 ="";

      }



        $data=[

            'cus_id'=>$row[0],
            'customer_name'=>$row[1],
            'nic'=>$row[2],
            'address_line_1'=>$address_line_1,
            'address_line_2'=>$address_line_2,
            'address_line_3'=>$address_line_3,
            'email' => $row[4],
            'mobile'=>$row[5],
         

        ];
        
       
        return new ExistingClient($data);
    }
}
