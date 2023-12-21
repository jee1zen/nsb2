<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankParticularChanges extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'account_id',
        'name',
        'bank_name',
        'branch',
        'Account_type',
        'account_no',
        'passbook',
        'verified',
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }



}