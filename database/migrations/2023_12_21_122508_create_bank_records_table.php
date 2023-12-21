<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('nic')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('cus_id1')->nullable();
            $table->string('cus_id2')->nullable();
            $table->string('cus_id3')->nullable();
            $table->string('investment_type')->nullable();
            $table->date('value_date')->nullable();
            $table->date('maturity_date')->nullable();
            $table->double('price')->nullable();
            $table->double('yield')->nullable();
            $table->double('coupon')->nullable();
            $table->double('face_value')->nullable();
            $table->double('invested_amount')->nullable();
            $table->string('stock_ref')->nullable();
            $table->string('method')->nullable();
            $table->string('ref_investment')->nullable();
            $table->string('email')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('address_line_3')->nullable();
            $table->string('address_line_4')->nullable();
            $table->date('trade_date')->nullable();
            $table->string('coupon_dates')->nullable();
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
        Schema::dropIfExists('bank_records');
    }
}
