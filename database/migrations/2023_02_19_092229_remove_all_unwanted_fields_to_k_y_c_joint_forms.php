<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAllUnwantedFieldsToKYCJointForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_joint_forms', function (Blueprint $table) {
            $table->dropColumn('kyc_account_at_NSB_FMC_verify');
            $table->dropColumn('kyc_ownership_of_premises_verify');
            $table->dropColumn('kyc_foreign_address_verify');
            $table->dropColumn('kyc_residence_verify');
            $table->dropColumn('kyc_citizenship_verify');
            $table->dropColumn('kyc_country_of_residence_verify');
            $table->dropColumn('kyc_country_of_birth_verify');
            $table->dropColumn('kyc_nationality_verify');
            $table->dropColumn('kyc_type_of_visa_verify');
            $table->dropColumn('kyc_other_visa_type_verify');
            $table->dropColumn('kyc_expiry_date_verify');
            $table->dropColumn('kyc_purpose_account_foreign_verify');
            $table->dropColumn('kyc_purpose_of_opening_account_verify');
            $table->dropColumn('kyc_other_purpose_verify');
            $table->dropColumn('kyc_source_of_funds_verify');
            $table->dropColumn('kyc_expected_mode_of_transacation_verify');
            $table->dropColumn('kyc_other_connected_businesses_verify');
            $table->dropColumn('kyc_expected_types_of_counterparties_verify');
            $table->dropColumn('kyc_operation_authority_verify');
            $table->dropColumn('kyc_other_name_verify');
            $table->dropColumn('kyc_other_address_verify');
            $table->dropColumn('kyc_other_nic_verify');
            $table->dropColumn('kyc_relationship_verify');
            $table->dropColumn('kyc_pep_verify');
            $table->dropColumn('kyc_us_person_verify');
            $table->dropColumn('kyc_nature_of_business_verify');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('k_y_c_joint_forms', function (Blueprint $table) {
            //
        });
    }
}