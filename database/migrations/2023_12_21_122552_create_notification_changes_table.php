<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_changes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id');
            $table->boolean('on_email')->default(0);
            $table->string('email')->nullable();
            $table->boolean('on_mobile')->default(0);
            $table->string('mobile')->nullable();
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
        Schema::dropIfExists('notification_changes');
    }
}
