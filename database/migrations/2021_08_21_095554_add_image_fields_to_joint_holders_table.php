<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageFieldsToJointHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('joint_holders', function (Blueprint $table) {
            $table->string('nic_front')->after('mobile');
            $table->string('nic_back')->after('nic_front');
            $table->string('signature')->after('nic_back');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('joint_holders', function (Blueprint $table) {
            $table->dropColumn('nic_front');
            $table->dropColumn('nic_back');
            $table->dropColumn('signature');
        });
    }
}
