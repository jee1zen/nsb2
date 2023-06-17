<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeRequest extends Model
{
    use HasFactory;
    protected $fillable=[
        'client_id',
        'officer_id',
        'title',
        'name_state',
        'address_state',
        'correspondence_address_state',
        'nic_state',
        'status',
        'title',
        'name',
        'name_proof_doc',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'correspondence_address_line_1',
        'correspondence_address_line_2',
        'correspondence_address_line_3',
        'nic',
        'passport',
        'nic_front',
        'nic_back',
        'passport_image',
    ];


    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function officer(){
        return $this->belongsTo(User::class);
    }
}
