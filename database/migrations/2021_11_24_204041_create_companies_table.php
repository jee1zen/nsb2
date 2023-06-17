<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('name');
            $table->boolean('name_verify')->default(0);
            $table->string('address_line_1');
            $table->boolean('address_line_1_verify')->default(0);
            $table->string('address_line_2');
            $table->boolean('address_line_2_verify')->default(0);
            $table->string('address_line_3')->nullable();
            $table->boolean('address_line_3_verify')->default(0);
            $table->string('business_registration_no');
            $table->boolean('business_registration_no_verify')->default(0);
            $table->string('nature_of_business');
            $table->boolean('nature_of_business_verify')->default(0);
            $table->string('telephone_1');
            $table->boolean('telephone_1_verify')->default(0);
            $table->string('telephone_2')->nullable();
            $table->boolean('telephone_2_verify')->default(0);
            $table->string('telephone_3')->nullable();
            $table->boolean('telephone_3_verify')->default(0);
            $table->string('email_1');
            $table->boolean('email_1_verify')->default(0);
            $table->string('email_2')->nullable();
            $table->boolean('email_2_verify')->default(0);
            $table->string('email_3')->nullable();
            $table->boolean('email_3_verify')->default(0);
            $table->string('fax_1')->nullable();
            $table->boolean('fax_1_verify')->default(0);
            $table->string('fax_2')->nullable();
            $table->boolean('fax_2_verify')->default(0);
            $table->string('fax_3')->nullable();
            $table->boolean('fax_3_verify')->default(0);
            $table->string('business_registraton');
            $table->boolean('business_registraton_verify')->default(0);
            $table->string('business_act');
            $table->boolean('business_act_verify')->default(0);
            $table->string('trust_deed');
            $table->boolean('trust_deed_verify')->default(0);
            $table->string('board_resolution');
            $table->boolean('board_resolution_verify')->default(0);
            $table->string('society_constitution');
            $table->boolean('society_constitution_verify')->default(0);
            $table->string('power_of_attorney');
            $table->boolean('power_of_attorney_verify')->default(0);
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
        Schema::dropIfExists('companies');
    }
}
