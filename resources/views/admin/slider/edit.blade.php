@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier un Carousel')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="bx bx-edit me-2"></i>Modifier le Carousel
                    </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h6 class="alert-heading mb-1">Erreurs de validation</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.carousel.update', $carousel->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Informations générales -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title" class="form-label">
                                    <i class="bx bx-text me-1"></i>Titre du Carousel <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $carousel->title) }}" placeholder="Entrez le titre du carousel"
                                    required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">
                                    <i class="bx bx-detail me-1"></i>Description
                                </label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="3" placeholder="Entrez une description optionnelle">{{ old('description', $carousel->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Lien -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="link" class="form-label">
                                    <i class="bx bx-link me-1"></i>Lien (optionnel)
                                </label>
                                <input type="url" name="link" id="link"
                                    class="form-control @error('link') is-invalid @enderror"
                                    value="{{ old('link', $carousel->link) }}" placeholder="https://example.com">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Laissez vide si vous ne souhaitez pas de lien cliquable sur l'image
                                </div>
                            </div>
                        </div>

                        <!-- Image actuelle et nouvelle -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bx bx-image me-1"></i>Image actuelle
                                </label>
                                <div class="border rounded p-2">
                                    <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}"
                                        class="img-fluid rounded" style="max-height: 200px;">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">
                                    <i class="bx bx-upload me-1"></i>Nouvelle image (optionnel)
                                </label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Formats acceptés: JPEG, PNG, JPG, GIF. Taille max: 20MB</div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.carousel.index') }}" class="btn btn-secondary">
                                        <i class="bx bx-arrow-back me-1"></i>Retour à la liste
                                    </a>
                                    <div>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bx bx-save me-1"></i>Mettre à jour
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
