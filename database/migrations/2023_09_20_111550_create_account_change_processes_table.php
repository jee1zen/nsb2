<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountChangeProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_change_processes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id');
            $table->integer('user_id');
            $table->tinyInteger('previous_state');
            $table->tinyInteger('current_state');
            $table->text('comment');
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
        Schema::dropIfExists('account_change_processes');
    }
}