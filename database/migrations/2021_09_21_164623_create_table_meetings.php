<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMeetings extends Migration
{
    /**
     * Run the migrations.
     *`
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('client_id');
            $table->integer('officer_id');
            $table->date('date');
            $table->time('time');
            $table->text('link');
            $table->text('description');
            $table->tinyInteger('status');
            $table->text('video');
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
        Schema::dropIfExists('meetings');
    }
}
