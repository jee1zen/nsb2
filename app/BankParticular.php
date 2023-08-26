<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankParticular extends Model
{
    use HasFactory;
    public $table = 'bank_particulars';

    
    protected $dates = [
        'updated_at',
        'created_at',
      
      
    ];

    protected $fillable = [
        'id',
        'account_id',
        'client_id',
        'name',
        'bank_name',
        'branch',
        'Account_type',
        'account_no',
        'client_type',
        'created_at',
        'updated_at',
    ];


    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function withdraws(){
        return $this->hasMany(Withdraw::class,'bank_id');
    }

    public function investment(){
        return $this->hasMany(Investment::class,'bank_id','id');
    }
}