<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReverseRepo extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'investment_id',
        'client_id',
        'amount',
        'maturity_date',
        'status',

    ];


    public function client(){
        return  $this->belongsTo(Client::class);
    }
    public function investment(){
        return $this->belongsTo(Investment::class);
    }
    public function jointReverseRepoApprovals(){

        return $this->hasMany(JointReverseRepoApproval::class, 'reverseRepo_id');
    }

    public function jointReverseRepoApproval($joint_holder_id){
        return $this->hasOne(jointReverseRepoApproval::class,'reverseRepo_id')->where('joint_holder_id',$joint_holder_id)->first();

    }

    public function jointNotApproved($joint_holder_id){

        return  $this->jointReverseRepoApproval($joint_holder_id)->status;

    }
    public function settleReverseRepos(){
        return $this->hasMany(SettleReverseRepo::class,'reverse_repo_id');

    }

    
}
