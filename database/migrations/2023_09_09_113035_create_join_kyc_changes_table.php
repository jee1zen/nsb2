<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinKycChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_kyc_changes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('joint_id');
            $table->bigInteger('account_id');
            $table->bigInteger('investment_id');
            $table->string('kyc_account_at_NSB_FMC', 255);
            $table->string('kyc_employment_status', 255)->nullable();
            $table->string('kyc_marital_status', 255)->nullable();
            $table->string('kyc_spouse_name', 255)->nullable();
            $table->string('kyc_spouse_job', 255)->nullable();
            $table->string('kyc_other_employement', 255)->nullable();
            $table->string('kyc_nature_of_business', 255);
            $table->string('kyc_nature_of_business_specify', 255)->nullable();
            $table->string('kyc_employment', 255);
            $table->tinyInteger('kyc_employment_verify')->default(0);
            $table->string('kyc_employer_address', 255);
            $table->tinyInteger('kyc_employer_address_verify')->default(0);
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
            $table->string('kyc_expected_mode_of_transacation', 255);
            $table->string('kyc_other_connected_businesses', 255)->nullable();
            $table->string('kyc_expected_types_of_counterparties', 255)->nullable();
            $table->string('kyc_operation_authority', 255);
            $table->string('kyc_other_name', 255)->nullable();
            $table->string('kyc_other_address', 255)->nullable();
            $table->string('kyc_other_nic', 255)->nullable();
            $table->string('kyc_relationship', 255);
            $table->string('kyc_pep', 255);
            $table->string('kyc_us_person', 255);
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
        Schema::dropIfExists('join_kyc_changes');
    }
}