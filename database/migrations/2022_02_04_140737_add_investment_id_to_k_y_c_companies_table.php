<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvestmentIdToKYCCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_companies', function (Blueprint $table) {
            $table->bigInteger('investment_id')->after('company_id');
            $table->dropColumn('investment_type');
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
            $table->dropColumn('investment_id');
            $table->tinyInteger('investment_type');
        });
    }
}
