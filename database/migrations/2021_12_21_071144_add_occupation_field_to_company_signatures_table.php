<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOccupationFieldToCompanySignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_signatures', function (Blueprint $table) {
            $table->string('occupation')->after('name_verify');
            $table->boolean('occupation_verify')->after('occupation')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_signatures', function (Blueprint $table) {
            $table->dropColumn('occupation');
            $table->dropColumn('occupation_verify');
        });
    }
}
