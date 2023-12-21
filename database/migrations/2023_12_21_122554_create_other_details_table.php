<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_details', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->tinyInteger('nsb_staff_fund_management');
            $table->boolean('nsb_staff_fund_management_verify')->default(0);
            $table->boolean('nsb_staff')->default(0);
            $table->boolean('nsb_staff_verify')->default(0);
            $table->boolean('related_nsb_staff')->default(0);
            $table->boolean('related_nsb_staff_verify')->default(0);
            $table->string('staff_relationship')->nullable();
            $table->boolean('staff_relationship_verify')->default(0);
            $table->boolean('member_holding_company')->default(0);
            $table->boolean('member_holding_company_verify')->default(0);
            $table->string('member_holding_company_state')->nullable();
            $table->boolean('member_holding_company_state_verify')->default(0);
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
        Schema::dropIfExists('other_details');
    }
}
