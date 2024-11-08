<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'slug',
  ];
  public function products()
  {
    return $this->belongsToMany(Product::class, 'product_tag');
  }
  public function services()
  {
    return $this->belongsToMany(Service::class, 'service_tag');
  }
  public function posts()
  {
    return $this->belongsToMany(Post::class);
  }
}
