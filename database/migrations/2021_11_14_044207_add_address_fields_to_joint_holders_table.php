<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressFieldsToJointHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('joint_holders', function (Blueprint $table) {
            $table->string('address_line_2')->after('address_line_1_verify');
            $table->string('address_line_2_verify')->after('address_line_2');
            $table->string('address_line_3')->after('address_line_2_verify')->nullable();
            $table->string('address_line_3_verify')->after('address_line_3')->nullable();
            $table->string('correspondence_address_line_1')->after('address_line_3_verify');
            $table->string('correspondence_address_line_1_verify')->after('correspondence_address_line_1');
            $table->string('correspondence_address_line_2')->after('correspondence_address_line_1_verify');
            $table->string('correspondence_address_line_2_verify')->after('correspondence_address_line_2');
            $table->string('correspondence_address_line_3')->after('correspondence_address_line_2_verify')->nullable();
            $table->string('correspondence_address_line_3_verify')->after('correspondence_address_line_3')->nullable();
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
