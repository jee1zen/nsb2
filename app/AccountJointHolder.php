<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountJointHolder extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'client_id',
    ];

 


}