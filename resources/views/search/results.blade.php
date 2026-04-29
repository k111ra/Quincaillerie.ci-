@extends('layouts.layout')
@section('title', 'recherche')
@section('content')
    <style>
        .search-page {
            --surface: #ffffff;
            --surface-soft: #f8f9fb;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --line: #e5e7eb;
            --accent: #0f766e;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 12px 40px;
            color: var(--text-main);
        }

        .search-hero {
            background: linear-gradient(135deg, #f0fdfa 0%, #ecfeff 100%);
            border: 1px solid #ccfbf1;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .search-hero h2 {
            margin: 0;
            font-size: 1.45rem;
            line-height: 1.35;
            font-weight: 700;
        }

        .search-query {
            color: var(--accent);
        }

        .search-meta {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .search-chip {
            background: var(--surface);
            border: 1px solid #d1fae5;
            color: #065f46;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .search-section {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 18px;
        }

        .search-section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .search-section-title {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .search-count {
            color: var(--text-muted);
            font-size: 0.92rem;
            font-weight: 600;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 12px;
        }

        .category-card {
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface-soft);
            transition: all .2s ease;
        }

        .category-card:hover {
            border-color: #99f6e4;
            transform: translateY(-1px);
        }

        .category-link {
            display: block;
            text-decoration: none;
            color: inherit;
            padding: 14px;
            font-weight: 600;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
        }

        .empty-state {
            border: 1px dashed var(--line);
            border-radius: 10px;
            background: #fafafa;
            color: var(--text-muted);
            padding: 16px;
            margin: 0;
            text-align: center;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .search-page {
                padding: 14px 10px 28px;
            }

            .search-hero {
                padding: 16px;
            }

            .search-hero h2 {
                font-size: 1.2rem;
            }

            .search-section {
                padding: 14px;
            }
        }
    </style>

    <div class="search-page">
        <header class="search-hero">
            <h2>Résultats de recherche pour "<span class="search-query">{{ $query }}</span>"</h2>
            <div class="search-meta">
                <span class="search-chip">{{ $categories->count() }} catégorie(s)</span>
                <span class="search-chip">{{ $products->count() }} produit(s)</span>
            </div>
        </header>

        <section class="search-section" aria-labelledby="categories-title">
            <div class="search-section-head">
                <h3 id="categories-title" class="search-section-title">Catégories</h3>
                <span class="search-count">{{ $categories->count() }} résultat(s)</span>
            </div>

            @if ($categories->count() > 0)
                <div class="categories-grid">
                    @foreach ($categories as $category)
                        <article class="category-card">
                            <a class="category-link" href="{{ route('shop', ['slug' => $category->slug]) }}">
                                {{ $category->name }}
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="empty-state">Aucune catégorie trouvée pour cette recherche.</p>
            @endif
        </section>

        <section class="search-section" aria-labelledby="products-title">
            <div class="search-section-head">
                <h3 id="products-title" class="search-section-title">Produits</h3>
                <span class="search-count">{{ $products->count() }} résultat(s)</span>
            </div>

            @if ($products->count() > 0)
                <div class="products-grid">
                    @foreach ($products as $product)
                        <div>
                            @include('partials.product')
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-state">Aucun produit trouvé pour cette recherche.</p>
            @endif
        </section>
    </div>
@endsection
