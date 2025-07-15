@extends('layouts.layout')
@section('title', 'recherche')
@section('content')
    <div class="search-results-container">
        <h2 class="search-title">Résultats de recherche pour "<span class="search-query">{{ $query }}</span>"</h2>

        <div class="results-section">
            <h3 class="section-title">Catégories</h3>
            <div class="categories-list" style="display: flex; flex-wrap: wrap; gap: 16px;">
                @if ($categories->count() > 0)
                    @foreach ($categories as $category)
                        <div class="category-item"
                            style="border: 1px solid #eee; padding: 12px; border-radius: 6px; min-width: 180px;">
                            <a href="{{ route('shop', ['slug' => $category->slug]) }}"
                                style="text-decoration: none; color: inherit;">
                                <h4>{{ $category->name }}</h4>
                            </a>
                        </div>
                    @endforeach
                @else
                    <p class="no-result">Aucune catégorie trouvée.</p>
                @endif
            </div>
        </div>

        <div class="results-section" style="margin-top: 32px;">
            <h3 class="section-title">Produits</h3>
            <div class="products-list" style="display: flex; flex-wrap: wrap; gap: 16px;">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <div style="flex: 1 1 220px; min-width: 220px;">
                            @include('partials.product')
                        </div>
                    @endforeach
                @else
                    <p class="no-result">Aucun produit trouvé.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
