<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class AddNicImageFieldsToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
           $table->string('nic_front')->after('nationality')->nullable();
           $table->string('nic_back')->after('nic_front')->nullable();
           $table->string('passport')->after('nic_back')->nullable();
           $table->string('signature')->after('passport')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('nic_front');
            $table->dropColumn('nic_back');
            $table->dropColumn('passport');
            $table->dropColumn('signature');

        });
    }
}
