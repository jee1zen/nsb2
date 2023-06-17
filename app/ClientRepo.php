<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRepo extends Model
{
    use HasFactory;
    protected $fillable=[
        'client_id',
        'cus_id',
        'nic',
        'cus_name',
        'cus_id2',
        'nic2',
        'cus_name',
        'cus_id3',
        'nic3',
        'cus_name3',
        'value_date',
        'mat_date',
        'deal_no',
        'invested_value',
        'interest',
        'yield',
        'maturity_value',
        'isin',
        'face_value',
        'market_value',
        'maturity_date',
        'haircut',
        'method'
    ];

    public function investment(){
        return $this->belongsTo(Investment::class,'deal_no','deal_no');
    }

}
