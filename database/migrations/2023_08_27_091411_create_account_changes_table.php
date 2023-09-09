<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_changes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id');
            $table->bigInteger('client_id');
            $table->bigInteger('officer_id')->nullable();
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('verify_type')->default(0);
            $table->tinyInteger('kyc')->default(0);
            $table->tinyInteger('joint_permission')->default(0);
            $table->tinyInteger('pre')->default(0);
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
        Schema::dropIfExists('account_changes');
    }
}