<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

    if (Schema::hasTable('sponsoring_campaigns') && Schema::hasColumn('product_sponsorings', 'campaign_id')) {
      $activeSponsorings = DB::table('product_sponsorings as ps')
        ->leftJoin('sponsoring_campaigns as sc', 'ps.campaign_id', '=', 'sc.id')
        ->select('ps.product_id')
        ->selectRaw("MAX(CASE WHEN sc.plan_code = 'shock' THEN 1 ELSE 0 END) AS is_shock")
        ->where('ps.status', 'active')
        ->where('ps.expires_at', '>', now())
        ->groupBy('ps.product_id');
    } else {
      $activeSponsorings = DB::table('product_sponsorings')
        ->select('product_id')
        ->selectRaw('0 AS is_shock')
        ->where('status', 'active')
        ->where('expires_at', '>', now())
        ->groupBy('product_id');
    }

    // Les produits sponsorisés actifs restent en tête quel que soit le tri choisi.
    $products = Product::where('categorie_id', $category->id)
      ->leftJoinSub($activeSponsorings, 'active_sponsorings', function ($join) {
        $join->on('products.id', '=', 'active_sponsorings.product_id');
      })
      ->select('products.*')
      ->selectRaw('CASE WHEN active_sponsorings.product_id IS NULL THEN 0 ELSE 1 END AS is_sponsored')
      ->selectRaw('COALESCE(active_sponsorings.is_shock, 0) AS is_shock')
      ->orderByDesc('is_sponsored')
      ->orderBy('products.' . $orderColumn, $orderDirection)
      ->paginate(12); // 12 produits par page

    return view('shop', compact('category', 'products'));
  }
}
