<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('password')->nullable();
            $table->date('dob');
            $table->boolean('dob_verify')->default(0);
            $table->string('nic');
            $table->boolean('nic_verify')->default(0);
            $table->string('address_line_1');
            $table->boolean('address_line_1_verify')->default(0);
            $table->string('address_line_2');
            $table->boolean('address_line_2_verify')->default(0);
            $table->string('address_line_3')->nullable();
            $table->boolean('address_line_3_verify')->default(0);
            $table->string('correspondence_address_line_1')->nullable();
            $table->boolean('correspondence_address_line_1_verify')->default(0);
            $table->string('correspondence_address_line_2')->nullable();
            $table->boolean('correspondence_address_line_2_verify')->default(0);
            $table->string('correspondence_address_line_3')->nullable();
            $table->boolean('correspondence_address_line_3_verify')->default(0);
            $table->string('title');
            $table->boolean('title_verify')->default(0);
            $table->string('name');
            $table->boolean('name_verify')->default(0);
            $table->string('name_by_initials')->nullable();
            $table->boolean('name_by_initials_verify')->default(0);
            $table->string('telephone')->nullable();
            $table->boolean('telephone_verify')->default(0);
            $table->string('mobile');
            $table->boolean('mobile_verify')->default(0);
            $table->string('nationality');
            $table->boolean('nationality_verify')->default(0);
            $table->string('verification_from_GOV')->nullable();
            $table->boolean('verification_from_GOV_verify')->default(0);
            $table->string('money_laundering_verification')->nullable();
            $table->boolean('money_laundering_verification_verify')->default(0);
            $table->string('nic_front')->nullable();
            $table->boolean('nic_front_verify')->default(0);
            $table->string('nic_back')->nullable();
            $table->boolean('nic_back_verify')->default(0);
            $table->string('passport')->nullable();
            $table->boolean('passport_verify')->default(0);
            $table->string('signature')->nullable();
            $table->boolean('signature_verify')->default(0);
            $table->string('billing_proof')->nullable();
            $table->boolean('billing_proof_verify')->default(0);
            $table->string('pro_pic')->nullable();
            $table->boolean('pro_pic_verify')->default(0);
            $table->boolean('client_type')->default(0)->comment("1 =indivitual 2=join 3=institute");
            $table->boolean('client_type_verify')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('is_active')->default(0);
            $table->double('account_balance')->default(0);
            $table->integer('officer_id')->nullable();
            $table->boolean('kyc')->default(0);
            $table->boolean('is_residence')->default(1);
            $table->boolean('joint_permission')->default(0);
            $table->boolean('is_signatureB')->default(0);
            $table->boolean('verify_type')->default(0)->comment("0 = physical, 1= video conference");
            $table->string('verify_comment')->nullable();
            $table->boolean('is_first')->default(0);
            $table->boolean('is_ex')->default(0);
            $table->string('reference_email')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('clients');
    }
}
