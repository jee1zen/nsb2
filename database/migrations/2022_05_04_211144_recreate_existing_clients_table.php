<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateExistingClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('existing_clients', function (Blueprint $table) {
            $table->id();
            $table->string('cus_id');
            $table->string('client_id')->nullable();
            $table->string('customer_name');
            $table->string('nic');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('address_line_3')->nullable();
            $table->string('email');
            $table->string('mobile');
            $table->tinyInteger('syched')->default(0);
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
        Schema::dropIfExists('existing_clients');
    }
}
