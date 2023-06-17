<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaturalPerson extends Model
{
    use HasFactory;
    protected $fillable=[
        'client_id',
        'title',
        'title_verify',
        'name',
        'name_verify',
        'designation',
        'designation_verify',
        'mobile',
        'nic',
        'nic_verify',
        'signature',
        'signature_verify',


    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }


}
