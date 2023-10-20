<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertNewRoleIntoRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            DB::table('roles')->insert([
                'title' => 'PreUser'
            ]);
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            DB::table('roles')->where('title', 'PreUser')->delete();
        });
    }

}