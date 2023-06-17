<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldUsPersonToKYCFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_forms', function (Blueprint $table) {
            $table->string('kyc_us_person')->after('kyc_pep_verify');
            $table->boolean('kyc_us_person_verify')->after('kyc_us_person')->default(0);

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
          $table->dropColumn('kyc_us_person');
          $table->dropColumn('kyc_us_person_verify');
        });
    }
}
