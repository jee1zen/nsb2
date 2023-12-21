<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankParticularChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_particular_changes', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->bigInteger('account_id')->nullable();
            $table->string('name');
            $table->string('bank_name')->default('N/A');
            $table->string('branch')->default('N/A');
            $table->string('Account_type');
            $table->string('account_no');
            $table->boolean('verified')->default(0);
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
        Schema::dropIfExists('bank_particular_changes');
    }
}
