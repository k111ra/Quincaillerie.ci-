@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold"><span class="text-muted fw-light">Admin /</span> Partenaires</h4>
                <p class="text-muted">Gérez les partenaires/fournisseurs</p>
            </div>
        </div>

        <!-- Filters & Stats -->
        <div class="row mb-3">
            <div class="col-md-3">
                <a href="{{ route('admin.partners.index') }}" class="btn btn-primary w-100">
                    <i class="bx bx-list-ul"></i> Tous ({{ \App\Models\Fournisseur::count() }})
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.partners.pending') }}" class="btn btn-warning w-100">
                    <i class="bx bx-time"></i> À Approuver
                    ({{ \App\Models\Fournisseur::where('status', 'pending_approval')->count() }})
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.partners.approved') }}" class="btn btn-success w-100">
                    <i class="bx bx-check"></i> Approuvés
                    ({{ \App\Models\Fournisseur::where('status', 'approved')->count() }})
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.partners.index') }}?status=rejected" class="btn btn-danger w-100">
                    <i class="bx bx-x"></i> Rejetés ({{ \App\Models\Fournisseur::where('status', 'rejected')->count() }})
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bx bx-check-circle"></i> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Table -->
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Entreprise</th>
                            <th>Contact</th>
                            <th>Téléphone</th>
                            <th>Status</th>
                            <th>Date Inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($partners as $partner)
                            <tr>
                                <td>
                                    <strong>{{ $partner->nom }}</strong><br>
                                    <small class="text-muted">{{ $partner->user->name ?? 'N/A' }}</small>
                                </td>
                                <td>
                                    {{ $partner->email_primary ?? ($partner->user->email ?? 'N/A') }}<br>
                                    @if ($partner->phone_primary)
                                        <small class="text-muted">{{ $partner->phone_primary }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if ($partner->whatsapp_number)
                                        <i class="bx bxl-whatsapp text-success"></i> {{ $partner->whatsapp_number }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($partner->status === 'approved')
                                        <span class="badge bg-success">Approuvé</span>
                                    @elseif($partner->status === 'pending_approval')
                                        <span class="badge bg-warning">En attente</span>
                                    @elseif($partner->status === 'rejected')
                                        <span class="badge bg-danger">Rejeté</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $partner->created_at->format('d/m/Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.partners.show', $partner) }}" class="btn btn-sm btn-info">
                                        <i class="bx bx-show"></i> Voir
                                    </a>
                                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Êtes-vous sûr?')">
                                            <i class="bx bx-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Aucun partenaire trouvé
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted">
                    Affichage de {{ $partners->firstItem() ?? 0 }} à {{ $partners->lastItem() ?? 0 }}
                    sur {{ $partners->total() }} partenaires
                </div>
                <div>
                    {{ $partners->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
