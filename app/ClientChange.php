<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientChange extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'dob',
        'nic',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'correspondence_address_line_1',
        'correspondence_address_line_2',
        'correspondence_address_line_3',
        'title',
        'name',
        'name_by_initials',
        'telephone',
        'mobile',
        'nationality',
        'verification_from_GOV',
        'money_laundering_verification',
        'nic_front',
        'nic_back',
        'passport',
        'signature',
        'billing_proof',
        'pro_pic',
    ];

    public function account(){
        return $this->belongsTo(Account::class,'account_id');
        
    }

}