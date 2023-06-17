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
            $table->string('ref_no')->nullable();
            $table->string('cid')->nullable();
            $table->string('letter_name')->nullable();
            $table->string('investment_typ')->nullable();
            $table->date('val_date')->nullable();
            $table->date('mat_date')->nullable();
            $table->double('yeid')->nullable();
            $table->double('face_val')->nullable();
            $table->double('invested_amount')->nullable();
            $table->string('stk_ref')->nullable();
            $table->string('pay_method')->nullable();
            

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
