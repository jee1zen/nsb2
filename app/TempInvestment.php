<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempInvestment extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','ref_no','investment_id','client_record_id','invested_amount','matured_amount','investment_type_id','value_date','maturity_date','status',
    'method','created_at',
    'updated_at'];


    public function client(){
        return $this->belongsTo(Client::class);

    }

    public function investment(){
        return $this->belongsTo(Investment::class);
    }

    public function InvestmentType(){
        return $this->belongsTo(InvestmentType::class);
    }

    public function withdraws(){
        return $this->hasMany(Withdraw::class,'investment_id');
    }

    public function hasWithdraws(){
        return (bool) $this->withdraws()->first();
    }

    public function reverseRepo(){
        return $this->hasMany(ReverseRepo::class,'investment_id');
    }


    public function clientRecords(){
        return $this->belongsTo(ClientRecord::class,'client_record_id');
    }

 

}
