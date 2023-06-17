<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefInvestmentToBankRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_records', function (Blueprint $table) {
            $table->string('ref_investment')->nullable()->after('method');

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
            $table->dropColumn('ref_investment');
        });
    }
}
