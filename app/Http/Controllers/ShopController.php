<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    $activeSponsorings = DB::table('product_sponsorings')
      ->select('product_id')
      ->where('status', 'active')
      ->where('expires_at', '>', now())
      ->groupBy('product_id');

    // Les produits sponsorisés actifs restent en tête quel que soit le tri choisi.
    $products = Product::where('categorie_id', $category->id)
      ->leftJoinSub($activeSponsorings, 'active_sponsorings', function ($join) {
        $join->on('products.id', '=', 'active_sponsorings.product_id');
      })
      ->select('products.*')
      ->selectRaw('CASE WHEN active_sponsorings.product_id IS NULL THEN 0 ELSE 1 END AS is_sponsored')
      ->orderByDesc('is_sponsored')
      ->orderBy('products.' . $orderColumn, $orderDirection)
      ->paginate(12); // 12 produits par page

    return view('shop', compact('category', 'products'));
  }
}
