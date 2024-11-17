<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SearchLog;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  public function search(Request $request)
  {
    $query = $request->input('query');

    // Enregistrer la recherche
    SearchLog::create([
      'query' => $query,
      'user_id' => auth()->check() ? auth()->id() : null, // Utilisateur connecté (ou null si non connecté)
      'ip_address' => $request->ip(),
    ]);

    $products = Product::where('nom', 'LIKE', "%{$query}%")
      ->orWhere('description', 'LIKE', "%{$query}%")
      ->get();

    $categories = Category::where('name', 'LIKE', "%{$query}%")->get();

    return view('search.results', compact('products', 'categories', 'query'));
  }
  public function showSearches()
  {
    // Récupération des recherches stockées
    $searchLogs = SearchLog::latest()->paginate(10); // Pagination pour faciliter la gestion

    // Renvoi vers une vue avec les données
    return view('admin.search.index', compact('searchLogs'));
  }
}
