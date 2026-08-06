@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold"><span class="text-muted fw-light">Admin /</span> Clients</h4>
                <p class="text-muted mb-0">Consultez la liste des utilisateurs clients inscrits</p>
            </div>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back"></i> Retour dashboard
                </a>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.clients.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label for="q" class="form-label">Recherche</label>
                        <input type="text" name="q" id="q" class="form-control"
                            placeholder="Nom, email ou téléphone" value="{{ $q }}">
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-search"></i> Rechercher
                        </button>
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Type</th>
                            <th>Inscription</th>
                            <th>Statut profil</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($clients as $client)
                            <tr>
                                <td>
                                    <strong>{{ $client->name }}</strong>
                                </td>
                                <td>{{ $client->email }}</td>
                                <td>
                                    @if ($client->tel)
                                        {{ $client->tel }}
                                    @else
                                        <span class="badge bg-label-warning">Non renseigné</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-label-info">{{ $client->user_type ?? 'customer' }}</span>
                                </td>
                                <td>{{ optional($client->created_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if ($client->tel)
                                        <span class="badge bg-label-success">Complet</span>
                                    @else
                                        <span class="badge bg-label-warning">À compléter</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Aucun client trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted">
                    Affichage de {{ $clients->firstItem() ?? 0 }} à {{ $clients->lastItem() ?? 0 }}
                    sur {{ $clients->total() }} client(s)
                </div>
                <div>
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
