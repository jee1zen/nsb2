<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherEmployementFiledToKYCFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_forms', function (Blueprint $table) {
            $table->string('kyc_other_employement')->after('kyc_employment_status')->nullable();
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
            $table->dropColumn('kyc_other_employement');
        });
    }
}