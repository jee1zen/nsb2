<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JointBidApproval extends Model
{
    use HasFactory;
    protected $fillable=[
        'bid_id',
        'joint_holder_id',
        'status',
        'comment',
    ];

    public function bid(){
        return $this->belongsTo(Bid::class,'bid_id');
    }

}
