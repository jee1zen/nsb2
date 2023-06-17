<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySignature extends Model
{
    use HasFactory;

    protected $fillable=[
        'client_id',
        'password',
        'user_id',
        'name',
        'title',
        'name_verify',
        'occupation',
        'dob',
        'dob_verify',
        'nic',
        'nic_verify',
        'nationality',
        'nationality_verify',
        'email',
        'email_verify',
        'address_line_1',
        'address_line_1_verify',
        'address_line_2',
        'address_line_2_verify',
        'address_line_3',
        'address_line_3_verify',
        'telephone',
        'telephone_verify',
        'mobile',
        'mobile_verify',
        'nic_front',
        'nic_front_verify',
        'nic_back',
        'nic_back_verify',
        'passport',
        'passport_verify',
        'signature',
        'signature_verify',
        'type',
        'type_verify',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    public function client(){
      return  $this->belongsTo(Client::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kyc(){
        return  $this->hasOne(KYCCompanySignatureForms::class,'id');
    }

    public function haskyc(){
        return (bool) $this->kyc()->first();
    }

}
