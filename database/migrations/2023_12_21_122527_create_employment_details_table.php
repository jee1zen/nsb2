<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_details', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('occupation');
            $table->boolean('occupation_verify')->default(0);
            $table->string('company_name');
            $table->boolean('company_name_verify')->default(0);
            $table->string('company_address');
            $table->boolean('company_address_verify')->default(0);
            $table->string('telephone')->nullable();
            $table->boolean('telephone_verify')->default(0);
            $table->string('fax')->nullable();
            $table->boolean('fax_verify')->default(0);
            $table->string('nature');
            $table->boolean('nature_verify')->default(0);
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
        Schema::dropIfExists('employment_details');
    }
}
