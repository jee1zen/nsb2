<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExistingClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'cus_id',
        'client_id',
        'customer_name',
        'nic',
        'address_line_1',
        'address_line_2',
        'address_line_3',
         'email',
         'mobile',
         'synched',

    ];

    



}
