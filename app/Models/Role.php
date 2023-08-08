<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;
  public function assignRole($role)
  {
    return $this->roles()->sync($role, false);
  }

  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }

}
