<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJointHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joint_holders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->integer('client_id');
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('title');
            $table->boolean('name_verify')->default(0);
            $table->string('name_by_initials')->nullable();
            $table->boolean('name_by_initials_verify')->default(0);
            $table->string('dob');
            $table->boolean('dob_verify')->default(0);
            $table->string('nic');
            $table->boolean('nic_verify')->default(0);
            $table->string('nationality');
            $table->boolean('nationality_verify')->default(0);
            $table->string('email');
            $table->string('address_line_1');
            $table->boolean('address_line_1_verify')->default(0);
            $table->string('address_line_2');
            $table->boolean('address_line_2_verify')->default(0);
            $table->string('address_line_3')->nullable();
            $table->boolean('address_line_3_verify')->default(0);
            $table->string('correspondence_address_line_1');
            $table->boolean('correspondence_address_line_1_verify')->default(0);
            $table->string('correspondence_address_line_2');
            $table->boolean('correspondence_address_line_2_verify')->default(0);
            $table->string('correspondence_address_line_3')->nullable();
            $table->boolean('correspondence_address_line_3_verify')->default(0);
            $table->string('telephone')->nullable();
            $table->boolean('telephone_verify')->default(0);
            $table->string('mobile');
            $table->boolean('mobile_verify')->default(0);
            $table->string('nic_front')->nullable();
            $table->boolean('nic_front_verify')->default(0);
            $table->string('nic_back')->nullable();
            $table->boolean('nic_back_verify')->default(0);
            $table->string('passport')->nullable();
            $table->boolean('passport_verify')->default(0);
            $table->string('signature')->nullable();
            $table->boolean('signature_verify')->default(0);
            $table->string('pro_pic')->nullable();
            $table->boolean('pro_pic_verify')->default(0);
            $table->string('occupation')->nullable();
            $table->boolean('occupation_verify')->default(0);
            $table->string('company_name')->nullable();
            $table->boolean('company_name_verify')->default(0);
            $table->string('company_address')->nullable();
            $table->boolean('company_address_verify')->default(0);
            $table->string('company_telephone')->nullable();
            $table->boolean('company_telephone_verify')->default(0);
            $table->string('company_fax')->nullable();
            $table->boolean('company_fax_verify')->default(0);
            $table->string('company_nature')->nullable();
            $table->boolean('company_nature_verify')->default(0);
            $table->string('kyc_link');
            $table->timestamps();
            $table->dateTime('email_verified_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joint_holders');
    }
}
