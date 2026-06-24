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
    $query = trim((string) $request->input('query'));

    // N'enregistrer que les vraies recherches d'utilisateurs :
    // - requête non vide
    // - pas un robot/crawler (Bingbot, Googlebot, etc.)
    if ($query !== '' && !$this->isBot($request->userAgent())) {
      SearchLog::create([
        'query' => mb_substr($query, 0, 255),
        'user_id' => auth()->id(), // null si non connecté
        'ip_address' => $request->ip(),
      ]);
    }

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

  /**
   * Détecte les robots/crawlers d'après le User-Agent.
   * Un User-Agent absent est considéré comme suspect.
   */
  private function isBot(?string $userAgent): bool
  {
    if (empty($userAgent)) {
      return true;
    }

    return (bool) preg_match(
      '/bot|crawl|spider|slurp|mediapartners|bingpreview|facebookexternalhit|embedly|quora|pinterest|slackbot|vkshare|w3c_validator|whatsapp|telegram|semrush|ahrefs|mj12|dotbot|petalbot|yandex|applebot|duckduckbot|googlebot|baiduspider|sogou|exabot|archive\.org_bot|gptbot|ccbot|claudebot|amazonbot/i',
      $userAgent
    );
  }
}
