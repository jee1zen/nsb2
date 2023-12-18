<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidProcess extends Model
{
    use HasFactory;
    protected $fillable=[
        'bid_id',
        'user_id',
        'client_id',
        'previous_state',
        'current_state',
        'comment',

    ];
}
