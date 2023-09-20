<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountChangeProcess extends Model
{
    use HasFactory;

    protected $fillable =[
        'account_id',
        'user_id',
        'previous_state',
        'current_state',
        'comment'

    ];
}