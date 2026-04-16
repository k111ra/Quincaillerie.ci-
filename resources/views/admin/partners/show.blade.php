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
                <h4 class="fw-bold"><span class="text-muted fw-light">Admin / Partenaires /</span> Détails</h4>
            </div>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Retour
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bx bx-check-circle"></i> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Partner Info Card -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Informations Partenaire</h5>
                        <span
                            class="badge bg-{{ $partner->status === 'approved' ? 'success' : ($partner->status === 'pending_approval' ? 'warning' : 'danger') }}">
                            {{ ucfirst(str_replace('_', ' ', $partner->status)) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Nom Entreprise</label>
                                <p class="fw-bold">{{ $partner->nom }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Responsable</label>
                                <p class="fw-bold">{{ $partner->user->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Email Principal</label>
                                <p>
                                    <i class="bx bx-envelope"></i>
                                    {{ $partner->email_primary ?? ($partner->user?->email ?? 'N/A') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Téléphone</label>
                                <p>
                                    <i class="bx bx-phone"></i>
                                    {{ $partner->phone_primary ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">WhatsApp</label>
                                <p>
                                    @if ($partner->whatsapp_number)
                                        <i class="bx bxl-whatsapp text-success"></i> {{ $partner->whatsapp_number }}
                                    @else
                                        <span class="text-muted">Non renseigné</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Site Web</label>
                                <p>
                                    @if ($partner->website)
                                        <a href="{{ $partner->website }}" target="_blank">
                                            <i class="bx bx-link-external"></i> {{ $partner->website }}
                                        </a>
                                    @else
                                        <span class="text-muted">Non renseigné</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        @if ($partner->description)
                            <div class="mb-3">
                                <label class="form-label text-muted small">Description</label>
                                <p>{{ $partner->description }}</p>
                            </div>
                        @endif

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Date d'Inscription</label>
                                <p>{{ $partner->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            @if ($partner->approved_at)
                                <div class="col-md-6">
                                    <label class="form-label text-muted small">Date d'Approbation</label>
                                    <p>{{ $partner->approved_at->format('d/m/Y à H:i') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-primary w-100 mb-3">
                            <i class="bx bx-edit"></i> Modifier les informations
                        </a>

                        @if ($partner->status === 'pending_approval')
                            <!-- Approve Button -->
                            <form action="{{ route('admin.partners.approve', $partner) }}" method="POST" class="mb-3">
                                @csrf
                                <button type="submit" class="btn btn-success w-100 mb-2"
                                    onclick="return confirm('Approuver ce partenaire?')">
                                    <i class="bx bx-check-circle"></i> Approuver
                                </button>
                            </form>

                            <!-- Reject Button with Reason -->
                            <div class="mb-3">
                                <button class="btn btn-danger w-100" data-bs-toggle="collapse" data-bs-target="#rejectForm">
                                    <i class="bx bx-x-circle"></i> Rejeter
                                </button>

                                <div class="collapse mt-2" id="rejectForm">
                                    <form action="{{ route('admin.partners.reject', $partner) }}" method="POST">
                                        @csrf
                                        <div class="mb-2">
                                            <textarea name="reason" class="form-control form-control-sm" rows="3" placeholder="Raison du rejet..." required></textarea>
                                            @error('reason')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-danger w-100">Confirmer le
                                            rejet</button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        @if ($partner->status === 'approved')
                            <div class="alert alert-success mb-3">
                                <i class="bx bx-check"></i> Ce partenaire est approuvé
                            </div>
                        @endif

                        @if ($partner->status === 'rejected')
                            <div class="alert alert-danger mb-3">
                                <i class="bx bx-x"></i> Ce partenaire est rejeté
                            </div>
                        @endif

                        <!-- Delete Button -->
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100"
                                onclick="return confirm('Supprimer définitivement ce partenaire?')">
                                <i class="bx bx-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Contact Info Card -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Email Contact</h5>
                    </div>
                    <div class="card-body small">
                        <p>{{ $partner->email_primary ?? ($partner->user?->email ?? 'N/A') }}</p>
                        @if ($partner->email_primary || $partner->user?->email)
                            <a href="mailto:{{ $partner->email_primary ?? $partner->user?->email }}"
                                class="btn btn-sm btn-primary w-100">
                                <i class="bx bx-envelope"></i> Envoyer Email
                            </a>
                        @else
                            <button class="btn btn-sm btn-secondary w-100" disabled>
                                <i class="bx bx-envelope"></i> Aucun email disponible
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
