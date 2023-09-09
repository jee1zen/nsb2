<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinHolderChange extends Model
{
    use HasFactory;
    protected $fillable = [
        'password',
        'account_id',
        'client_id',
        'user_id',
        'name',
        'title',
        'name_by_initials',
        'dob',
        'nic',
        'nationality',
        'email',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'correspondence_address_line_1',
        'correspondence_address_line_2',
        'correspondence_address_line_3',
        'telephone',
        'mobile',
        'nic_front',
        'nic_back',
        'passport',
        'signature',
        'pro_pic',
        'occupation',
        'company_name',
        'company_address',
        'company_telephone',
        'company_fax',
        'company_nature',
        'kyc_link',
        'email_verified_at',
    ];

    public function account(){
       return  $this->belongsTo(Account::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kyc(){
        return $this->hasOne(joinKycChanges::class,'joint_id','id');
    }
    public function hasKyc(){
        return (bool) $this->kyc()->first();
    }

}