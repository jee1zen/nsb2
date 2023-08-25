<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUploadFieldsNullableToJointHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('joint_holders', function (Blueprint $table) {

            $table->string('nic_front')->nullable()->change();
            $table->string('nic_back')->nullable()->change();
            $table->string('passport')->nullable()->change();
            $table->string('signature')->nullable()->change();
            $table->string('pro_pic')->nullable()->change();
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
            $table->string('nic_front')->nullable(false)->change();
            $table->string('nic_back')->nullable(false)->change();
            $table->string('passport')->nullable(false)->change();
            $table->string('signature')->nullable(false)->change();
            $table->string('pro_pic')->nullable(false)->change();
        });
    }
}