<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldToKYCJointHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_y_c_joint_forms', function (Blueprint $table) {
            //
            $table->bigIncrements('id')->change();
            $table->bigInteger('joint_id')->after('id');
            $table->tinyInteger('investment_type')->after('joint_id');
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
            //
        });
    }
}
