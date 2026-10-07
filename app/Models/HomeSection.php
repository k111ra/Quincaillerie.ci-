<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HomeSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'source_id',
        'display',
        'limit',
        'position',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Sections actives, dans l'ordre d'affichage.
     */
    public function scopeActiveOrdered($query)
    {
        return $query->where('is_active', true)->orderBy('position')->orderBy('id');
    }

    /**
     * Les ids de catégories à inclure : la catégorie choisie + ses sous-catégories.
     */
    protected function categoryIds(): \Illuminate\Support\Collection
    {
        return Category::where('id', $this->source_id)
            ->orWhere('parent_id', $this->source_id)
            ->pluck('id');
    }

    /**
     * Produits sponsorisés encore actifs, sans doublonner les produits.
     */
    protected function activeSponsorings()
    {
        return DB::table('product_sponsorings')
            ->select('product_id')
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->groupBy('product_id');
    }

    /**
     * Récupère les produits de la section selon son type (catégorie ou tag).
     */
    public function products()
    {
        $limit = $this->limit > 0 ? $this->limit : 8;

        if ($this->type === 'tag') {
            return Product::whereHas('tags', function ($q) {
                $q->where('tags.id', $this->source_id);
            })->latest()->limit($limit)->get();
        }

        return Product::leftJoinSub($this->activeSponsorings(), 'active_sponsorings', function ($join) {
            $join->on('products.id', '=', 'active_sponsorings.product_id');
        })
            ->whereIn('products.categorie_id', $this->categoryIds())
            ->select('products.*')
            ->selectRaw('CASE WHEN active_sponsorings.product_id IS NULL THEN 0 ELSE 1 END AS is_sponsored')
            ->orderByDesc('is_sponsored')
            ->orderByDesc('products.created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupère les produits d'une catégorie précise, dans la limite de la section.
     * Utilisé par l'affichage en onglets pour que chaque sous-catégorie ait
     * sa propre liste (et non une part d'une limite globale).
     */
    public function productsForCategory($categoryId)
    {
        $limit = $this->limit > 0 ? $this->limit : 8;

        return Product::leftJoinSub($this->activeSponsorings(), 'active_sponsorings', function ($join) {
            $join->on('products.id', '=', 'active_sponsorings.product_id');
        })
            ->where('products.categorie_id', $categoryId)
            ->select('products.*')
            ->selectRaw('CASE WHEN active_sponsorings.product_id IS NULL THEN 0 ELSE 1 END AS is_sponsored')
            ->orderByDesc('is_sponsored')
            ->orderByDesc('products.created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * La catégorie source (null si la section est basée sur un tag).
     */
    public function category(): ?Category
    {
        return $this->type === 'category' ? Category::find($this->source_id) : null;
    }

    /**
     * Nom lisible de la source, pour l'affichage en back-office.
     */
    public function sourceName(): ?string
    {
        if ($this->type === 'tag') {
            return optional(Tag::find($this->source_id))->name;
        }

        return optional(Category::find($this->source_id))->name;
    }
}
