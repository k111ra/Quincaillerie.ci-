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
                <small class="text-muted">Choisissez quelles catégories / listes de produits s'affichent sur l'accueil, et dans quel ordre.</small>
            </div>
            <a href="{{ route('admin.home-sections.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Nouvelle section
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success m-3 mb-0">{{ session('success') }}</div>
        @endif

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Ordre</th>
                        <th>Titre</th>
                        <th>Source</th>
                        <th>Affichage</th>
                        <th>Nb produits</th>
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
                                    {{ $section->type === 'tag' ? 'Tag' : 'Catégorie' }}
                                </span>
                                {{ $section->sourceName() ?? '— introuvable —' }}
                            </td>
                            <td><span class="badge bg-label-secondary">{{ ucfirst($section->display) }}</span></td>
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
                                Aucune section pour le moment. Cliquez sur « Nouvelle section » pour commencer.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
