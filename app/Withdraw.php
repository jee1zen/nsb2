<?php

namespace App;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'investment_id', 'request_type', 'client_id', 'bank_id', 'amount', 'status', 'is_backend','created_at',
        'updated_at'
    ];
    public $table = 'withdraws';
    public function client()
    {
        return $this->belongsTo(Client::class)->withDefault();
    }

    public function withdrawProcesses()
    {

        return $this->hasMany(WithdrawProcess::class, 'withdraw_id');
    }
    public function bankAccount()
    {
        return $this->belongsTo(BankParticular::class,'bank_id','id')->withDefault();
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    public function  jointApprovals(){
        return $this->hasMany(JointWithrawApproval::class,'withdraw_id');
    }
    public function jointApproval($joint_holder_id){
        return $this->hasOne(JointWithdrawApproval::class,'withdraw_id')->where('joint_holder_id',$joint_holder_id)->first();
    }
    public function jointNotApproved($joint_holder_id){
        return  $this->jointApproval($joint_holder_id)->status;
    }

    public function tempInvestment(){
        return $this->belongsTo(TempInvestment::class,'investment_id');
    }
  
}
