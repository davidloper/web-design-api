<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthSession extends Model
{
  protected $fillable = [
    'user_id',
    'token',
    'created_at',
    'expires_at',
  ];

  protected $casts = [
    'expires_at' => 'date',
  ];

  public $timestamps = false;
  
}
