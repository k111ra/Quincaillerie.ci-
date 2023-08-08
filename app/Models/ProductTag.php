<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductTag extends Pivot
{
  protected $table = 'product_tags';

  protected $fillable = [
    'produit_id',
    'tag_id'
  ];

  public function produit()
  {
    return $this->belongsTo(Product::class, 'produit_id');
  }

  public function tag()
  {
    return $this->belongsTo(Tag::class, 'tag_id');
  }
}
