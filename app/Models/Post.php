<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'slug', 'details', 'description', 'image', 'user_id'];

  public static function boot()
  {
    parent::boot();

    static::creating(function ($post) {
      $post->slug = self::createSlug($post->title);
    });

    static::updating(function ($post) {
      if ($post->isDirty('title')) {
        $post->slug = self::createSlug($post->title);
      }
    });
  }

  private static function createSlug($title)
  {
    $slug = Str::slug($title);
    $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
    return $count ? "{$slug}-{$count}" : $slug;
  }

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
