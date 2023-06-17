<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNsbFundManagementFieldToOtherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_details', function (Blueprint $table) {
            $table->tinyInteger('nsb_staff_fund_management')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_details', function (Blueprint $table) {
           $table->dropColumn('nsb_staff_fund_management');
            //
        });
    }
}
