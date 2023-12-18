<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmptyEmail extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'ref',
        'cus_id',
        'name',

    ];


}