<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KYCCompany extends Model
{
    use HasFactory;

    protected $fillable = [
     'id',
     'kyc_account_at_NSB_FMC',
     'kyc_account_at_NSB_FMC_verify',
     'kyc_foreign_address',
     'kyc_foreign_address_verify',
     'kyc_countries',
     'kyc_countries_verify',
     'kyc_purpose_of_opening_account',
     'kyc_other_purpose',
     'kyc_other_purpose_verify',
     'kyc_source_of_funds',
     'kyc_source_of_funds_verify',
     'kyc_other_source',
     'kyc_other_source_verify',
     'kyc_anticipated_volume',
     'kyc_anticipated_volume_verify',
     'kyc_expected_mode_of_transacation',
     'kyc_expected_mode_of_transacation_verify',
     'kyc_other_connected_businesses',
     'kyc_other_connected_businesses_verify',
     'kyc_property',
     'kyc_property_verify',
     'kyc_motor_vehicles',
     'kyc_motor_vehicles_verify',
     'kyc_financial_assets',
     'kyc_financial_assets_verify',
     'kyc_investments',
     'kyc_investments_verify',
     'other_assets_name',
     'other_assets_value',
     'other_asset_verify',
     'has_foreign_investors',
     'has_foreign_investors_verify'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function kycForiegnInvestors(){
        return  $this->hasMany(KYCCompanyForeignInvestor::class,'company_id');
    }
    public function hasKycForiegnInvestors(){
        return (bool)  $this->kycForiegnInvestors()->first();
    }

}
