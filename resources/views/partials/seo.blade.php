@php
  use Illuminate\Support\Str;

  $siteName    = config('variables.templateName', 'Quincaillerie.ci');
  $defaultDesc = config('variables.templateDescription');

  // Titre : utilise @section('title') si défini, sinon le nom du site
  $pageTitle = trim($__env->yieldContent('title'));
  $fullTitle = $pageTitle !== '' ? ($pageTitle . ' | ' . $siteName) : ($siteName . ' - Quincaillerie & bricolage à Abidjan');

  // Description : @section('meta_description') sinon description par défaut (tronquée ~160)
  $metaDesc = trim($__env->yieldContent('meta_description'));
  $metaDesc = Str::limit(strip_tags($metaDesc !== '' ? $metaDesc : $defaultDesc), 160, '…');

  // URL canonique
  $canonical = trim($__env->yieldContent('canonical')) ?: url()->current();

  // Image de partage
  $ogImage = trim($__env->yieldContent('og_image')) ?: asset('front/assets/images/logo.png');
  $ogType  = trim($__env->yieldContent('og_type')) ?: 'website';
@endphp

<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $metaDesc }}">
<meta name="keywords" content="quincaillerie, bricolage, matériaux de construction, outillage, plomberie, électricité, quincaillerie Abidjan, quincaillerie Côte d'Ivoire, quincaillerie.ci">
<link rel="canonical" href="{{ $canonical }}">

<!-- Open Graph (Facebook, WhatsApp, LinkedIn…) -->
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $metaDesc }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:locale" content="fr_FR">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $metaDesc }}">
<meta name="twitter:image" content="{{ $ogImage }}">

<!-- Données structurées : Organisation + Site avec recherche -->
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'Store',
  'name' => $siteName,
  'description' => Str::limit(strip_tags($defaultDesc), 200, ''),
  'url' => url('/'),
  'image' => asset('front/assets/images/logo.png'),
  'address' => [
    '@type' => 'PostalAddress',
    'addressLocality' => 'Abidjan',
    'addressCountry' => 'CI',
  ],
  'potentialAction' => [
    '@type' => 'SearchAction',
    'target' => url('/search') . '?query={search_term_string}',
    'query-input' => 'required name=search_term_string',
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@yield('structured_data')
