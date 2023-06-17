<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JointWithdrawApproval extends Model
{
    use HasFactory;
    protected $fillable=[
        'withdraw_id',
        'joint_holder_id',
        'status',
        'comment',
    ];

    public function withdraw(){
        return $this->belongsTo(withdraw::class);
    }


    public function jointHolder(){
        return $this->belongsTo(JointHolder::class);
    }


    public function isApproved(){

        return (bool) $this->jointHolder()->where('status',1)->first();

    }

  



}
