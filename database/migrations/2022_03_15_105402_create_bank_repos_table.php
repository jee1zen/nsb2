<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankReposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_repos', function (Blueprint $table) {
            $table->id();
            $table->string('cus_id')->nullable();
            $table->string('nic')->nullable();
            $table->string('cus_name')->nullable();
            $table->string('cus_id2')->nullable();
            $table->string('nic2')->nullable();
            $table->string('cus_name2')->nullable();
            $table->string('cus_id3')->nullable();
            $table->string('nic3')->nullable();
            $table->string('cus_name3')->nullable();
            $table->date('value_date')->nullable();
            $table->date('mat_date')->nullable();
            $table->string('deal_no')->nullable();
            $table->double('invested_value')->nullable();
            $table->double('interest')->nullable();
            $table->double('maturity_value')->nullable();
            $table->string('isin')->nullable();
            $table->double('face_value')->nullable();
            $table->double('market_value')->nullable();
            $table->date('maturity_date')->nullable();
            $table->double('haircut')->nullable();
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
        Schema::dropIfExists('bank_repos');
    }
}
