<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JointInvestmentApproval extends Model
{
    use HasFactory;

    protected $fillable=[
        'investment_id',
        'joint_holder_id',
        'status',
        'comment'

    ];

    public function investment(){
        return $this->belongsTo(Investment::class);
    }
}
