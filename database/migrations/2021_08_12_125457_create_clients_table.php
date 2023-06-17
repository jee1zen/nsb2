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

            $table->unsignedInteger('user_id');
            $table->dateTime('dob');
            $table->string('nic');
            $table->string('residence_address');
            $table->string('title');
            $table->string('name');
            $table->string('nationality');
            $table->tinyInteger('client_type')->comment('1 =indivitual 2=join 3=institute');
            $table->timestamps();
            $table->softDeletes();
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
