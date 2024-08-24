@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Produits')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ajouter un nouveau produit') }}</div>

                    <div class="card-body">
                      <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                          <label for="nom" class="form-label">Nom :</label>
                          <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom du produit" required>
                        </div>

                        <div>
                          <label for="description" class="form-label">Description :</label>
                          <textarea class="form-control" name="description" id="description" placeholder="Description du produit" required></textarea>
                        </div>

                        <div>
                          <label for="prix" class="form-label">Prix :</label>
                          <input type="number" class="form-control" name="prix" id="prix" placeholder="Prix du produit" required>
                        </div>

                        <div>
                          <label for="image" class="form-label">Image :</label>
                          <input type="file" class="form-control" name="image" id="image" required>
                        </div>

                        <div>
                          <label for="quantite" class="form-label">Quantité :</label>
                          <input type="number" class="form-control" name="quantite" id="quantite" placeholder="Quantité du produit" required>
                        </div>

                        {{-- <div>
                          <label for="taille" class="form-label">Taille :</label>
                          <select class="form-control" name="taille" id="taille" required>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                          </select>
                        </div> --}}

                        <div>
                          <label for="categorie_id" class="form-label">Catégorie :</label>
                          <select class="form-control" name="categorie_id" id="categorie_id" required>
                            @foreach($categories as $categorie)
                              <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endforeach
                          </select>
                        </div>

                        <div>
                          <label for="tags" class="form-label">Tags :</label>
                          <select class="form-control" name="tags[]" id="tags" multiple>
                            @foreach($tags as $tag)
                              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                          </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                      </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
