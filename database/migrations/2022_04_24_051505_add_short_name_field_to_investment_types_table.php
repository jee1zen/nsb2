<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddShortNameFieldToInvestmentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investment_types', function (Blueprint $table) {
             $table->string('short_name')->after('name')->nullable();

        });

        DB::table('investment_types')
            ->where('id',1)
            ->update([
                "short_name" => 'TBILL'
        ]);

        DB::table('investment_types')
        ->where('id',2)
        ->update([
            "short_name" => 'TBOND'
        ]);

        DB::table('investment_types')
        ->where('id',3)
        ->update([
            "short_name" => 'REPO'
        ]);




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investment_types', function (Blueprint $table) {
            
            $table->dropColumn('short_name');
        });
    }
}
