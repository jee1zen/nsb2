<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerifyFieldsToAuthorizedPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authorized_person', function (Blueprint $table) {

            $table->tinyInteger('name_verify')->default(0)->after('name');
            $table->tinyInteger('address_verify')->default(0)->after('address');
            $table->tinyInteger('nic_verify')->default(0)->after('nic');
            $table->tinyInteger('telephone_verify')->default(0)->after('telephone');
        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('authorized_person', function (Blueprint $table) {
            
            $table->dropColumn('name_verify');
            $table->dropColumn('address_verify');
            $table->dropColumn('nic_verify');
            $table->dropColumn('telephone_verify');

        });
    }
}
