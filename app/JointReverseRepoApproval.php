<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JointReverseRepoApproval extends Model
{
    use HasFactory;
    protected $fillable = [
        'reverseRepo_id',
        'joint_holder_id',
        'status',
        'comment',
    ];

    public function jointHolder(){

        return $this->belongsTo(jointHolder::class);
    }

    public function reverseRepo(){

        return $this->belongsTo(ReverseRepo::class);
    }






}
