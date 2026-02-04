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
    'user_type',
    'fournisseur_id',
    'is_verified',
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

  // Relations partenaire
  public function partner()
  {
    return $this->belongsTo(\App\Models\Fournisseur::class, 'fournisseur_id');
  }

  // Vérifier si l'utilisateur est partenaire
  public function isPartner()
  {
    return $this->user_type === 'partner' || $this->hasRole('partner');
  }
}
