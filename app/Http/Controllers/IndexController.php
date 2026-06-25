<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\HomeSection;
use App\Models\Post;
use App\Models\Product;

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
      'produitsPopulaires',
      'posts'
    ));
  }

  public function shop()
  {
    $products = Product::paginate(12);
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
