<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable=[
        'bidset_id',
        'investment_id',
        'client_id',
        'amount',
        'rate',
        'auction_date',
        'value_date',
        'maturity_date',

    ];


    public function client(){

        return $this->belongsTo(Client::class);
    
    }

    public function bidSet(){
        return $this->belongsTo(BidSet::class,'bidset_id');
    }

    public function investmentType(){
        return $this->belongsTo(InvestmentType::class,'investment_id');
    }

    public function investment(){
        return $this->belongsTo(Investment::class);
    }

    public function jointBidApprovals(){
        return  $this->hasMany(JointBidApproval::class);
    }

    public function jointBidApproval($joint_holder_id){

        return $this->hasOne(JointBidApproval::class,'bid_id')->where('joint_holder_id',$joint_holder_id)->first();

    }
    
    public function jointNotApproved($joint_holder_id){

        return $this->jointBidApproval($joint_holder_id)->status;

    }


}