<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankRecord extends Model
{
    use HasFactory;
    public $table = 'bank_records';
    protected $fillable=[
        'account_id',
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
        'method',
        'ref_investment',
        'email',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'address_line_4',
        'trade_date',
    ];
}