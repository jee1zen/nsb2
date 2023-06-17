<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewInvestmentProcess extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'client_id',
        'previous_state',
        'current_state',
        'comment',
        'created_at',
        'updated_at',
      
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function users(){ 

        return $this->belongsTo(User::class,'user_id');

     }

}
