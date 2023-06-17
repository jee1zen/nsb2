<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExistingClientsTable extends Migration
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
            $table->string('address');
            $table->string('email');
            $table->string('mobile');
            $table->string('instrument');
            $table->string('ref_no');
            $table->date('value_date');
            $table->date('maturity_date');
            $table->double('invested_amount');
            $table->double('maturity_amount');
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
