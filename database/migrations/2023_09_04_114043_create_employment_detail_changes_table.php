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
            $table->string('occupation', 255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('company_name', 255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('company_address', 255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('telephone', 255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('fax', 255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('nature', 255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
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