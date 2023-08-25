<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealTimeNotificationSetting extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'on_email',
        'email',
        'on_mobile',
        'mobile',

    ];

    public function client(){
        return $this->belongsTo(client::class,'id','id');
    }
}