<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Action;

class NotificationChange extends Model
{
    use HasFactory;
    protected $fillable = [
        'on_email',
        'email',
        'on_mobile',
        'mobile',
        // You can add more fillable columns here if needed
    ];

    public function account(){
    return $this->belongsTo(Account::class);
    }
}