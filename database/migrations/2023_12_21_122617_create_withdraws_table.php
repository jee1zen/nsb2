<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('investment_id');
            $table->tinyInteger('request_type');
            $table->bigInteger('client_id');
            $table->integer('bank_id');
            $table->double('amount');
            $table->date('expected_date')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('is_backend')->default(0);
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
        Schema::dropIfExists('withdraws');
    }
}
