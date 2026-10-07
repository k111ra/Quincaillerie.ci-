<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SponsoringCampaign extends Model
{
    protected $fillable = [
        'reference',
        'plan_code',
        'plan_name',
        'user_id',
        'partner_phone',
        'amount',
        'duration_days',
        'status',
        'starts_at',
        'expires_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'sponsoring_campaign_products')
            ->withTimestamps();
    }

    public function productSponsorings(): HasMany
    {
        return $this->hasMany(ProductSponsoring::class, 'campaign_id');
    }
}
