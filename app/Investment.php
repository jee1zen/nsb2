<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','account_id','ref_no','invested_amount','investment_type_id','value_date','maturity_date','amount','status','kyc',
    'is_main','method','instruction','ref_investment','bank_id','created_at',
    'updated_at'];

    public function client(){
        return $this->belongsTo(Client::class);

    }

    public function account(){
      return $this->belongsTo(Account::class);
    }
    public function InvestmentType(){
        return $this->belongsTo(InvestmentType::class);
    }

    public function withdraw(){
        return $this->hasMany(Withdraw::class,'investment_id');
    }

    public function hasWithdraws(){
        return (bool) $this->withdraw()->first();
    }

    public function reverseRepo(){
        return $this->hasMany(ReverseRepo::class,'investment_id');
    }

    public function jointInvestmentApproval($joint_holder_id){

        return $this->hasOne(JointInvestmentApproval::class,'investment_id')->where('joint_holder_id',$joint_holder_id)->first();

    }
    
    public function jointNotApproved($joint_holder_id){

        return $this->jointInvestmentApproval($joint_holder_id)->status;

    }


    public function tempInvestment(){
        return $this->hasMany(TempInvestment::class,'investment_id');
    }

  public function clientRepos(){
      return $this->hasMany(ClientRepo::class,'deal_no','deal_no');
  }

  public function repoInvestmentAmount(){

    return $this->clientRepos->sum('invested_value');
    
  }

  public function kyc(){
    return $this->hasMany(KYCForm::class,'investment_id');
  }

  public function hasKyc(){
    return (bool) $this->kyc()->first();
  }

  public function bank(){
    return $this->belongsTo(BankParticular::class);
  }

  
  
}