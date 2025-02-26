@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Produits')

@section('content')
    <div class="{{ $container }}">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ajouter un nouveau produit') }}</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" class="form-control" name="nom" id="nom"
                                    placeholder="Nom du produit" value="{{ old('nom') }}" required>
                                @if ($errors->has('nom'))
                                    <div class="text-danger">{{ $errors->first('nom') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description :</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description du produit" required>{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="text-danger">{{ $errors->first('description') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="prix" class="form-label">Prix :</label>
                                <input type="number" class="form-control" name="prix" id="prix"
                                    placeholder="Prix du produit" value="{{ old('prix') }}" required>
                                @if ($errors->has('prix'))
                                    <div class="text-danger">{{ $errors->first('prix') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="images">Images :</label>
                                <input type="file" class="form-control" name="images[]" multiple>
                                @if ($errors->has('images'))
                                    <div class="text-danger">{{ $errors->first('images') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="quantite" class="form-label">Quantité :</label>
                                <input type="number" class="form-control" name="quantite" id="quantite"
                                    placeholder="Quantité du produit" value="{{ old('quantite') }}" required>
                                @if ($errors->has('quantite'))
                                    <div class="text-danger">{{ $errors->first('quantite') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="categorie_id" class="form-label">Catégorie :</label>
                                <div class="input-group">
                                    <select class="form-select" id="categorie_id" name="categorie_id" required>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                        @endforeach
                                    </select>
                                    <label class="input-group-text" for="ajoutCategorie">
                                        <a type="button" class="" data-bs-toggle="modal"
                                            data-bs-target="#modalAjoutCategorie">
                                            <i class="bx bxs-plus-circle"></i>
                                        </a>
                                    </label>
                                </div>
                                @if ($errors->has('categorie_id'))
                                    <div class="text-danger">{{ $errors->first('categorie_id') }}</div>
                                @endif
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

                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags :</label>

                                <div class="input-group">
                                    <select class="form-select" name="tags[]" id="tags" multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    <label class="input-group-text" for="ajoutTag">
                                        <a type="button" class="" data-bs-toggle="modal"
                                            data-bs-target="#modalAjoutTag">
                                            <i class="bx bxs-plus-circle"></i>
                                        </a>
                                    </label>
                                </div>
                                @if ($errors->has('tags'))
                                    <div class="text-danger">{{ $errors->first('tags') }}</div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('admin.fournisseurs.create')
    @include('admin.categories.create')
    @include('admin.tags.create')
@endsection
