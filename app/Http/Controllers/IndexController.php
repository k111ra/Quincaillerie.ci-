<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function index()
  {
    // Récupération des catégories principales avec leurs sous-catégories, triées aléatoirement
    $categories = Category::with('children')
      ->whereNull('parent_id')
      ->inRandomOrder() // Mélanger les catégories
      ->get();

    // Récupération de tous les carrousels et produits
    $carousels = Carousel::all();
    $products = Product::all();

    // Récupération des produits pour différentes catégories spécifiques
    $produitsPopulaires = $this->getProductsByCategorySlug('produits-populaires');
    $bestseller = Category::where('slug', 'nos-produits-les-plus-vendus')->first(); // Ajout de cette ligne
    $produitsBestseller = $this->getProductsByCategorySlug('nos-produits-les-plus-vendus');
    $produitsSpecial = $this->getProductsByCategorySlug('specials');
    $produitsSolde = $this->getProductsByCategorySlug('en-solde');

    $posts = Post::latest()->paginate(6);

    // Retourner la vue avec les données compactées
    return view('index', compact(
      'categories',
      'carousels',
      'products',
      'produitsPopulaires',
      'produitsBestseller',
      'produitsSpecial',
      'produitsSolde',
      'bestseller',
      'posts'
    ));
  }


  // Fonction privée pour récupérer les produits en fonction du slug de la catégorie
  private function getProductsByCategorySlug($slug)
  {
    $category = Category::where('slug', $slug)->first();
    return $category ? Product::where('categorie_id', $category->id)->get() : collect();
  }
}
