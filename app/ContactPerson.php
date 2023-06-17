<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasFactory;
    protected $fillable =[
        'client_id',
        'name',
        'designation',
        'contact_no',
        'email',
    ];

    public function client(){
        return $this->belongsTo(Client::class);

    }
    
}
