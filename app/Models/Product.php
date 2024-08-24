<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
  use HasFactory;

  protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->nom);
        });
    }

  protected $fillable = ['nom', 'description', 'prix', 'image'];

  // Dans le modèle 'Product'
  public function category()
  {
    return $this->belongsTo(Category::class, 'categorie_id');
  }




  public function tags()
  {
    return $this->belongsToMany(Tag::class, 'product_tags');
  }


}
