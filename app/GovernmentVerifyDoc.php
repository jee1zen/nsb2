<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentVerifyDoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'officer_id',
        'client_id',
        'title',
        'file_name',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function officer(){
        return $this->belongsTo(User::class);
    }
}
