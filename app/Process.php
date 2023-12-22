<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;
    public $table = 'process';
    protected $fillable = [
        'id',
        'user_id',
        'client_id',
        'account_id',
        'previous_state',
        'current_state',
        'comment',
        'created_at',
        'updated_at',
      
    ];

    public function users(){ 

        return $this->belongsTo(User::class,'user_id');

     }

     public function client(){
         return $this->belongsTo(Client::class,'client_id');
     }

     public function account(){
        return $this->belongsTo(Account::class,'account_id');
     }

   
}