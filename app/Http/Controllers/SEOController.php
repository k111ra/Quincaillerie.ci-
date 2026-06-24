<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Post;

class SEOController extends Controller
{
  /**
   * Génère dynamiquement le sitemap.xml du site.
   * Inclut les pages statiques, produits, catégories et articles.
   */
  public function sitemap()
  {
    $urls = [];

    // Pages statiques principales
    $urls[] = ['loc' => url('/'),         'priority' => '1.0', 'freq' => 'daily'];
    $urls[] = ['loc' => route('shop.index'), 'priority' => '0.9', 'freq' => 'daily'];
    $urls[] = ['loc' => route('offers'),  'priority' => '0.7', 'freq' => 'weekly'];
    $urls[] = ['loc' => route('posts'),   'priority' => '0.6', 'freq' => 'weekly'];
    $urls[] = ['loc' => route('contact'), 'priority' => '0.4', 'freq' => 'monthly'];

    // Produits
    Product::select('slug', 'updated_at')->whereNotNull('slug')->chunk(500, function ($products) use (&$urls) {
      foreach ($products as $p) {
        $urls[] = [
          'loc' => route('product', $p->slug),
          'lastmod' => optional($p->updated_at)->toAtomString(),
          'priority' => '0.8',
          'freq' => 'weekly',
        ];
      }
    });

    // Catégories
    Category::select('slug', 'updated_at')->whereNotNull('slug')->get()->each(function ($c) use (&$urls) {
      $urls[] = [
        'loc' => route('shop', $c->slug),
        'lastmod' => optional($c->updated_at)->toAtomString(),
        'priority' => '0.7',
        'freq' => 'weekly',
      ];
    });

    // Articles de blog
    Post::select('slug', 'updated_at')->whereNotNull('slug')->get()->each(function ($post) use (&$urls) {
      $urls[] = [
        'loc' => route('posts.show', $post->slug),
        'lastmod' => optional($post->updated_at)->toAtomString(),
        'priority' => '0.6',
        'freq' => 'monthly',
      ];
    });

    $content = $this->buildXml($urls);

    return response($content, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
  }

  /**
   * Construit le XML du sitemap à partir d'un tableau d'URLs.
   */
  private function buildXml(array $urls): string
  {
    $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($urls as $u) {
      $xml .= "  <url>\n";
      $xml .= "    <loc>" . htmlspecialchars($u['loc'], ENT_XML1) . "</loc>\n";
      if (!empty($u['lastmod'])) {
        $xml .= "    <lastmod>" . $u['lastmod'] . "</lastmod>\n";
      }
      $xml .= "    <changefreq>" . ($u['freq'] ?? 'weekly') . "</changefreq>\n";
      $xml .= "    <priority>" . ($u['priority'] ?? '0.5') . "</priority>\n";
      $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';

    return $xml;
  }
}
