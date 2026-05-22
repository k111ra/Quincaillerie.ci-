@extends('layouts/contentNavbarLayout')

@section('title', 'Gestion des produits')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Admin /</span> Gestion des produits
        </h4>

        <!-- Messages d'erreur et de succès -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                @if (session('errors'))
                    <hr>
                    <small><strong>Détails des erreurs:</strong></small>
                    <ul class="mb-0 mt-2 small">
                        @foreach (session('errors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Barre d'actions -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bx bx-cube-alt me-2"></i> Gestion des produits
                </h5>
                <div class="btn-group" role="group" aria-label="Actions produits">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i> Ajouter un produit
                    </a>
                    <a href="{{ route('admin.products.import.form') }}" class="btn btn-info">
                        <i class="bx bx-upload me-1"></i> Importer
                    </a>
                    <a href="{{ route('admin.products.export') }}" class="btn btn-warning">
                        <i class="bx bx-download me-1"></i> Exporter CSV
                    </a>
                </div>
            </div>
        </div>

        <!-- Formulaire de recherche et filtres -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.products.index') }}" class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="search" class="form-label">Rechercher un produit</label>
                            <input type="text" class="form-control" id="search" name="search"
                                placeholder="Nom du produit..." value="{{ request('search') }}" />
                        </div>

                        <div class="col-md-4">
                            <label for="categorie_id" class="form-label">Filtrer par catégorie</label>
                            <select class="form-select" id="categorie_id" name="categorie_id">
                                <option value="">Toutes les catégories</option>
                                @foreach ($categories ?? [] as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ request('categorie_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="fournisseur_id" class="form-label">Filtrer par fournisseur</label>
                            <select class="form-select" id="fournisseur_id" name="fournisseur_id">
                                <option value="">Tous les fournisseurs</option>
                                @foreach ($fournisseurs ?? [] as $fou)
                                    <option value="{{ $fou->id }}"
                                        {{ request('fournisseur_id') == $fou->id ? 'selected' : '' }}>
                                        {{ $fou->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="sort" class="form-label">Trier par</label>
                            <select class="form-select" id="sort" name="sort">
                                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Plus récents
                                </option>
                                <option value="ancien" {{ request('sort') == 'ancien' ? 'selected' : '' }}>Plus anciens
                                </option>
                                <option value="nom_asc" {{ request('sort') == 'nom_asc' ? 'selected' : '' }}>Nom (A-Z)
                                </option>
                                <option value="nom_desc" {{ request('sort') == 'nom_desc' ? 'selected' : '' }}>Nom (Z-A)
                                </option>
                                <option value="prix_asc" {{ request('sort') == 'prix_asc' ? 'selected' : '' }}>Prix
                                    croissant</option>
                                <option value="prix_desc" {{ request('sort') == 'prix_desc' ? 'selected' : '' }}>Prix
                                    décroissant</option>
                            </select>
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bx bx-search me-1"></i> Rechercher
                            </button>
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100">
                                <i class="bx bx-x me-1"></i> Réinitialiser
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau des produits -->
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 15%;">Image</th>
                            <th style="width: 25%;">Nom du produit</th>
                            <th style="width: 10%;">Prix</th>
                            <th style="width: 10%;">Quantité</th>
                            <th style="width: 15%;">Catégorie</th>
                            <th style="width: 15%;">Fournisseur</th>
                            <th style="width: 5%;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    <span class="fw-semibold">
                                        {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                    </span>
                                </td>
                                <td>
                                    @if ($product->images && json_decode($product->images))
                                        @php $images = json_decode($product->images); @endphp
                                        @if (count($images) > 0)
                                            <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $product->nom }}"
                                                class="rounded" style="width: 50px; height: 50px; object-fit: cover;" />
                                        @else
                                            <span class="text-muted small">Pas d'image</span>
                                        @endif
                                    @else
                                        <span class="text-muted small">Pas d'image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('product/' . $product->slug) }}" target="_blank"
                                        class="text-dark fw-semibold">
                                        {{ strlen($product->nom) > 30 ? substr($product->nom, 0, 30) . '...' : $product->nom }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-label-success">{{ number_format($product->prix, 0, ',', ' ') }} F CFA</span>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ $product->quantite > 0 ? 'bg-label-primary' : 'bg-label-danger' }}">
                                        {{ $product->quantite }} unités
                                    </span>
                                </td>
                                <td>
                                    @if ($product->category)
                                        <span class="text-muted small">{{ $product->category->name }}</span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->fournisseur)
                                        <span class="text-muted small">{{ $product->fournisseur->nom }}</span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.products.edit', $product->id) }}">
                                                <i class="bx bx-edit-alt me-2"></i> Modifier
                                            </a>
                                            <a class="dropdown-item" href="{{ url('product/' . $product->slug) }}"
                                                target="_blank">
                                                <i class="bx bx-eye me-2"></i> Voir
                                            </a>
                                            <hr class="dropdown-divider" />
                                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Confirmez la suppression de ce produit ?')">
                                                    <i class="bx bx-trash me-2"></i> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bx bx-inbox" style="font-size: 3rem;"></i>
                                        <p class="mt-2">Aucun produit trouvé</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer avec pagination -->
            @if ($products->count() > 0)
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span class="text-muted small">
                        Affichage de {{ ($products->currentPage() - 1) * $products->perPage() + 1 }}
                        à {{ min($products->currentPage() * $products->perPage(), $products->total()) }}
                        sur {{ $products->total() }} produits
                    </span>
                    <div>
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Auto-submit du formulaire de filtrage
        document.getElementById('categorie_id').addEventListener('change', function() {
            this.form.submit();
        });
        document.getElementById('fournisseur_id').addEventListener('change', function() {
            this.form.submit();
        });
        document.getElementById('sort').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
@endsection
