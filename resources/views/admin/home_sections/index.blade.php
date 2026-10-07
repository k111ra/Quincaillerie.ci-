@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', "Sections d'accueil - Admin")

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Sections de la page d'accueil</h5>
                <small class="text-muted">Organisez les rangées de produits affichées après les catégories, les produits certifiés, les populaires et les nouveautés.</small>
            </div>
            <a href="{{ route('admin.home-sections.create') }}" class="btn btn-primary flex-shrink-0 text-nowrap">
                <i class="bx bx-plus"></i> Nouvelle section
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success m-3 mb-0">{{ session('success') }}</div>
        @endif

        <div class="card-body border-bottom">
            <div class="row g-3 align-items-center">
                <div class="col-md-8">
                    <h6 class="mb-1">Conseil de mise en page</h6>
                    <p class="text-muted mb-0">
                        Ajoutez une section par univers (par exemple Outillage, Plomberie ou Peinture), choisissez
                        <strong>Carrousel</strong> pour une rangée compacte et limitez-la à 8 produits. Utilisez
                        <strong>Onglets</strong> pour regrouper les sous-catégories d'une catégorie principale.
                        Les sections actives sont affichées selon leur ordre. Les raccourcis en haut de l'accueil
                        sélectionnent automatiquement les 8 catégories qui ont le plus de produits.
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bx bx-category"></i> Gérer les catégories
                    </a>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 mt-3">
                <span class="badge bg-label-success">{{ $sections->where('is_active', true)->count() }} section(s) visible(s)</span>
                <span class="badge bg-label-secondary">{{ $sections->where('is_active', false)->count() }} section(s) masquée(s)</span>
                <span class="badge bg-label-info">Catégories populaires, produits certifiés et nouveautés affichés automatiquement</span>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Ordre</th>
                        <th>Titre</th>
                        <th>Source</th>
                        <th>Affichage</th>
                        <th>Produits max.</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $section)
                        <tr>
                            <td>{{ $section->position }}</td>
                            <td><strong>{{ $section->title }}</strong></td>
                            <td>
                                <span class="badge bg-label-{{ $section->type === 'tag' ? 'info' : 'primary' }}">
                                    {{ $section->type === 'tag' ? 'Sélection par tag' : 'Univers catégorie' }}
                                </span>
                                {{ $section->sourceName() ?? '— introuvable —' }}
                            </td>
                            <td>
                                <span class="badge bg-label-secondary">
                                    {{ ['grid' => 'Grille', 'slider' => 'Carrousel', 'tabs' => 'Onglets'][$section->display] ?? $section->display }}
                                </span>
                            </td>
                            <td>{{ $section->limit }}</td>
                            <td>
                                <form action="{{ route('admin.home-sections.toggle', $section) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-{{ $section->is_active ? 'success' : 'secondary' }}">
                                        {{ $section->is_active ? 'Active' : 'Masquée' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.home-sections.edit', $section) }}" class="btn btn-sm btn-icon btn-outline-primary">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.home-sections.destroy', $section) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Supprimer cette section ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-icon btn-outline-danger">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Aucune rangée personnalisée pour le moment. Les catégories, produits certifiés,
                                produits populaires et nouveautés restent affichés automatiquement.
                                <div class="mt-2">
                                    <a href="{{ route('admin.home-sections.create') }}" class="btn btn-sm btn-primary">Créer une première rangée</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
