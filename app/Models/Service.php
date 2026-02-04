<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'slug',
    'categories_id',
    'user_id',
    'status',
    'approved_at',
    'approved_by',
  ];

  protected $casts = [
    'approved_at' => 'datetime',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class, 'categories_id');
  }

  public function images()
  {
    return $this->hasMany(Image::class);
  }

  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }
}
