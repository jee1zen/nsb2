<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRecord extends Model
{
    use HasFactory;
    protected $fillable=[
        'ref_no',
        'nic',
        'type',
        'name',
        'cus_id1',
        'cus_id2',
        'cus_id3',
        'investment_type',
        'value_date',
        'maturity_date',
        'price',
        'yield',
        'coupon',
        'face_value',
        'invested_amount',
        'stock_ref',
        'method'
            
       ];




   public function bankRecord(){
       return $this->belongsTo(BankRecord::class)->withDefault();

   }   
   
   public function client(){
       return $this->belongsTo(Client::class)->withDefault();

   }

   public function invesmentType(){
       return $this->belongsTo(InvestmentType::class);
   }
   
}
