<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KYCCompanyForeignInvestor extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'name',
        'country',
        'percentage'
    ];


    public function kycCompany(){
      return $this->belongsTo(KYCCompany::class);
    }




}
