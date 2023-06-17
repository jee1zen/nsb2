<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvestmentIdFieldToKYCCompanyForeignInvestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_company_foreign_investors', function (Blueprint $table) {
            //
            $table->bigInteger('investment_id')->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('k_y_c_company_foreign_investors', function (Blueprint $table) {
            //
            $table->dropColumn('investment_id');
        });
    }
}
