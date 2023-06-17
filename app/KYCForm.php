<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KYCForm extends Model
{
    use HasFactory;
    public $table = 'k_y_c_forms';

    protected $fillable = [
        'id',
        'investment_id',
        'kyc_account_at_NSB_FMC',
        'kyc_ownership_of_premises',
        'kyc_foreign_address',
        'kyc_citizenship',
        'kyc_residence',
        'kyc_country_of_residence',
        'kyc_country_of_birth',
        'kyc_employment_status',
        'kyc_other_employement',
        'kyc_nature_of_business',
        'kyc_nature_of_business_specify',
        'kyc_marital_status',
        'kyc_spouse_name',
        'kyc_spouse_job',
        'kyc_type_of_visa',
        'kyc_other_visa_type',
        'kyc_expiry_date',
        'kyc_purpose_account_foreign',
        'kyc_purpose_of_opening_account',
        'kyc_other_purpose',
        'kyc_source_of_funds',
        'kyc_other_source',
        'kyc_anticipated_volume',
        'kyc_expected_mode_of_transacation',
        'kyc_other_connected_businesses',
        'kyc_expected_types_of_counterparties',
        'kyc_operation_authority',
        'kyc_other_name_verify',
        'kyc_other_address',
        'kyc_other_nic',
        'kyc_relationship',
        'kyc_pep',
        'kyc_us_person',
        'risk_rate',
        'officer_remarks',
        'officer',
        'created_at',
        'updated_at',
    ];


    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function remarkOfficer(){
        return $this->belongsTo(User::class,'officer');
    }

    public function investment(){
        return $this->belongsTo(Investment::class);
    }
    
}