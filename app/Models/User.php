<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles;

  protected $fillable = [
    'name',
    'email',
    'password',
    'tel',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  // Relations utilisateur
  public function cartItems()
  {
    return $this->hasMany(\App\Models\CartItem::class);
  }

  public function favorites()
  {
    return $this->hasMany(\App\Models\Favorite::class);
  }

  public function orders()
  {
    return $this->hasMany(\App\Models\Order::class);
  }

  public function quotes()
  {
    return $this->hasMany(\App\Models\Quote::class);
  }
}
