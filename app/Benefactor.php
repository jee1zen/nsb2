<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefactor extends Model
{
    use HasFactory;
    protected $fillable=[
        'client_id',
        'title',
        'title_verify',
        'name',
        'name_verify',
        'designation',
        'designation_verify',
        'nic',
        'nic_verify',
        'citizenship',
        'citizenship_verify',
        'dob',
        'dob_verify',
        'address_line_1',
        'address_line_1_verify',
        'address_line_2',
        'address_line_2_verify',
        'address_line_3',
        'source_of_beneficial_ownership',
        'source_of_beneficial_ownership_verify',
        'pep',
        'pep_verify'

    ];

  public function  client(){
      return $this->belongsTo(Client::class);
  }


}
