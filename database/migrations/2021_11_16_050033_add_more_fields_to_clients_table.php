<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            
            $table->string('verification_from_GOV')->after('nationality_verify')->nullable();
            $table->boolean('verification_from_GOV_verify')->after('verification_from_GOV')->nullable();
            $table->string('money_laundering_verification')->after('verification_from_GOV_verify')->nullable();
            $table->boolean('money_laundering_verification_verify')->after('money_laundering_verification')->nullable();

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
            //
        });
    }
}
