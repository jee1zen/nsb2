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

    public function accountChange(){

        return $this->hasOne(AccountChange::class,'account_id');
    }

    public function clientChange(){

        return $this->hasOne(ClientChange::class,'account_id');
    }

    public function joinHolderChanges(){
        return $this->hasMany(JoinHolderChange::class,'account_id');
    }

    public function hasJoinHolderChanges(){
        return (bool) $this->joinHolderChanges()->first();
    }


    public function employmentChange(){

        return $this->hasOne(EmploymentDetailChange::class,'account_id');
    }

    public function bankParticularChanges(){

        return $this->hasMany(bankParticularChanges::class,'account_id');
    }

    public function hasBankParticularChanges(){

        return (bool) $this->bankParticularChanges()->first();
    }


    public function otheDetailChanges(){
        return $this->hasOne(OtherDetailChanges::class,'account_id');
    }
    public function notificationChange(){
        return $this->hasOne(NotificationChange::class,'account_id');
    }
    public function hasNotificationChange(){
        return (bool) $this->notificationChange()->first();
    }

    public function kycChange(){
        return $this->hasOne(kycChange::class,'account_id');
    }

    public function hasKycChange(){

        return (bool) $this->kycChange()->first();

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
        return $this->hasMany(Process::class);
    }

    public function hasProcess(){
        return (bool) $this->process()->first();
    }

    public function jointHolders(){
        return $this->belongsToMany(Client::class, 'account_joint_holders', 'account_id', 'client_id');
    }
    public function hasJointHolders(){
        return (bool) $this->jointHolders()->first();
    }
    public function bankParticulars(){
        return $this->hasMany(BankParticular::class,'account_id');

    }
    public function hasBankParticulars(){
        return (bool) $this->bankParticulars()->first();
    }

    public function selectedAccount(){
        return $this->hasOne(SelectedAccount::class,'account_id','id');
    }



}