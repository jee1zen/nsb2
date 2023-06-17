<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBillProofToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('billing_proof')->after('signature_verify')->nullable();
            $table->boolean('billing_proof_verify')->after('billing_proof')->default(0);
            $table->string('pro_pic')->after('billing_proof_verify')->nullable();
            $table->boolean('pro_pic_verify')->after('pro_pic')->default(0);
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
             $table->dropColumn('billing_proof'); 
             $table->dropColumn('billing_proof_verify');
             $table->dropColumn('proc_pic');
             $table->dropColumn('pro_pic_verify');   

        });
    }
}
