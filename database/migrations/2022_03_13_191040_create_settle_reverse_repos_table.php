<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettleReverseReposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settle_reverse_repos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reverse_repo_id');
            $table->bigInteger('client_id');
            $table->integer('instruction');
            $table->double('amount')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('settle_reverse_repos');
    }
}
