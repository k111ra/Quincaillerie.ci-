<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;

  // Définir les colonnes qui peuvent être attribuées en masse
  protected $fillable = [
    'title',
    'details',
    'description',
    'image',
    'user_id'
  ];

  // Relation avec le modèle User
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Relation avec le modèle Tag (si vous avez un système de tags pour les posts)
  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }
}
