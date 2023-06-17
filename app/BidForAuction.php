<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidForAuction extends Model
{
    use HasFactory;
    protected $fillable=['id','doc1','doc2'];
}
