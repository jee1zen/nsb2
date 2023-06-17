<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettleReverseRepoProcess extends Model
{
    use HasFactory;

     protected $fillable=[
        'settle_reverse_repo_id',
        'user_id',
        'client_id',
        'previous_state',
        'current_state',
        'comment',
        'created_at',
        'updated_at',

     ];


    public function settleReverseRepo(){
        
        return $this->belongsTo(SettleReverseRepo::class);

    }


}
