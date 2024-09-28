<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model // Renommé de Role à CustomRole
{
  use HasFactory;

  public function assignRole($role)
  {
    return $this->roles()->sync($role, false);
  }

  public function roles()
  {
    return $this->belongsToMany(UserRole::class); // Assurez-vous de pointer vers la bonne classe
  }
}
