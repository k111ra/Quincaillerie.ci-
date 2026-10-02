@extends('layouts/contentNavbarLayout')

@section('title', 'Import de produits')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Admin /</span> Import de produits
        </h4>

        <!-- Messages d'erreur et de succès -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erreurs détectées:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="mb-0">
                            <i class="bx bx-upload me-2"></i> Importer des produits
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf

                            <!-- Sélection de la catégorie -->
                            <div class="mb-3">
                                <label class="form-label" for="categorie_id">Catégorie par défaut</label>
                                <select class="form-select @error('categorie_id') is-invalid @enderror" id="categorie_id"
                                    name="categorie_id">
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('categorie_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categorie_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Vous pouvez aussi utiliser une colonne <code>categorie</code> dans le CSV. Elle sera créée automatiquement si nécessaire.</small>
                            </div>

                            <!-- Sélection du fournisseur -->
                            <div class="mb-3">
                                <label class="form-label" for="fournisseur_id">Fournisseur *</label>
                                <select class="form-select @error('fournisseur_id') is-invalid @enderror"
                                    id="fournisseur_id" name="fournisseur_id" required>
                                    <option value="">Sélectionnez un fournisseur</option>
                                    @foreach ($fournisseurs as $fournisseur)
                                        <option value="{{ $fournisseur->id }}"
                                            {{ old('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                                            {{ $fournisseur->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fournisseur_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Upload du fichier CSV -->
                            <div class="mb-3">
                                <label class="form-label" for="csv_file">Fichier CSV *</label>
                                <input class="form-control @error('csv_file') is-invalid @enderror" type="file"
                                    id="csv_file" name="csv_file" accept=".csv,.txt" required />
                                <small class="form-text text-muted d-block mt-2">
                                    Format accepté: CSV ou TXT (max 5 MB)
                                </small>
                                @error('csv_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="pt-3">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bx bx-upload me-1"></i> Importer
                                </button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bx bx-info-circle me-2"></i> Format du CSV
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">Le fichier CSV doit contenir les colonnes suivantes :</p>
                        <ul class="list-unstyled">
                            <li><strong class="text-danger">nom</strong> (obligatoire)</li>
                            <li><strong class="text-danger">prix</strong> (obligatoire)</li>
                            <li><strong>categorie</strong> ou <strong>category</strong> (optionnel, créée automatiquement si absente)</li>
                            <li><strong>description</strong> (optionnel)</li>
                            <li><strong>quantite</strong> (optionnel, défaut: 0)</li>
                        </ul>

                        <div class="alert alert-info mt-4 mb-0">
                            <strong>Exemple:</strong>
                            <pre class="mb-0 small">nom,prix,description,quantite
Produit A,19.99,Description A,100
Produit B,29.99,Description B,50</pre>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bx bx-download me-2"></i> Export existant
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-3">Téléchargez les produits existants au format CSV:</p>
                        <a href="{{ route('admin.products.export') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">
                            <i class="bx bx-download me-1"></i> Exporter en CSV
                        </a>
                        <p class="small text-muted mt-3 mb-2">Ou téléchargez un fichier exemple:</p>
                        <a href="{{ asset('exemple_produits.csv') }}" class="btn btn-outline-secondary btn-sm w-100"
                            download>
                            <i class="bx bx-file-csv me-1"></i> Exemple CSV
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
