<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsVerifyToEmploymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employment_details', function (Blueprint $table) {

            $table->tinyInteger('occupation_verify')->default(0)->after('occupation');
            $table->tinyInteger('company_name_verify')->default(0)->after('company_name');
            $table->tinyInteger('company_address_verify')->default(0)->after('company_address');
            $table->tinyInteger('telephone_verify')->default(0)->after('telephone');
            $table->tinyInteger('fax_verify')->default(0)->after('fax');
            $table->tinyInteger('nature_verify')->default(0)->after('nature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employment_details', function (Blueprint $table) {
            
            $table->dropColumn('occupation_verify');
            $table->dropColumn('company_name_verify');
            $table->dropColumn('company_address_verify');
            $table->dropColumn('telephone_verify');
            $table->dropColumn('fax_verify');
            $table->dropColumn('nature_verify');
        });
    }
}
