<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\HomeSection;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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

    // Récupération de tous les carrousels
    $carousels = Carousel::all();

    // Sections de la page d'accueil configurées depuis le back-office,
    // dans l'ordre choisi. Remplace les catégories codées en dur.
    $homeSections = HomeSection::activeOrdered()->get();

    $activeSponsorings = DB::table('product_sponsorings')
      ->select('product_id')
      ->where('status', 'active')
      ->where('expires_at', '>', now())
      ->groupBy('product_id');

    $sponsoredProducts = Product::joinSub($activeSponsorings, 'active_sponsorings', function ($join) {
      $join->on('products.id', '=', 'active_sponsorings.product_id');
    })
      ->select('products.*')
      ->selectRaw('1 AS is_sponsored')
      ->orderByDesc('products.id')
      ->limit(8)
      ->get();

    // Produits populaires affichés dans la barre latérale (basés sur un tag).
    $produitsPopulaires = Product::whereHas('tags', function ($query) {
      $query->where('slug', 'produit-populaire');
    })->get();

    $posts = Post::latest()->paginate(6);

    // Retourner la vue avec les données compactées
    return view('index', compact(
      'categories',
      'carousels',
      'homeSections',
      'sponsoredProducts',
      'produitsPopulaires',
      'posts'
    ));
  }

  public function shop()
  {
    $activeSponsorings = DB::table('product_sponsorings')
      ->select('product_id')
      ->where('status', 'active')
      ->where('expires_at', '>', now())
      ->groupBy('product_id');

    $products = Product::leftJoinSub($activeSponsorings, 'active_sponsorings', function ($join) {
      $join->on('products.id', '=', 'active_sponsorings.product_id');
    })
      ->select('products.*')
      ->selectRaw('CASE WHEN active_sponsorings.product_id IS NULL THEN 0 ELSE 1 END AS is_sponsored')
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
}
