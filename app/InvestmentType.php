<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'created_at',
    'updated_at'];


    public function cilentRecords(){
        return $this->hasMany(ClientRecord::class,'type');
    }

    public function hasClientRecords(){
        return (bool) $this->cilentRecords()->first();
    }

    public function investments(){
        return $this->hasMany(Investment::class,'investment_type_id');
    }
    public function withdraws(){
        return $this->hasMany(Withdraw::class,'investment_type');
    }
    public function bids(){
        return $this->hasMany(Bid::class,'investment_id');
    }

    public function tempInvestments(){
        return $this->hasMany(InvestmentType::class,'investment_type_id');
    }


}
