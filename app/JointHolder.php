<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JointHolder extends Model
{
    use HasFactory,SoftDeletes;

    public $table = 'joint_holders';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'id',
        'password',
        'client_id',
        'user_id',
        'name',
        'title',
        'nic',
        'dob',
        'email',
        'name_by_initials',
        'name_by_initials_verify',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'correspondence_address_line_1',
        'correspondence_address_line_2',
        'correspondence_address_line_3',
        'nationality',
        'telephone',
        'mobile',
        'nic_front',
        'nic_back',
        'passport',
        'signature',
        'pro_pic',
        'pro_pic_verify',
        'occupation',
        'company_name',
        'company_address',
        'company_telephone',
        'company_fax',
        'company_nature',
        'kyc_link',
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }


    public function kyc(){
        return $this->hasMany(KYCJointForm::class,'joint_id');
    }

    public function hasKyc(){
        return (boolean) $this->kyc()->first();
    }

    public function hasKycWithType($investment_type_id){
        return  (boolean) $this->kyc()->where('investment_type','=',$investment_type_id)->first();
    }

    public function kycWithType($investment_type_id){

        return  $this->kyc()->where('investment_type','=',$investment_type_id)->first();


    }

    public function kycByInvestmentId($investment_id){
        return $this->kyc()->where('investment_id',$investment_id)->first();

    }
    public function hasKycByInvestmentId($investment_id){
        return (bool) $this->kyc()->where('investment_id',$investment_id)->first();

    }

    public function withdrawApprovals(){
        return $this->hasMany(JointWithdrawApproval::class,'joint_holder_id');
    }

    public function reverseRepoApprovals(){
        return $this->hasMany(JointReverseRepoApproval::class,'joint_holder_id');
    }

    public function settleReverseRepoApprovals(){
        return $this->hasMany(JointReverseRepoApproval::class,'joint_holder_id');
    }




}
