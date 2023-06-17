<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNaturalPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('natural_people', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->string('title');
            $table->boolean('title_verify')->default(0);
            $table->string('name');
            $table->boolean('name_verify')->default(0);
            $table->string('designation');
            $table->boolean('designation_verify')->default(0);
            $table->string('mobile');
            $table->string('nic');
            $table->boolean('nic_verify')->default(0);
            $table->string('signature');
            $table->boolean('signature_verify')->default(0);
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
        Schema::dropIfExists('natural_people');
    }
}
