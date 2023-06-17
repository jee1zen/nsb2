<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettleReverseRepo extends Model
{
    use HasFactory;
    protected $fillable=[
        'reverse_repo_id',
        'client_id',
        'instruction',
        'amount',
        'maturity_date',
        'status',
    ];

    public function reverseRepo(){

     return $this->belongsTo(ReverseRepo::class);

    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function process(){
        return $this->hasMany(SettleReverseRepoProcess::class,'settle_reverse_repo_id');
    }
    public function jointReverseRepoApproval($joint_holder_id){
        return $this->hasOne(JointSettleReverseRepoApproval::class,'settle_reverse_repo_id')->where('joint_holder_id',$joint_holder_id)->first();

    }
    public function jointNotApproved($joint_holder_id){

        return  $this->jointReverseRepoApproval($joint_holder_id)->status;

    }


}
