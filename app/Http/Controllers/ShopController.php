<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
  public function shop($slug)
  {
    $category = Category::where("slug", $slug)->first();
    $categories = Category::with('parent')->get();
    $parents = Category::pluck('name', 'id')->prepend('None', '');
    $products = Product::where('categorie_id', $category->id)->get();

    return view('shop', [
      'parents' => $parents,
      'categories' => $categories,
      'category' => $category,
      'products' => $products
    ]);
  }
}
