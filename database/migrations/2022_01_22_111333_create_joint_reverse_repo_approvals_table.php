<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJointReverseRepoApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joint_reverse_repo_approvals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reverseRepo_id'); 
            $table->bigInteger('joint_holder_id');
            $table->tinyInteger('status')->default(0)->comment('0=pending,1=Approved,2=rejected');
            $table->string('comment')->nullable();  
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
        Schema::dropIfExists('joint_reverse_repo_approvals');
    }
}
