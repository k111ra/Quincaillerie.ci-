<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;

  protected $fillable = ['user_id', 'shipping_address', 'shipping_method', 'total_amount', 'status'];

  // Constantes pour les statuts
  const STATUS_PENDING = 'pending';
  const STATUS_SHIPPED = 'shipped';
  const STATUS_DELIVERED = 'delivered';
  const STATUS_CANCELLED = 'cancelled';

  // Relation avec OrderItem
  public function items()
  {
    return $this->hasMany(OrderItem::class);
  }

  // Relation avec User
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Scope pour filtrer par statut
  public function scopeByStatus($query, $status)
  {
    return $query->where('status', $status);
  }

  // Méthode pour marquer la commande comme expédiée
  public function markAsShipped()
  {
    $this->status = self::STATUS_SHIPPED;
    $this->save();
  }
}
