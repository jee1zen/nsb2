<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckFieldsToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {

            $table->tinyInteger('dob_verify')->default(0)->after('dob');
            $table->tinyInteger('nic_verify')->default(0)->after('nic');
            $table->tinyInteger('residence_address_verify')->default(0)->after('residence_address');
            $table->tinyInteger('title_verify')->default(0)->after('title');
            $table->tinyInteger('name_verify')->default(0)->after('name');
            $table->tinyInteger('telephone_verify')->default(0)->after('telephone');
            $table->tinyInteger('mobile_verify')->default(0)->after('mobile');
            $table->tinyInteger('nationality_verify')->default(0)->after('nationality');
            $table->tinyInteger('nic_front_verify')->default(0)->after('nic_front');
            $table->tinyInteger('nic_back_verify')->default(0)->after('nic_back');
            $table->tinyInteger('passport_verify')->default(0)->after('passport');
            $table->tinyInteger('signature_verify')->default(0)->after('signature');
            $table->tinyInteger('client_type_verify')->default(0)->after('client_type');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {

           $table->dropColumn('dob_verify');
           $table->dropColumn('nic_verify');
           $table->dropColumn('residence_address_verify');
           $table->dropColumn('title_verify');
           $table->dropColumn('name_verify');
           $table->dropColumn('telephone_verify');
           $table->dropColumn('mobile_verify');
           $table->dropColumn('nationality_verify');
           $table->dropColumn('nic_front_verify');
           $table->dropColumn('nic_back_verify');
           $table->dropColumn('passport_verify');
           $table->dropColumn('signature_verify');
           $table->dropColumn('client_type_verify');
        
        });
    }
}
