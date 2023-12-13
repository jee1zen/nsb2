<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailFieldsToBankRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_records', function (Blueprint $table) {
            $table->string('email')->after('ref_investment')->nullable();
            $table->string('address_line_1')->after('email')->nullable();
            $table->string('address_line_2')->after('address_line_1')->nullable();
            $table->string('address_line_3')->after('address_line_2')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_records', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('address_line_1');
            $table->dropColumn('address_line_2');
            $table->dropColumn('address_line_3');
        });
    }
}