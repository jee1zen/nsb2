<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvestmentIdToKYCJointForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_joint_forms', function (Blueprint $table) {
            $table->bigInteger('investment_id')->after('joint_id');
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
        Schema::table('k_y_c_joint_forms', function (Blueprint $table) {
            $table->dropColumn('investment_id');
            $table->tinyInteger('investment_type');
        });
    }
}
