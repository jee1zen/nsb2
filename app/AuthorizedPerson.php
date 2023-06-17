<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  AuthorizedPerson extends Model
{
    use HasFactory;

    public $table = 'authorized_person';

    protected $dates = [
        'updated_at',
        'created_at',
       
    ];
    protected $fillable = [
        'id',
        'client_id',
        'name',
        'address',
        'nic',
        'telephone',
        'created_at',
        'updated_at',
       
    ];

    public function client(){
      return $this->belongsTo(Client::class);
    }


}
