<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeableToBankParticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_particulars', function (Blueprint $table) {
            $table->string('bank_name')->nullable()->default('N/A')->change();
            $table->string('branch')->nullable()->default('N/A')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_particulars', function (Blueprint $table) {
            //
        });
    }
}
