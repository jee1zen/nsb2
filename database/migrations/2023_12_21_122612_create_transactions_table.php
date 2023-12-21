<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->unsignedInteger('asset_id')->index('asset_fk_1230972');
            $table->unsignedInteger('team_id')->nullable()->index('team_fk_1230977');
            $table->unsignedInteger('user_id')->index('user_fk_1233734');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
