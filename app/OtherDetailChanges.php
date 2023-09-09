<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDetailChanges extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'nsb_staff_fund_management',
        'nsb_staff',
        'related_nsb_staff',
        'staff_relationship',
        'member_holding_company',
        'member_holding_company_state',
        'created_at',
        'updated_at',
    ];


    public function account(){
        return $this->belongsTo(Account::class);
    }
    
}