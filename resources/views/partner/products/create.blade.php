@extends('layouts.layout')

@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h3><i class="fa fa-plus-circle"></i> Créer un Produit</h3>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <h5 class="alert-heading">Erreurs de validation</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informations du Produit</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nom" class="form-label">Nom du Produit <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom"
                                name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="categorie_id" class="form-label">Catégorie <span
                                    class="text-danger">*</span></label>
                            <select class="form-control @error('categorie_id') is-invalid @enderror" id="categorie_id"
                                name="categorie_id" required>
                                <option value="">-- Sélectionner une catégorie --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('categorie_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="prix" class="form-label">Prix (F CFA) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('prix') is-invalid @enderror" id="prix"
                                name="prix" value="{{ old('prix') }}" step="0.01" required>
                            <small class="form-text text-muted">Veuillez inclure une marge supplémentaire de 10 % dans le prix
                                de chaque produit pour couvrir ses frais d'hébergement et d'expédition.</small>
                            @error('prix')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="quantite" class="form-label">Quantité en Stock <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantite') is-invalid @enderror"
                                id="quantite" name="quantite" value="{{ old('quantite') }}" required>
                            @error('quantite')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <select class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags[]"
                            multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ in_array($tag->id, old('tags') ?? []) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs tags</small>
                        @error('tags')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="images" class="form-label">Images du Produit</label>
                        <input type="file" class="form-control @error('images') is-invalid @enderror" id="images"
                            name="images[]" multiple accept="image/*">
                        <small class="form-text text-muted">Vous pouvez sélectionner plusieurs images (max 50 Mo par
                            image)</small>
                        @error('images')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        <!-- Aperçu des images -->
                        <div id="imagePreview" class="mt-3"></div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Créer le Produit
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            <i class="fa fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Aperçu des images
        document.getElementById('images').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            const files = e.target.files;
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

            for (let file of files) {
                if (allowedTypes.includes(file.type)) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '150px';
                        img.style.margin = '10px';
                        img.style.borderRadius = '4px';
                        img.style.border = '1px solid #ddd';
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>

    <style>
        h3 {
            color: #333;
            font-weight: bold;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .text-danger {
            color: #dc3545;
        }
    </style>
@endsection
