<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypesToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {

            $table->tinyInteger('address_line_1_verify')->default(0)->change();
            $table->tinyInteger('address_line_2_verify')->default(0)->change();
            $table->tinyInteger('address_line_3_verify')->default(0)->change();
            $table->tinyInteger('correspondence_address_line_1_verify')->default(0)->change();
            $table->tinyInteger('correspondence_address_line_2_verify')->default(0)->change();
            $table->tinyInteger('correspondence_address_line_3_verify')->default(0)->change();

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
