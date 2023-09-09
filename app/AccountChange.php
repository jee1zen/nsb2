<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountChange extends Model
{
    use HasFactory;
    protected $fillable =[
       'account_id' ,'client_id','officer_id','type','verify_type','kyc','status','joint_permission','pre','verify_comment','pre','reference_email'
     ];

     public function account(){
        return $this->belongsTo(Account::class);

     }




}