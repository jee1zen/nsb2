<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $filable = [
        'id',
        'client_id',
        'offcier_id',
        'title',
        'file_name',
        'created_at',
        'updated_at',
    ];



    public function client(){
        return $this->belongsTo(Client::class);
    }
}
