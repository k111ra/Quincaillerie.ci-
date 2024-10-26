@extends('layouts/contentNavbarLayout')

@section('title', 'Liste des produits')

@section('content')
    <div class="container">
        <h1>Liste des produits</h1>

        <!-- Affichage des messages de succès ou d'erreur -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulaire de recherche -->
        <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Rechercher un produit...">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">Ajouter un produit</a>

        <div class="card">
            <h5 class="card-header">Liste des produits</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom du produit</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><strong>{{ $product->nom }}</strong></td>
                                <td>
                                    @if ($product->images && json_decode($product->images))
                                        @foreach (json_decode($product->images) as $image)
                                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->nom }}"
                                                width="50" class="rounded-circle me-1">
                                        @endforeach
                                    @else
                                        <p>Aucune image disponible</p>
                                    @endif
                                </td>
                                <td><span class="badge bg-label-primary me-1">Disponible</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.products.edit', $product->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Modifier
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')">
                                                    <i class="bx bx-trash me-1"></i> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $products->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
