<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->bigInteger('officer_id')->nullable();
            $table->tinyInteger('title_state')->default(0);
            $table->tinyInteger('name_state')->default(0);
            $table->tinyInteger('address_state')->default(0);
            $table->tinyInteger('correspondence_address_state')->default(0);
            $table->tinyInteger('nic_state')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('name_proof_doc')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('address_line_3')->nullable();
            $table->string('correspondence_address_line_1')->nullable();
            $table->string('correspondence_address_line_2')->nullable();
            $table->string('correspondence_address_line_3')->nullable();
            $table->string('address_verify_doc')->nullable();
            $table->string('nic')->nullable();
            $table->string('nic_front')->nullable();
            $table->string('nic_back')->nullable();
            $table->string('passport')->nullable();
            $table->string('passport_image')->nullable();
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
        Schema::dropIfExists('change_requests');
    }
}
