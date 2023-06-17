<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_investments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_record_id');
            $table->bigInteger('investment_id');
            $table->string('ref_no');
            $table->bigInteger('client_id');
            $table->bigInteger('investment_type_id');
            $table->double('invested_amount');
            $table->double('matured_amount');
            $table->date('value_date');
            $table->date('maturity_date');
            $table->tinyInteger('status');
            $table->boolean('is_synced')->default(0);
            $table->string('method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_investments');
    }
}
