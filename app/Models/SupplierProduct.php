<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'fournisseur_id',
        'product_id',
        'product_name',
        'purchase_price',
        'unit',
        'purchase_link',
        'notes',
        'price_updated_at',
    ];

    protected $casts = [
        'purchase_price' => 'float',
        'price_updated_at' => 'datetime',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
