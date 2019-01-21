<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
  protected $fillable = [
    'name',
    'email',
    'address',
    'city',
    'state',
    'zip',
    'country',
    'by_email',
    'by_address',
  ];

  public function setByEmailAttribute($byEmail){

    $this->attributes['by_email'] = $byEmail ? $byEmail : 0;
  }

  public function setByAddressAttribute($byAddress){

    $this->attributes['by_address'] = $byAddress ? $byAddress : 0;
  }
  public function store($data){

    $this->create($data);
  }
}
