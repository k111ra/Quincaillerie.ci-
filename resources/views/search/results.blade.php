@extends('layouts.layout')
@section('title', 'recherche')
@section('content')
    <h2>Résultats de recherche pour "{{ $query }}"</h2>

    <h3>Produits</h3>
    @if($products->count() > 0)
        @foreach($products as $product)
        @include('partials.product')
            {{-- <div class="product">
                <h4>{{ $product->nom }}</h4>
                <p>{{ $product->description }}</p>
                <p>Prix : {{ $product->prix }} F CFA</p>
            </div> --}}
        @endforeach
    @else
        <p>Aucun produit trouvé.</p>
    @endif

    <h3>Catégories</h3>
    @if($categories->count() > 0)
        @foreach($categories as $category)
            <div class="category">
                <h4>{{ $category->name }}</h4>
            </div>
        @endforeach
    @else
        <p>Aucune catégorie trouvée.</p>
    @endif
@endsection
