<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankRepo extends Model
{
    use HasFactory;
    public $table = 'bank_repos';
    protected $fillable=[
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
}
