<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmpFieldsToJointHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('joint_holders', function (Blueprint $table) {

            $table->string('occupation')->nullable()->after('signature_verify');
            $table->boolean('occupation_verify')->default(0)->after('occupation');
            $table->string('company_name')->nullable()->after('occupation_verify');
            $table->boolean('company_name_verify')->default(0)->after('company_name');
            $table->string('company_address')->nullable()->after('company_name_verify');
            $table->boolean('company_address_verify')->default(0)->after('company_address');
            $table->string('company_telephone')->nullable()->after('company_address_verify');
            $table->boolean('company_telephone_verify')->default(0)->after('company_telephone');
            $table->string('company_fax')->nullable()->after('company_telephone_verify');
            $table->boolean('company_fax_verify')->default(0)->after('company_fax');
            $table->string('company_nature')->nullable()->after('company_fax_verify');
            $table->boolean('company_nature_verify')->default(0)->after('company_nature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('joint_holders', function (Blueprint $table) {
              
            $table->dropColumn('occupation');
            $table->dropColumn('occupation_verify');
            $table->dropColumn('company_name');
            $table->dropColumn('company_name_verify');
            $table->dropColumn('company_address');
            $table->dropColumn('company_address_verify');
            $table->dropColumn('company_telephone');
            $table->dropColumn('company_telephone_verify');
            $table->dropColumn('company_fax');
            $table->dropColumn('company_fax_verify');
            $table->dropColumn('company_nature');
            $table->dropColumn('company_nature_verify');

        });
    }
}
