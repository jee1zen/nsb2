<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreUploadColumsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {

            $table->string('declaration_of_beneficial_ownership')->nullable()->default('none')->after('company_coi_verify');
            $table->boolean('declaration_of_beneficial_ownership_verify')->default(0)->after('declaration_of_beneficial_ownership');

            $table->string('partner_deed')->nullable()->default('none')->after('declaration_of_beneficial_ownership_verify');
            $table->boolean('partner_deed_verify')->default(0)->after('partner_deed');

            $table->string('articles_of_association')->nullable()->default('none')->after('partner_deed_verify');
            $table->boolean('articles_of_associatio_verify')->default(0)->after('articles_of_association');

            $table->string('form01')->nullable()->default('none')->after('articles_of_associatio_verify');
            $table->boolean('form01_verify')->default(0)->after('form01');

            $table->string('form20')->nullable()->default('none')->after('form01_verify');
            $table->boolean('form20_verify')->default(0)->after('form20');

            $table->string('form44')->nullable()->default('none')->after('form20_verify');
            $table->boolean('form44_verify')->default(0)->after('form44');

            $table->string('form45')->nullable()->default('none')->after('form44_verify');
            $table->boolean('form45_verify')->default(0)->after('form45');

            $table->string('export_development')->nullable()->default('none')->after('form45_verify');
            $table->boolean('export_development_verify')->default(0)->after('export_development');

 
            $table->string('board_of_investment')->nullable()->default('none')->after('export_development_verify');
            $table->boolean('board_of_investment_verify')->default(0)->after('board_of_investment');

            $table->string('certificate_to_commerce')->nullable()->default('none')->after('board_of_investment_verify');
            $table->boolean('certificate_to_commerce_verify')->default(0)->after('certificate_to_commerce');

            $table->string('list_of_subsidiaries')->nullable()->default('none')->after('certificate_to_commerce_verify');
            $table->boolean('list_of_subsidiaries_verify')->default(0)->after('list_of_subsidiaries');

            $table->string('directors_kyc')->nullable()->default('none')->after('list_of_subsidiaries_verify');
            $table->boolean('directors_kyc_verify')->default(0)->after('directors_kyc');


            $table->string('registration_doc')->nullable()->default('none')->after('directors_kyc_verify');
            $table->boolean('registration_doc_verify')->default(0)->after('registration_doc');

            $table->string('constitution')->nullable()->default('none')->after('registration_doc_verify');
            $table->boolean('constitution_verify')->default(0)->after('constitution');

        

            $table->string('office_bearer_kyc')->nullable()->default('none')->after('constitution_verify');
            $table->boolean('office_bearer_kyc_verify')->default(0)->after('office_bearer_kyc');






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

            $table->dropColumn('declaration_of_beneficial_ownership');
            $table->dropColumn('declaration_of_beneficial_ownership_verify');

            $table->dropColumn('form01');
            $table->dropColumn('form01_verify');

            $table->dropColumn('form20');
            $table->dropColumn('form20_verify');

            $table->dropColumn('form44');
            $table->dropColumn('form44_verify');

            $table->dropColumn('form45');
            $table->dropColumn('form45_verify');

            $table->dropColumn('export_development');
            $table->dropColumn('export_development_verify');

            $table->dropColumn('board_of_investment');
            $table->dropColumn('board_of_investment_verify');

            $table->dropColumn('certificate_to_commerce');
            $table->dropColumn('certificate_to_commerce_verify');

            $table->dropColumn('list_of_subsidiaries');
            $table->dropColumn('list_of_subsidiaries_verify');

            $table->dropColumn('directors_kyc');
            $table->dropColumn('directors_kyc_verify');

            $table->dropColumn('registration_doc');
            $table->dropColumn('registration_doc_verify');

            $table->dropColumn('constitution');
            $table->dropColumn('constitution_verify');
            
            $table->dropColumn('office_bearer_kyc');
            $table->dropColumn('office_bearer_kyc_verify');


        });
    }
}
