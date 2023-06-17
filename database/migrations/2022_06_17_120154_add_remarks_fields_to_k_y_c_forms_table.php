<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemarksFieldsToKYCFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_forms', function (Blueprint $table) {
            $table->string('risk_rate')->nullable()->after('kyc_us_person_verify');
            $table->text('officer_remarks')->nullable()->after('risk_rate');
            $table->bigInteger('officer')->nullable()->after('officer_remarks');
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
            $table->dropColumn('risk_rate');
            $table->dropColumn('officer_remarks');
            $table->dropColumn('officer');
        });
    }
}
