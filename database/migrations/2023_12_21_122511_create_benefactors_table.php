<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefactors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->string('title');
            $table->string('title_verify')->default('0');
            $table->string('name');
            $table->boolean('name_verify')->default(0);
            $table->string('designation');
            $table->boolean('designation_verify')->default(0);
            $table->string('nic');
            $table->boolean('nic_verify')->default(0);
            $table->string('citizenship');
            $table->boolean('citizenship_verify')->default(0);
            $table->date('dob');
            $table->boolean('dob_verify')->default(0);
            $table->string('address_line_1');
            $table->string('address_line_1_verify')->default('0');
            $table->string('address_line_2');
            $table->string('address_line_2_verify')->default('0');
            $table->string('address_line_3');
            $table->string('address_line_3_verify')->default('0');
            $table->string('source_of_beneficial_ownership');
            $table->boolean('source_of_beneficial_ownership_verify')->default(0);
            $table->boolean('pep')->default(0);
            $table->boolean('pep_verify')->default(0);
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
        Schema::dropIfExists('benefactors');
    }
}
