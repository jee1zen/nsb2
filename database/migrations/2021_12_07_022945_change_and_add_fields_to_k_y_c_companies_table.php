<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAndAddFieldsToKYCCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_companies', function (Blueprint $table) {
            //
            $table->bigInteger('id')->change();
            $table->bigInteger('company_id')->after('id');
            $table->tinyInteger('investment_type')->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('k_y_c_companies', function (Blueprint $table) {
            //
        });
    }
}
