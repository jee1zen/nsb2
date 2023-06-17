<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMethodFieldToBankrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_records', function (Blueprint $table) {
            
            $table->string('investment_type')->after('cus_id3')->nullable();
            $table->string('method')->after('stock_ref')->nullable();

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
                $table->dropColumn('investment_type');
                $table->dropColumn('method');

        });
    }
}
