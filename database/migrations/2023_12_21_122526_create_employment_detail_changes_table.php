<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentDetailChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_detail_changes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id');
            $table->string('occupation');
            $table->string('company_name');
            $table->string('company_address');
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            $table->string('nature');
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
        Schema::dropIfExists('employment_detail_changes');
    }
}
