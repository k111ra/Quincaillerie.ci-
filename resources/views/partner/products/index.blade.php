@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h3><i class="fa fa-box"></i> Mes Produits</h3>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('products.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Ajouter un Produit
            </a>
            <a href="{{ route('partner.dashboard') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa fa-check-circle"></i> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fa fa-exclamation-circle"></i> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($products->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Nom du Produit</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Date Création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <strong>{{ $product->nom }}</strong>
                            </td>
                            <td>
                                @if($product->category)
                                    <span class="badge badge-secondary">{{ $product->category->name }}</span>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($product->prix)
                                    {{ number_format($product->prix, 0, ',', ' ') }} F CFA
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($product->quantite !== null)
                                    <span class="badge {{ $product->quantite > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ $product->quantite }}
                                    </span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ $product->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-info" title="Modifier">
                                        <i class="fa fa-edit"></i> Modifier
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">
                                            <i class="fa fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="fa fa-inbox"></i> Vous n'avez pas encore ajouté de produits.
            <br><br>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Créer votre premier produit
            </a>
        </div>
    @endif
</div>

<style>
    .btn-group {
        display: flex;
        gap: 5px;
    }

    h3 {
        color: #333;
        font-weight: bold;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
</style>
@endsection
