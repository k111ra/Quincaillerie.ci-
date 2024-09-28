<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
<<<<<<< HEAD

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles;
=======


class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles; // HasRoles doit être inclus ici
>>>>>>> 474bb2e0e73efcd2b602d3c650ec1cf46daf08fc

  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
}
