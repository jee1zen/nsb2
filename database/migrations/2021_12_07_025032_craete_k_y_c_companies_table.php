<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraeteKYCCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_y_c_companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->tinyInteger('investment_type');
            $table->string('kyc_account_at_NSB_FMC');
            $table->boolean('kyc_account_at_NSB_FMC_verify')->default(0);
            $table->string('kyc_foreign_address')->nullable();
            $table->string('kyc_foreign_address_verify')->default(0);
            $table->string('kyc_countries')->nullable();
            $table->string('kyc_countries_verify')->default(0);
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
            $table->double('kyc_property')->default(0);
            $table->boolean('kyc_property_verify')->default(0);
            $table->double('kyc_motor_vehicles')->default(0);
            $table->boolean('kyc_motor_vehicles_verify')->default(0);
            $table->double('kyc_financial_assets')->default(0);
            $table->double('kyc_financial_assets_verify')->default(0);
            $table->double('kyc_investments')->default(0);
            $table->boolean('kyc_investments_verify')->default(0);
            $table->string('other_assets_name')->nullable();
            $table->double('other_assets_value')->default(0);
            $table->boolean('other_asset_verify')->default(0);
            $table->boolean('has_foreign_investors')->default(0);
            $table->boolean('has_foreign_investors_verify')->default(0);
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
        Schema::dropIfExists('k_y_c_companies');
    }
}
