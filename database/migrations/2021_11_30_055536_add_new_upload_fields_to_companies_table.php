<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewUploadFieldsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            
            $table->string('partners_kyc')->after('power_of_attorney_verify');
            $table->boolean('partners_kyc_verify')->default(0)->after('partners_kyc');
            $table->string('proprietors_kyc')->after('partners_kyc_verify');
            $table->boolean('proprietors_kyc_verify')->default(0)->after('proprietors_kyc');
            $table->string('certificate_of_registration')->after('proprietors_kyc_verify');
            $table->boolean('certificate_of_registration_verify')->default(0)->after('certificate_of_registration');
            $table->string('company_coi')->after('certificate_of_registration_verify');
            $table->boolean('company_coi_verify')->default(0)->after('company_coi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
}
