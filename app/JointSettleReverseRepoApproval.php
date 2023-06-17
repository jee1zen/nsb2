<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JointSettleReverseRepoApproval extends Model
{
    use HasFactory;


    protected $fillable = [
        'settle_reverse_repo_id',
        'joint_holder_id',
        'status',
        'comment',
    ];

    public function jointHolder(){

        return $this->belongsTo(jointHolder::class);
    }

    public function settlereverseRepo(){

        return $this->belongsTo(SettleReverseRepo::class);
    }
}
