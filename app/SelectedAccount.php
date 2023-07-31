<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedAccount extends Model
{
    use HasFactory;
    protected $fillable=['client_id','account_id'];
    public function account(){
        return $this->belongsTo(Account::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
}