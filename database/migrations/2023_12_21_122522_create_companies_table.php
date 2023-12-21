<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('company_type');
            $table->string('name');
            $table->boolean('name_verify')->default(0);
            $table->string('address_line_1');
            $table->boolean('address_line_1_verify')->default(0);
            $table->string('address_line_2');
            $table->boolean('address_line_2_verify')->default(0);
            $table->string('address_line_3')->nullable();
            $table->boolean('address_line_3_verify')->default(0);
            $table->string('business_registration_no');
            $table->boolean('business_registration_no_verify')->default(0);
            $table->string('nature_of_business');
            $table->boolean('nature_of_business_verify')->default(0);
            $table->string('telephone_1');
            $table->boolean('telephone_1_verify')->default(0);
            $table->string('telephone_2')->nullable();
            $table->boolean('telephone_2_verify')->default(0);
            $table->string('telephone_3')->nullable();
            $table->boolean('telephone_3_verify')->default(0);
            $table->string('email_1');
            $table->boolean('email_1_verify')->default(0);
            $table->string('email_2')->nullable();
            $table->boolean('email_2_verify')->default(0);
            $table->string('email_3')->nullable();
            $table->boolean('email_3_verify')->default(0);
            $table->string('fax_1')->nullable();
            $table->boolean('fax_1_verify')->default(0);
            $table->string('fax_2')->nullable();
            $table->boolean('fax_2_verify')->default(0);
            $table->string('fax_3')->nullable();
            $table->boolean('fax_3_verify')->default(0);
            $table->string('business_registraton');
            $table->boolean('business_registraton_verify')->default(0);
            $table->string('business_act');
            $table->boolean('business_act_verify')->default(0);
            $table->string('trust_deed');
            $table->boolean('trust_deed_verify')->default(0);
            $table->string('board_resolution');
            $table->boolean('board_resolution_verify')->default(0);
            $table->string('society_constitution');
            $table->boolean('society_constitution_verify')->default(0);
            $table->string('power_of_attorney');
            $table->boolean('power_of_attorney_verify')->default(0);
            $table->string('partners_kyc');
            $table->boolean('partners_kyc_verify')->default(0);
            $table->string('proprietors_kyc');
            $table->boolean('proprietors_kyc_verify')->default(0);
            $table->string('certificate_of_registration');
            $table->boolean('certificate_of_registration_verify')->default(0);
            $table->string('company_coi');
            $table->boolean('company_coi_verify')->default(0);
            $table->string('declaration_of_beneficial_ownership')->default('none');
            $table->boolean('declaration_of_beneficial_ownership_verify')->default(0);
            $table->string('partner_deed')->default('none');
            $table->boolean('partner_deed_verify')->default(0);
            $table->string('articles_of_association')->default('none');
            $table->boolean('articles_of_associatio_verify')->default(0);
            $table->string('form01')->default('none');
            $table->boolean('form01_verify')->default(0);
            $table->string('form20')->default('none');
            $table->boolean('form20_verify')->default(0);
            $table->string('form44')->default('none');
            $table->boolean('form44_verify')->default(0);
            $table->string('form45')->default('none');
            $table->boolean('form45_verify')->default(0);
            $table->string('export_development')->default('none');
            $table->boolean('export_development_verify')->default(0);
            $table->string('board_of_investment')->default('none');
            $table->boolean('board_of_investment_verify')->default(0);
            $table->string('certificate_to_commerce')->default('none');
            $table->boolean('certificate_to_commerce_verify')->default(0);
            $table->string('list_of_subsidiaries')->default('none');
            $table->boolean('list_of_subsidiaries_verify')->default(0);
            $table->string('directors_kyc')->default('none');
            $table->boolean('directors_kyc_verify')->default(0);
            $table->string('registration_doc')->default('none');
            $table->boolean('registration_doc_verify')->default(0);
            $table->string('constitution')->default('none');
            $table->boolean('constitution_verify')->default(0);
            $table->string('office_bearer_kyc')->default('none');
            $table->boolean('office_bearer_kyc_verify')->default(0);
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
        Schema::dropIfExists('companies');
    }
}
