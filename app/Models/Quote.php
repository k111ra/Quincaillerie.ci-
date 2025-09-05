<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
  protected $fillable = [
    'user_id',
    'status',
    'created_at',
    'updated_at'
  ];
}
