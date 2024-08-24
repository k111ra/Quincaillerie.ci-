@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Categories de produit')

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
                                        placeholder="{{ $product->nom }}" value="{{ $product->nom }}"required>
                                </div>
                                <div>
                                    <label for="description" class="form-label">Description :</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="{{ $product->description }}" required></textarea>
                                </div>

                                <div>
                                    <label for="prix" class="form-label">Prix :</label>
                                    <input type="number" class="form-control" name="prix" id="prix"
                                        placeholder="{{ $product->prix }}" required value="{{ $product->prix }}">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                            width="100">
                                    @endif
                                    <input class="form-control" type="file" id="image" name="image">
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
                                            <option value="{{ $categorie->id }}">{{ $categorie->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>



                                <div>
                                  <label for="tags" class="form-label">Tags :</label>
                                  <select class="form-control" name="tags[]" id="tags" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            @if (in_array($tag->id, $productTags)) selected @endif>{{ $tag->name }}</option>
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
@endsection
