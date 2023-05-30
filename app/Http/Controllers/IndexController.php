<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function index()
{
    $categories = Category::with('children')
        ->whereNull('parent_id')
        ->get();

    $carousels = Carousel::all();

    $products = Product::all();

    $popularCategory = Category::where('slug', 'produits-populaires')->first();
    $produitsPopulaires = Product::where('categorie_id', $popularCategory->id)->get();

    $bestseller = Category::where('slug', 'nos-produits-les-plus-vendus')->first();
    $produitsBestseller = Product::where('categorie_id', $bestseller->id)->get();

    $specials = Category::where('slug', 'specials')->first();
    $produitsSpecial = Product::where('categorie_id', $specials->id)->get();

    $enSolde = Category::where('slug', 'en-solde')->first();
    $produitsSolde = Product::where('categorie_id', $enSolde->id)->get();


    return view('index', compact('categories', 'carousels', 'products', 'produitsPopulaires', 'bestseller', 'specials', 'produitsSpecial', 'enSolde', 'produitsSolde'));
}




}
