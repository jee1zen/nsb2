<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    public $table = 'meetings';
    protected $fillable = [
        
        'id',
        'client_id',
        'officer_id',
        'account_id',
        'date',
        'time',
        'link',
        'description',
        'status',
        'video',
        'created_at',
        'updated_at'


      
    ];

    public function client(){ 

        return $this->belongsTo(Client::class);

     }
}