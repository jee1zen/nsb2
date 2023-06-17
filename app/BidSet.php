<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidSet extends Model
{
    use HasFactory;
    protected $fillable =['client_id','comment','status'];

    public function bids(){
        return $this->hasMany(Bid::class,'bidset_id');
    }
    public function client(){

        return $this->belongsTo(Client::class);
    }

}
