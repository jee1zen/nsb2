<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentDetailChange extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'occupation',
        'company_name',
        'company_address',
        'telephone',
        'fax',
        'nature',
    ];

    public function account(){
        return $this->belongsTo(Account::class,'account_id');
        
    }
}