<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable =[
       'officer_id','type','verify_type','kyc','status','verify_comment','reference_email'
    ];
}