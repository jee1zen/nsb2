<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKYCChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_y_c_changes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id')->nullable();
            $table->bigInteger('client_id');
            $table->bigInteger('investment_id');
            $table->string('kyc_account_at_NSB_FMC', 255);
            $table->string('kyc_employment_status', 255)->nullable();
            $table->string('kyc_other_employment', 255)->nullable();
            $table->string('kyc_nature_of_business', 255)->nullable();
            $table->string('kyc_nature_of_business_specify', 255)->nullable();
            $table->string('kyc_marital_status', 255)->nullable();
            $table->string('kyc_spouse_name', 255)->nullable();
            $table->string('kyc_spouse_job', 255)->nullable();
            $table->string('kyc_ownership_of_premises', 255);
            $table->string('kyc_foreign_address', 255)->nullable();
            $table->string('kyc_citizenship', 255);
            $table->string('kyc_residence', 255);
            $table->string('kyc_country_of_residence', 255)->nullable();
            $table->string('kyc_country_of_birth', 255)->nullable();
            $table->string('kyc_nationality', 255)->nullable();
            $table->string('kyc_type_of_visa', 255)->nullable();
            $table->string('kyc_other_visa_type', 255)->nullable();
            $table->string('kyc_expiry_date', 255)->nullable();
            $table->string('kyc_purpose_account_foreign', 255)->nullable();
            $table->string('kyc_purpose_of_opening_account', 255);
            $table->string('kyc_other_purpose', 255)->nullable();
            $table->string('kyc_source_of_funds', 255);
            $table->string('kyc_other_source', 255)->nullable();
            $table->tinyInteger('kyc_other_source_verify')->default(0);
            $table->string('kyc_anticipated_volume', 255);
            $table->tinyInteger('kyc_anticipated_volume_verify')->default(0);
            $table->string('kyc_expected_mode_of_transaction', 255);
            $table->string('kyc_other_connected_businesses', 255)->nullable();
            $table->string('kyc_expected_types_of_counterparties', 255)->nullable();
            $table->string('kyc_operation_authority', 255);
            $table->string('kyc_other_name', 255)->nullable();
            $table->string('kyc_other_address', 255)->nullable();
            $table->string('kyc_other_nic', 255)->nullable();
            $table->string('kyc_relationship', 255);
            $table->string('kyc_pep', 255);
            $table->string('kyc_us_person', 255);
            $table->string('risk_rate', 255)->nullable();
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
        Schema::dropIfExists('k_y_c_changes');
    }
}