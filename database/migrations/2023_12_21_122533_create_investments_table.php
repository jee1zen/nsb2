<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->bigInteger('client_id');
            $table->bigInteger('investment_type_id');
            $table->double('amount');
            $table->double('yield')->nullable();
            $table->double('invested_amount')->default(0);
            $table->date('value_date')->nullable();
            $table->double('matured_amount')->nullable();
            $table->date('maturity_date')->nullable();
            $table->boolean('status')->default(0)->comment("0= not active, 1= active, 2=rejected");
            $table->boolean('kyc')->default(0);
            $table->boolean('is_main')->default(0);
            $table->string('method')->nullable();
            $table->string('instruction')->nullable();
            $table->bigInteger('bank_id')->nullable();
            $table->string('ref_investment')->nullable();
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
        Schema::dropIfExists('investments');
    }
}
