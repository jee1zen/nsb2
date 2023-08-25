<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentDetails extends Model
{
    use HasFactory;
    public $table = 'employment_details';
    protected $dates = [
        'updated_at',
        'created_at',
    ];


    public $fillable=[
        
        'id',
        'occupation',
        'company_name',
        'company_address',
        'telephone',
        'fax',
        'nature',
        'created_at',
        'updated_at'

    ];

    public function client(){
        $this->belongsTo(Client::class,'id','id');
    }
}