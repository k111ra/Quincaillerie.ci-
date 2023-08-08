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
    $produitsPopulaires = optional($popularCategory)->products ?? collect();

    $bestseller = Category::where('slug', 'nos-produits-les-plus-vendus')->first();
    $produitsBestseller = optional($bestseller)->products ?? collect();


    $specials = Category::where('slug', 'specials')->first();
    $produitsSpecial = optional($specials)->products ?? collect();

    $enSolde = Category::where('slug', 'en-solde')->first();
    $produitsSolde = optional($enSolde)->products ?? collect();

    return view('index', compact('categories', 'carousels', 'products', 'produitsPopulaires', 'produitsBestseller', 'produitsSpecial', 'produitsSolde'));
  }




}
