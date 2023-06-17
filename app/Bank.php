<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
   protected $fillable=[
        'name'
    ];

    public function Branches(){
        return $this->hasMany(Branch::class,'bank_id');
    }
    public function hasBranches(){
        return (bool)  $this->Branches()->first();
    }
}
