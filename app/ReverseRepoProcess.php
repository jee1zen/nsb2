<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReverseRepoProcess extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'reverseRepo_id',
        'user_id',
        'client_id',
        'previous_state',
        'current_state',
        'comment',
        'created_at',
        'updated_at',
    ];
}
