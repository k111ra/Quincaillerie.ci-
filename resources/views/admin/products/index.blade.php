@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Categories de produit')

@section('content')
    <div class="container">
        <h1>Liste des produits</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">Ajouter un produit</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom du produits</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->nom }}</td>
                        {{-- <td><img src="{{ asset('storage/' . $product->image) }}" width="100" alt="{{ $product->nom }}"></td> --}}
                        <td>
                            @if ($product->images && json_decode($product->images))
                                @foreach (json_decode($product->images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->nom }}" width="100">
                                @endforeach
                            @else
                                <p>Aucune image disponible</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="btn btn-sm btn-primary">Modifier</a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE') <!-- Utilisez DELETE au lieu de POST -->
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
