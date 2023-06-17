<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherNatureOfBusinessToKYCFromsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_forms', function (Blueprint $table) {
            $table->string('kyc_nature_of_business')->after('kyc_other_employement')->nullable();
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
        Schema::table('k_y_c_forms', function (Blueprint $table) {

            $table->dropColumn('kyc_nature_of_business');
            $table->dropColumn('kyc_nature_of_business_specify');
        });
    }
}