<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('officer_id')->nullable();
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('verify_type')->default(0);
            $table->tinyInteger('kyc')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('verify_comment')->nullable();
            $table->string('reference_email')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}