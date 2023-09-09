<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinHolderChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_holder_changes', function (Blueprint $table) {
            $table->id();
            $table->string('password')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->integer('client_id');
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('title');
            $table->string('name_by_initials')->nullable();
            $table->string('dob');
            $table->string('nic');
            $table->string('nationality');
            $table->string('email');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('address_line_3')->nullable();
            $table->string('correspondence_address_line_1');
            $table->string('correspondence_address_line_2');
            $table->string('correspondence_address_line_3')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile');
            $table->string('nic_front')->nullable();
            $table->string('nic_back')->nullable();
            $table->string('passport')->nullable();
            $table->string('signature')->nullable();
            $table->string('pro_pic')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_telephone')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('company_nature')->nullable();
            $table->string('kyc_link');
            $table->datetime('email_verified_at')->nullable();
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
        Schema::dropIfExists('join_holder_changes');
    }
}