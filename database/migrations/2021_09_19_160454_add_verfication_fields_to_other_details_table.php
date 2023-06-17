<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerficationFieldsToOtherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_details', function (Blueprint $table) {

            $table->tinyInteger('nsb_staff_fund_management_verify')->default(0)->after('nsb_staff_fund_management');
            $table->tinyInteger('nsb_staff_verify')->default(0)->after('nsb_staff');
            $table->tinyInteger('related_nsb_staff_verify')->default(0)->after('related_nsb_staff');
            $table->tinyInteger('staff_relationship_verify')->default(0)->after('staff_relationship');
            $table->tinyInteger('member_holding_company_verify')->default(0)->after('member_holding_company');
            $table->tinyInteger('member_holding_company_state_verify')->default(0)->after('member_holding_company_state');
            
            
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

            $table->dropColumn('nsb_staff_fund_management_verify');
            $table->dropColumn('nsb_staff_verify');
            $table->dropColumn('related_nsb_staff_verify');
            $table->dropColumn('staff_relationship_verify');
            $table->dropColumn('member_holding_company_verify');
            $table->dropColumn('member_holding_company_state_verify');
           
        });
    }
}
