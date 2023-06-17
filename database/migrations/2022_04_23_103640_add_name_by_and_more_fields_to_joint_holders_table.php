<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameByAndMoreFieldsToJointHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('joint_holders', function (Blueprint $table) {

            $table->string('name_by_initials')->after('name_verify')->nullable();
            $table->tinyInteger('name_by_initials_verify')->after('name_by_initials')->default(0);
            $table->string('pro_pic')->after('signature_verify')->nullable();
            $table->tinyInteger('pro_pic_verify')->after('pro_pic')->default(0);
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
            
            $table->dropColumn('name_by_initials');
            $table->dropColumn('name_by_initials_verify');
            $table->dropColumn('pro_pic');
            $table->dropColumn('pro_pic_verify');
        });
    }
}
