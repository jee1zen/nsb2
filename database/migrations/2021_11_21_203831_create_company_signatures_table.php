<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_signatures', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('name');
            $table->boolean('name_verify')->default(0);
            $table->string('dob');
            $table->boolean('dob_verify')->default(0);
            $table->string('nic');
            $table->boolean('nic_verify')->default(0);
            $table->string('nationality');
            $table->boolean('nationality_verify')->default(0);
            $table->string('email');
            $table->boolean('email_verify')->default(0);
            $table->string('address_line_1');
            $table->boolean('address_line_1_verify')->default(0);
            $table->string('address_line_2');
            $table->boolean('address_line_2_verify')->default(0);
            $table->string('address_line_3')->nullable();
            $table->boolean('address_line_3_verify')->default(0);
            $table->string('telephone');
            $table->boolean('telephone_verify')->default(0);
            $table->string('mobile');
            $table->boolean('mobile_verify')->default(0);
            $table->string('nic_front')->nullable();
            $table->boolean('nic_front_verify')->default(0);
            $table->string('nic_back')->nullable();
            $table->boolean('nic_back_verify')->default(0);
            $table->string('passport')->nullable();
            $table->boolean('passport_verify')->default(0);
            $table->string('signature');
            $table->boolean('signature_verify')->default(0);
            $table->char('type');  
            $table->boolean('type_verify')->default(0);
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
        Schema::dropIfExists('company_signatures');
    }
}
