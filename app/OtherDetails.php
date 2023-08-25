<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDetails extends Model
{
    use HasFactory;
    public $table = 'other_details';

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        
        'id',
        'nsb_staff_fund_management',
        'nsb_staff',
        'related_nsb_staff',
        'staff_relationship',
        'member_holding_company',
        'member_holding_company_state',
        'created_at',
        'updated_at',
    ];

    public function client(){
        $this->belongsTo(Client::class,'id','id');
    }
}