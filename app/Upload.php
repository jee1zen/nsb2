<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;
    public $table = 'uploads';
    protected $fillable = [
        'id',
        'client_id',
        'account_id',
        'user_id',
        'title',
        'file_name',
        'created_at',
        'updated_at',
      
    ];

    public function users(){ 

        return $this->belongsTo(User::class,'user_id');

     }

}