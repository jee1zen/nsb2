<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKYCFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_y_c_forms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            // $table->string('kyc_name');
            // $table->boolean('kyc_name_verify')->default(0);
            // $table->string('kyc_nic');
            // $table->boolean('kyc_nic_verify')->default(0);
            $table->string('kyc_account_at_NSB_FMC');
            $table->boolean('kyc_account_at_NSB_FMC_verify')->default(0);
            // $table->string('kyc_nature_of_business');
            // $table->boolean('kyc_nature_of_business_verify')->default(0);
            // $table->string('kyc_employment');
            // $table->boolean('kyc_employment_verify')->default(0);
            // $table->string('kyc_employer_address');
            // $table->boolean('kyc_employer_address_verify')->default(0);
            $table->string('kyc_ownership_of_premises');
            $table->boolean('kyc_ownership_of_premises_verify')->default(0);
            // $table->string('kyc_permanent_address');
            // $table->boolean('kyc_permanent_address_verify')->default(0);
            $table->string('kyc_foreign_address')->nullable();
            $table->string('kyc_foreign_address_verify')->default(0);
            $table->string('kyc_citizenship');
            $table->boolean('kyc_citizenship_verify')->default(0);
            $table->string('kyc_country_of_residence')->nullable();
            $table->boolean('kyc_country_of_residence_verify')->default(0);
            $table->string('kyc_country_of_birth')->nullable();
            $table->boolean('kyc_country_of_birth_verify')->default(0);
            $table->string('kyc_nationality')->nullable();
            $table->boolean('kyc_nationality_verify')->default(0);
            $table->string('kyc_type_of_visa')->nullable();
            $table->boolean('kyc_type_of_visa_verify')->default(0);
            $table->string('kyc_other_visa_type')->nullable();
            $table->boolean('kyc_other_visa_type_verify')->default(0);
            $table->string('kyc_expiry_date')->nullable();
            $table->boolean('kyc_expiry_date_verify')->default(0);
            $table->string('kyc_purpose_account_foreign')->nullable();
            $table->boolean('kyc_purpose_account_foreign_verify')->default(0);
            $table->string('kyc_purpose_of_opening_account');
            $table->boolean('kyc_purpose_of_opening_account_verify')->default(0);
            $table->string('kyc_other_purpose')->nullable();
            $table->boolean('kyc_other_purpose_verify')->default(0);
            $table->string('kyc_source_of_funds');
            $table->boolean('kyc_source_of_funds_verify')->default(0);
            $table->string('kyc_other_source')->nullable();
            $table->boolean('kyc_other_source_verify')->default(0);
            $table->string('kyc_anticipated_volume');
            $table->boolean('kyc_anticipated_volume_verify')->default(0);
            $table->string('kyc_expected_mode_of_transacation');
            $table->boolean('kyc_expected_mode_of_transacation_verify')->default(0);
            $table->string('kyc_other_connected_businesses')->nullable();
            $table->boolean('kyc_other_connected_businesses_verify')->default(0);
            $table->string('kyc_expected_types_of_counterparties')->nullable();
            $table->boolean('kyc_expected_types_of_counterparties_verify')->default(0);
            $table->string('kyc_operation_authority');
            $table->boolean('kyc_operation_authority_verify')->default(0);
            $table->string('kyc_other_name')->nullable();
            $table->boolean('kyc_other_name_verify')->default(0);
            $table->string('kyc_other_address')->nullable();
            $table->boolean('kyc_other_address_verify')->default(0);
            $table->string('kyc_other_nic')->nullable();
            $table->boolean('kyc_other_nic_verify')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('k_y_c_forms');
    }
}
