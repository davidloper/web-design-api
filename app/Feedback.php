<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{ 

  protected $table = 'feedbacks';
  
  protected $fillable = [
    'name',
    'email',
    'message',
  ];

  public function store($data)
  {
    $this->create($data);
  }
}
