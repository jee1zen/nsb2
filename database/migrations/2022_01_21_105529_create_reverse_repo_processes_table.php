<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReverseRepoProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reverse_repo_processes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reverseRepo_id');
            $table->bigInteger('user_id');
            $table->bigInteger('client_id');
            $table->tinyInteger('previous_state');
            $table->tinyInteger('current_state');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('reverse_repo_processes');
    }
}
