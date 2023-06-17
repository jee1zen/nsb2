<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToKYCFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_forms', function (Blueprint $table) {
            //
            $table->boolean('kyc_residence_verify')->after('kyc_residence')->default(0);
            $table->string('kyc_relationship')->after('kyc_other_nic_verify');
            $table->boolean('kyc_relationship_verify')->after('kyc_relationship')->default(0);
            $table->string('kyc_pep')->after('kyc_relationship_verify');
            $table->boolean('kyc_pep_verify')->after('kyc_pep')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('k_y_c_forms', function (Blueprint $table) {
            $table->dropColumn('kyc_residence_verify');
            $table->dropColumn('kyc_relationship');
            $table->dropColumn('kyc_relationship_verify');
            $table->dropColumn('kyc_pep');
            $table->dropColumn('kyc_pep_verify');
        });
    }
}
