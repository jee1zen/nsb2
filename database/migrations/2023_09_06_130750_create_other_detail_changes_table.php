<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherDetailChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_detail_changes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id');
            $table->tinyInteger('nsb_staff_fund_management');
            $table->tinyInteger('nsb_staff');
            $table->tinyInteger('related_nsb_staff');
            $table->string('staff_relationship', 255)->nullable();
            $table->tinyInteger('member_holding_company');
            $table->string('member_holding_company_state', 255)->nullable();
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
        Schema::dropIfExists('other_detail_changes');
    }
}