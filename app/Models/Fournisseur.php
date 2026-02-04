<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Fournisseur extends Model
{
  use HasFactory, SoftDeletes, Notifiable;

  protected $fillable = [
    'user_id',
    'nom',
    'adresse',
    'telephone',
    'phone_primary',
    'phone_secondary',
    'email',
    'email_primary',
    'email_secondary',
    'logo',
    'whatsapp_number',
    'website',
    'description',
    'status',
    'approved_at',
    'approved_by',
    'notification_preferences',
  ];

  protected $casts = [
    'approved_at' => 'datetime',
    'notification_preferences' => 'json',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    'deleted_at' => 'datetime',
  ];

  // Relations
  public function user()
  {
    return $this->belongsTo(\App\Models\User::class);
  }

  public function offers()
  {
    return $this->hasMany(\App\Models\PartnerOffer::class);
  }

  public function inquiries()
  {
    return $this->hasMany(\App\Models\Inquiry::class);
  }

  // Scopes
  public function scopeApproved($query)
  {
    return $query->where('status', 'active');
  }

  public function scopePending($query)
  {
    return $query->where('status', 'pending_approval');
  }

  public function scopeActive($query)
  {
    return $query->where('status', 'active');
  }

  // Accessors
  public function getDisplayNameAttribute()
  {
    return $this->nom;
  }

  public function isApproved()
  {
    return $this->status === 'active';
  }

  public function isPending()
  {
    return $this->status === 'pending_approval';
  }
}
