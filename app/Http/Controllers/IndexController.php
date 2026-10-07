<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\HomeSection;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class IndexController extends Controller
{
  public function index()
  {
    // Récupération des catégories principales avec leurs sous-catégories
    $categories = Category::with(['children' => function ($query) {
      $query->whereHas('products');
    }])
      ->whereNull('parent_id')
      ->where(function ($query) {
        $query->whereHas('products')
          ->orWhereHas('children.products');
      })
      ->get();

    $homeCategories = Category::withCount('products')
      ->has('products')
      ->orderByDesc('products_count')
      ->orderBy('name')
      ->limit(8)
      ->get();

    // Récupération de tous les carrousels
    $carousels = Carousel::all();

    // Sections de la page d'accueil configurées depuis le back-office,
    // dans l'ordre choisi. Remplace les catégories codées en dur.
    $homeSections = HomeSection::activeOrdered()->get();

    $activeSponsorings = $this->activeSponsorings();

    $sponsoredProducts = Product::joinSub($activeSponsorings, 'active_sponsorings', function ($join) {
      $join->on('products.id', '=', 'active_sponsorings.product_id');
    })
      ->select('products.*')
      ->selectRaw('1 AS is_sponsored')
      ->selectRaw('COALESCE(active_sponsorings.is_shock, 0) AS is_shock')
      ->orderByDesc('products.id')
      ->limit(8)
      ->get();

    $popularProducts = Product::whereHas('tags', function ($query) {
      $query->where('slug', 'produit-populaire');
    })
      ->leftJoinSub($activeSponsorings, 'popular_sponsorings', function ($join) {
        $join->on('products.id', '=', 'popular_sponsorings.product_id');
      })
      ->select('products.*')
      ->selectRaw('CASE WHEN popular_sponsorings.product_id IS NULL THEN 0 ELSE 1 END AS is_sponsored')
      ->selectRaw('COALESCE(popular_sponsorings.is_shock, 0) AS is_shock')
      ->orderByDesc('is_sponsored')
      ->orderByDesc('products.id')
      ->limit(12)
      ->get();

    $newProducts = Product::leftJoinSub($activeSponsorings, 'new_sponsorings', function ($join) {
      $join->on('products.id', '=', 'new_sponsorings.product_id');
    })
      ->select('products.*')
      ->selectRaw('CASE WHEN new_sponsorings.product_id IS NULL THEN 0 ELSE 1 END AS is_sponsored')
      ->selectRaw('COALESCE(new_sponsorings.is_shock, 0) AS is_shock')
      ->orderByDesc('is_sponsored')
      ->orderByDesc('products.id')
      ->limit(8)
      ->get();

    $posts = Post::latest()->paginate(6);

    // Retourner la vue avec les données compactées
    return view('index', compact(
      'categories',
      'homeCategories',
      'carousels',
      'homeSections',
      'sponsoredProducts',
      'popularProducts',
      'newProducts',
      'posts'
    ));
  }

  public function shop()
  {
    $activeSponsorings = $this->activeSponsorings();

    $products = Product::leftJoinSub($activeSponsorings, 'active_sponsorings', function ($join) {
      $join->on('products.id', '=', 'active_sponsorings.product_id');
    })
      ->select('products.*')
      ->selectRaw('CASE WHEN active_sponsorings.product_id IS NULL THEN 0 ELSE 1 END AS is_sponsored')
      ->selectRaw('COALESCE(active_sponsorings.is_shock, 0) AS is_shock')
      ->orderByDesc('is_sponsored')
      ->orderByDesc('products.id')
      ->paginate(12);
    $categories = Category::with(['children' => function ($query) {
      $query->whereHas('products');
    }])
      ->whereNull('parent_id')
      ->where(function ($query) {
        $query->whereHas('products')
          ->orWhereHas('children.products');
      })
      ->get();

    return view('shop', compact('products', 'categories'));
  }

  private function activeSponsorings()
  {
    if (Schema::hasTable('sponsoring_campaigns') && Schema::hasColumn('product_sponsorings', 'campaign_id')) {
      return DB::table('product_sponsorings as ps')
        ->leftJoin('sponsoring_campaigns as sc', 'ps.campaign_id', '=', 'sc.id')
        ->select('ps.product_id')
        ->selectRaw("MAX(CASE WHEN sc.plan_code = 'shock' THEN 1 ELSE 0 END) AS is_shock")
        ->where('ps.status', 'active')
        ->where('ps.expires_at', '>', now())
        ->groupBy('ps.product_id');
    }

    return DB::table('product_sponsorings')
      ->select('product_id')
      ->selectRaw('0 AS is_shock')
      ->where('status', 'active')
      ->where('expires_at', '>', now())
      ->groupBy('product_id');
  }
}
