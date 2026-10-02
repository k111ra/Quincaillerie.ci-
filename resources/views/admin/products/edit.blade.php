@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier un produit')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modifier un produit') }}</div>

                    <div class="card-body">
                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <div>
                                    <label for="nom" class="form-label">Nom :</label>
                                    <input type="text" class="form-control" name="nom" id="nom"
                                        placeholder="{{ $product->nom }}" value="{{ $product->nom }}" required>
                                </div>
                                <div>
                                    <label for="description" class="form-label">Description :</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="">{{ $product->description }}</textarea>
                                </div>

                                <div>
                                    <label for="prix" class="form-label">Prix :</label>
                                    <input type="number" class="form-control" name="prix" id="prix"
                                        placeholder="{{ $product->prix }}" required value="{{ $product->prix }}">
                                </div>

                                <!-- Gestion des images multiples -->
                                <div class="mb-3">
                                    <label for="images" class="form-label">Images</label>

                                    <!-- Afficher les images existantes -->
                                    @if ($product->images)
                                        @foreach (json_decode($product->images) as $image)
                                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->nom }}"
                                                width="100">
                                        @endforeach
                                    @endif

                                    <!-- Input pour les nouvelles images -->
                                    <input class="form-control" type="file" id="images" name="images[]" multiple>
                                    <small class="form-text text-muted">Taille maximale : 50 Mo par image.</small>
                                </div>

                                <div>
                                    <label for="quantite" class="form-label">Quantité :</label>
                                    <input type="number" class="form-control" name="quantite" id="quantite"
                                        placeholder="{{ $product->quantite }}" value="{{ $product->quantite }}" required>
                                </div>

                                <div>
                                    <label for="categorie_id" class="form-label">Catégorie :</label>
                                    <select class="form-control" name="categorie_id" id="categorie_id" required>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}"
                                                @if ($categorie->id == $product->categorie_id) selected @endif>
                                                {{ $categorie->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="fournisseur" class="form-label">Fournisseur :</label>
                                    <div class="input-group">
                                        <select class="form-select" id="fournisseur" name="fournisseur_id">
                                            @foreach ($fournisseurs as $fournisseur)
                                                <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                                            @endforeach
                                        </select>
                                        <label class="input-group-text" for="ajoutFournisseur">
                                            <a type="button" class="" data-bs-toggle="modal"
                                                data-bs-target="#modalAjoutFournisseur">
                                                <i class="bx bxs-plus-circle"></i>
                                            </a>
                                        </label>
                                    </div>
                                    @if ($errors->has('fournisseur_id'))
                                        <div class="text-danger">{{ $errors->first('fournisseur_id') }}</div>
                                    @endif

                                </div>

                                <div>
                                    <label for="tags" class="form-label">Tags :</label>
                                    <select class="form-control" name="tags[]" id="tags" multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                @if (in_array($tag->id, $productTags)) selected @endif>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <br>
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tags').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: "Sélectionnez ou ajoutez des tags",
                allowClear: true
            });
        });
    </script>
    <!-- Modal -->
    @include('admin.fournisseurs.create')
@endsection
