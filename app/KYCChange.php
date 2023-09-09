<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KYCChange extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'client_id',
        'investment_id',
        'kyc_account_at_NSB_FMC',
        'kyc_employment_status',
        'kyc_other_employment',
        'kyc_nature_of_business',
        'kyc_nature_of_business_specify',
        'kyc_marital_status',
        'kyc_spouse_name',
        'kyc_spouse_job',
        'kyc_ownership_of_premises',
        'kyc_foreign_address',
        'kyc_citizenship',
        'kyc_residence',
        'kyc_country_of_residence',
        'kyc_country_of_birth',
        'kyc_nationality',
        'kyc_type_of_visa',
        'kyc_other_visa_type',
        'kyc_expiry_date',
        'kyc_purpose_account_foreign',
        'kyc_purpose_of_opening_account',
        'kyc_other_purpose',
        'kyc_source_of_funds',
        'kyc_other_source',
        'kyc_other_source_verify',
        'kyc_anticipated_volume',
        'kyc_anticipated_volume_verify',
        'kyc_expected_mode_of_transaction',
        'kyc_other_connected_businesses',
        'kyc_expected_types_of_counterparties',
        'kyc_operation_authority',
        'kyc_other_name',
        'kyc_other_address',
        'kyc_other_nic',
        'kyc_relationship',
        'kyc_pep',
        'kyc_us_person',
        'risk_rate',
        'officer_remarks',
        'officer',
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}