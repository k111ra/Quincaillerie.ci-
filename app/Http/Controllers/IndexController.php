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
      $categories = Category::with('children')->whereNull('parent_id')->get();
      $carousels = Carousel::all();
      $products = Product::all();

      $popularCategory = Category::where('slug', 'produits-populaires')->first();
      $produitsPopulaires = $popularCategory ? Product::where('categorie_id', $popularCategory->id)->get() : collect();

      $bestseller = Category::where('slug', 'nos-produits-les-plus-vendus')->first();
      $produitsBestseller = $bestseller ? Product::where('categorie_id', $bestseller->id)->get() : collect();

      $specials = Category::where('slug', 'specials')->first();
      $produitsSpecial = $specials ? Product::where('categorie_id', $specials->id)->get() : collect();

      $enSolde = Category::where('slug', 'en-solde')->first();
      $produitsSolde = $enSolde ? Product::where('categorie_id', $enSolde->id)->get() : collect();

      // dd($produitsSolde);
      return view('index', compact('categories', 'carousels', 'products', 'produitsPopulaires', 'produitsBestseller', 'produitsSpecial', 'produitsSolde', 'bestseller'));
  }



}
