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
            $table->boolean('type')->default(1);
            $table->boolean('verify_type')->default(0);
            $table->boolean('kyc')->default(0);
            $table->boolean('joint_permission')->default(0);
            $table->boolean('pre')->default(0);
            $table->boolean('status')->default(0);
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
