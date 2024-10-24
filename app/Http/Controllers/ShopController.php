<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
  public function shop(Request $request, $categorySlug)
  {
    $category = Category::where('slug', $categorySlug)->firstOrFail();

    // Gérer les options de tri
    $sortBy = $request->get('orderby', 'menu_order');

    // Appliquer le tri en fonction de l'option sélectionnée
    switch ($sortBy) {
      case 'price_low_high':
        $orderColumn = 'prix';
        $orderDirection = 'asc';
        break;
      case 'price_high_low':
        $orderColumn = 'prix';
        $orderDirection = 'desc';
        break;
      default:
        $orderColumn = 'created_at';
        $orderDirection = 'desc';
    }

    // Récupérer les produits avec pagination
    $products = Product::where('categorie_id', $category->id)
      ->orderBy($orderColumn, $orderDirection)
      ->paginate(12); // 12 produits par page

    return view('shop', compact('category', 'products'));
  }
}
