<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_changes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id');
            $table->date('dob');
            $table->string('nic');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('address_line_3')->nullable();
            $table->string('correspondence_address_line_1')->nullable();
            $table->string('correspondence_address_line_2')->nullable();
            $table->string('correspondence_address_line_3')->nullable();
            $table->string('title');
            $table->string('name');
            $table->string('name_by_initials')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile');
            $table->string('nationality');
            $table->string('verification_from_GOV')->nullable();
            $table->string('money_laundering_verification')->nullable();
            $table->string('nic_front')->nullable();
            $table->string('nic_back')->nullable();
            $table->string('passport')->nullable();
            $table->string('signature')->nullable();
            $table->string('billing_proof')->nullable();
            $table->string('pro_pic')->nullable();
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
        Schema::dropIfExists('client_changes');
    }
}