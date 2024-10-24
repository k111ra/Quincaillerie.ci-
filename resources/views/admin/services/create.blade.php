@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Ajouter un nouveau service')
@section('page-script')
    <script src="{{ asset('assets/js/ui-modals.js') }}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Ajouter un nouveau service') }}</div>
                    <!-- Afficher un message de succès -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Afficher un message d'erreur -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <div class="mb-3">
                                <label for="title" class="form-label">Titre :</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Titre du service" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description :</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description du service" required></textarea>
                            </div>

                            {{-- <div class="mb-3">
                            <label for="prix" class="form-label">Prix :</label>
                            <input type="number" class="form-control" name="prix" id="prix" placeholder="Prix du service" required>
                        </div> --}}

                            <div class="mb-3">
                                <label for="categories_id" class="form-label">Catégorie :</label>
                                <select class="form-control" name="categories_id" id="categories_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags :</label>
                                <select class="form-control" name="tags[]" id="tags" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="images" class="form-label">Images :</label>
                                <input type="file" class="form-control" name="images[]" id="images" multiple required>
                            </div>

                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <h1 class="pb-1 mb-4 text-muted">Liste des Services</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            @foreach ($services as $service)
                <div class="col">
                    <div class="card h-100">
                        <!-- Carrousel d'images -->
                        <div id="carousel{{ $service->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($service->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100"
                                            alt="Image {{ $index }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carousel{{ $service->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carousel{{ $service->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->title }}</h5>
                            {{-- <p class="card-text">{!! $service->description !!}</p> --}}
                            <div class="d-flex justify-content-between">
                                <!-- Bouton d'édition -->
                                {{-- <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning"> --}}
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#{{ $service->slug }}">
                                    Modifier
                                </button>
                                <!-- Bouton de suppression -->
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class='bx bx-trash-alt'></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Modal de modification -->
        @foreach ($services as $service)
            <!-- Large Modal -->
            <div class="modal fade" id="{{ $service->slug }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel3">Modifier le service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="nameLarge" class="form-label">Titre :</label>
                                    <input type="text" id="nameLarge" name="title" class="form-control"
                                        placeholder="Enter Titre" value="{{ $service->title }}" required>
                                </div>
                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description :</label>
                                    <textarea name="description" id="description" class="form-control" placeholder="Enter Description" required>{!! $service->description !!}</textarea>
                                </div>
                                <!-- Categorie -->
                                <div class="mb-3">
                                    <label for="categories_id" class="form-label">Catégorie :</label>
                                    <select class="form-control" name="categories_id" id="categories_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id === $service->categories_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Section pour afficher les images actuelles -->
                                <div class="mb-3">
                                    <label for="currentImages" class="form-label">Images Actuelles :</label>
                                    <div class="current-images">
                                        @foreach ($service->images as $image)
                                            <img src="{{ asset('storage/' . $image->path) }}" width="100px"
                                                alt="Image actuelle">
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="images" class="form-label">Nouvelles Images :</label>
                                    <input type="file" class="form-control" name="images[]" id="images" multiple>
                                </div>

                                <!-- Move the form and submit button inside the modal body -->
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Fermer</button> --}}
                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>


@endsection
