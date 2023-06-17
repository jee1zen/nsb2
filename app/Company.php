<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'company_type',
        'name',
        'address_line_1',
        'address_line_1_verify',
        'address_line_2',
        'address_line_2_verify',
        'address_line_3',
        'address_line_3_verify',
        'business_registration_no',
        'business_registration_no_verify',
        'nature_of_business',
        'nature_of_business_verify',
        'telephone_1',
        'telephone_1_verify',
        'telephone_2',
        'telephone_2_verify',
        'telephone_3',
        'telephone_3_verify',
        'email_1',
        'email_1_verify',
        'email_2',
        'email_2_verify',
        'email_3',
        'email_3_verify',
        'fax_1',
        'fax_1_verify',
        'fax_2',
        'fax_2_verify',
        'fax_3',
        'fax_3_verify',
        'business_registraton',
        'business_registraton_verify',
        'business_act',
        'business_act_verify',
        'trust_deed',
        'trust_deed_verify',
        'board_resolution',
        'board_resolution_verify',
        'society_constitution',
        'society_constitution_verify',
        'power_of_attorney',
        'power_of_attorney_verify',
        'partners_kyc',
        'partners_kyc_verify',
        'proprietors_kyc',
        'proprietors_kyc_verify',
        'certificate_of_registration',
        'certificate_of_registration_verify',
        'company_coi',
        'company_coi_verify',
        'created_at',
        'updated_at',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function kyc(){
        return $this->hasMany(KYCCompany::class,'company_id');

    }
    public function hasKyc(){
        return (bool) $this->kyc()->first();
    }

    public function hasKycWithType($investment_type){
        return (bool) $this->kyc()->where('investment_type','=',$investment_type)->first();
    }
    public function KycWithType($investment_type){
        return   $this->kyc()->where('investment_type','=',$investment_type)->first();
    }


}
