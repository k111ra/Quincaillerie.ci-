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
                <h4 class="fw-bold"><span class="text-muted fw-light">Admin /</span> Partenaires En Attente</h4>
                <p class="text-muted">Approuvez les nouvelles demandes d'inscription</p>
            </div>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Retour
            </a>
        </div>

        <!-- Stats -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-warning">
                    <i class="bx bx-info-circle"></i>
                    {{ $partners->total() }} partenaire(s) en attente d'approbation
                </div>
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
                            <th>Responsable</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Date Inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($partners as $partner)
                            <tr>
                                <td>
                                    <strong>{{ $partner->nom }}</strong>
                                </td>
                                <td>
                                    {{ $partner->user->name ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ $partner->email_primary ?? ($partner->user->email ?? 'N/A') }}
                                </td>
                                <td>
                                    {{ $partner->phone_primary ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ $partner->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.partners.show', $partner) }}" class="btn btn-sm btn-info">
                                        <i class="bx bx-show"></i> Examiner
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bx bx-check-circle"></i> Aucun partenaire en attente! Parfait!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($partners->total() > 0)
                <div class="d-flex justify-content-between align-items-center p-3">
                    <div class="text-muted">
                        Affichage de {{ $partners->firstItem() ?? 0 }} à {{ $partners->lastItem() ?? 0 }}
                    </div>
                    <div>
                        {{ $partners->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
