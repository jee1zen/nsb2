<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKycLinkFieldToAccountJointHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_joint_holders', function (Blueprint $table) {
            $table->text('kyc_link')->nullable()->after('client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_joint_holders', function (Blueprint $table) {
            $table->dropColumn('kyc_link');
        });
    }
}