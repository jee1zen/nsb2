<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJointBidApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joint_bid_approvals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bid_id');
            $table->bigInteger('joint_holder_id');
            $table->tinyInteger('status')->default(0)->comment('1=accepted, 0=pending,2=rejected');
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
        Schema::dropIfExists('joint_bid_approvals');
    }
}
