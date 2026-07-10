<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_request_id',
        'product_name_raw',
        'quantity',
        'unit',
        'product_id',
        'fournisseur_id',
        'supplier_product_id',
        'purchase_price',
        'selling_price',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'float',
        'purchase_price' => 'float',
        'selling_price' => 'float',
    ];

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function supplierProduct()
    {
        return $this->belongsTo(SupplierProduct::class);
    }

    public function lineTotal(): float
    {
        return (float) $this->selling_price * (float) $this->quantity;
    }
}
