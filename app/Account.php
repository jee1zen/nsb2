<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable =[
       'client_id','officer_id','type','verify_type','kyc','status','joint_permission','pre','verify_comment','reference_email'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function investments(){
        return $this->hasMany(Investment::class,'account_id');
    }

    public function kyc(){
        return $this->hasMany(KYCForm::class,'account_id');
    }

    public function hasKyc(){
        return (bool) $this->kyc()->first();
    }


    public function meetings(){
        return $this->hasMany(Meeting::class,'account_id');

    }
    public function hasMeetings(){
        return (bool)  $this->meetings()->first();
    }

    public function uploads(){
     return $this->hasMany(Upload::class,'account_id');
    }

    public function hasUploads(){
        return (bool) $this->uploads()->first();
    }

    public function process(){
        return $this->hasMany(Process::class,'account_id');
    }

    public function hasProcess(){
        return (bool) $this->process()->first();
    }

    public function jointHolders(){
        return $this->hasMany(JointHolder::class,'account_id');
    }
    public function hasJointHolders(){
        return (bool) $this->jointHolders()->first();
    }

    public function selectedAccount(){
        return $this->hasOne(SelectedAccount::class,'account_id','id');
    }



}