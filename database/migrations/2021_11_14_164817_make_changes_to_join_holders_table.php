<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeChangesToJoinHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('joint_holders', function (Blueprint $table) {
            
            $table->boolean('address_line_1_verify')->default(0)->change();
            $table->boolean('address_line_2_verify')->default(0)->change();
            $table->boolean('address_line_3_verify')->default(0)->change();
            $table->boolean('correspondence_address_line_1_verify')->default(0)->change();
            $table->boolean('correspondence_address_line_2_verify')->default(0)->change();
            $table->boolean('correspondence_address_line_3_verify')->default(0)->change();
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
            //
        });
    }
}
