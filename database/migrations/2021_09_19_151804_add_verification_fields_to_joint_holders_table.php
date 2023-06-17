<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerificationFieldsToJointHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('joint_holders', function (Blueprint $table) {

            $table->tinyInteger('name_verify')->default(0)->after('name');
            $table->tinyInteger('dob_verify')->default(0)->after('dob');
            $table->tinyInteger('nic_verify')->default(0)->after('nic');
            $table->tinyInteger('nationality_verify')->default(0)->after('nationality');
            $table->tinyInteger('residence_address_verify')->default(0)->after('residence_address');
            $table->tinyInteger('telephone_verify')->default(0)->after('telephone');
            $table->tinyInteger('mobile_verify')->default(0)->after('mobile');
            $table->tinyInteger('nic_front_verify')->default(0)->after('nic_front');
            $table->tinyInteger('nic_back_verify')->default(0)->after('nic_back');
            $table->tinyInteger('passport_verify')->default(0)->after('passport');
            $table->tinyInteger('signature_verify')->default(0)->after('signature');
           

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
            
            $table->dropColumn('name_verify');
            $table->dropColumn('dob_verify');
            $table->dropColumn('nic_verify');
            $table->dropColumn('nationality_verify');
            $table->dropColumn('residence_address_verify');
            $table->dropColumn('telephone_verify');
            $table->dropColumn('mobile_verify');
            $table->dropColumn('nic_front_verify');
            $table->dropColumn('nic_back_verify');
            $table->dropColumn('passport_verify');
            $table->dropColumn('signature_verify');

        });
    }
}
