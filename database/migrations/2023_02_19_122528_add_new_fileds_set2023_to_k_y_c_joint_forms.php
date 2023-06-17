<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFiledsSet2023ToKYCJointForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_joint_forms', function (Blueprint $table) {
            
            $table->string('kyc_employment_status')->after('kyc_account_at_NSB_FMC')->nullable();
            $table->string('kyc_other_employement')->after('kyc_employment_status')->nullable();
            $table->string('kyc_marital_status')->after('kyc_employment_status')->nullable();
            $table->string('kyc_spouse_name')->after('kyc_marital_status')->nullable();
            $table->string('kyc_spouse_job')->after('kyc_spouse_name')->nullable();
            $table->string('kyc_nature_of_business_specify')->after('kyc_nature_of_business')->nullable();

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
            $table->dropColumn('kyc_employment_status');
            $table->dropColumn('kyc_marital_status');
            $table->dropColumn('kyc_spouse_name');
            $table->dropColumn('kyc_spouse_job');
            $table->dropColumn('kyc_other_employement');
            $table->dropColumn('kyc_nature_of_business_specify');
        });
    }
}