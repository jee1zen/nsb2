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
            $table->bigInteger('account_id')->nullable();
            $table->bigInteger('client_id');
            $table->bigInteger('investment_id');
            $table->string('kyc_account_at_NSB_FMC');
            $table->string('kyc_employment_status')->nullable();
            $table->string('kyc_other_employement')->nullable();
            $table->string('kyc_nature_of_business')->nullable();
            $table->string('kyc_nature_of_business_specify')->nullable();
            $table->string('kyc_marital_status')->nullable();
            $table->string('kyc_spouse_name')->nullable();
            $table->string('kyc_spouse_job')->nullable();
            $table->string('kyc_ownership_of_premises');
            $table->string('kyc_foreign_address')->nullable();
            $table->string('kyc_citizenship');
            $table->string('kyc_residence');
            $table->string('kyc_country_of_residence')->nullable();
            $table->string('kyc_country_of_birth')->nullable();
            $table->string('kyc_nationality')->nullable();
            $table->string('kyc_type_of_visa')->nullable();
            $table->string('kyc_other_visa_type')->nullable();
            $table->string('kyc_expiry_date')->nullable();
            $table->string('kyc_purpose_account_foreign')->nullable();
            $table->string('kyc_purpose_of_opening_account');
            $table->string('kyc_other_purpose')->nullable();
            $table->string('kyc_source_of_funds');
            $table->string('kyc_other_source')->nullable();
            $table->boolean('kyc_other_source_verify')->default(0);
            $table->string('kyc_anticipated_volume');
            $table->boolean('kyc_anticipated_volume_verify')->default(0);
            $table->string('kyc_expected_mode_of_transacation');
            $table->string('kyc_other_connected_businesses')->nullable();
            $table->string('kyc_expected_types_of_counterparties')->nullable();
            $table->string('kyc_operation_authority');
            $table->string('kyc_other_name')->nullable();
            $table->string('kyc_other_address')->nullable();
            $table->string('kyc_other_nic')->nullable();
            $table->string('kyc_relationship');
            $table->string('kyc_pep');
            $table->string('kyc_us_person');
            $table->string('risk_rate')->nullable();
            $table->text('officer_remarks')->nullable();
            $table->bigInteger('officer')->nullable();
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
