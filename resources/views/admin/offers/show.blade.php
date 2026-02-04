@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Détails Offre')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Détails de l'offre</h5>
                    <span
                        class="badge bg-{{ $offer->status === 'approved' ? 'success' : ($offer->status === 'pending_approval' ? 'warning' : 'danger') }}">
                        {{ ucfirst(str_replace('_', ' ', $offer->status)) }}
                    </span>
                </div>
                <div class="card-body">
                    <h4>{{ $offer->title }}</h4>
                    <p class="text-muted">Par: {{ $offer->user->name ?? 'N/A' }}</p>

                    <hr>

                    <h6>Description</h6>
                    <p>{{ $offer->description }}</p>

                    <hr>

                    <p><strong>Créée le:</strong> {{ $offer->created_at->format('d/m/Y H:i') }}</p>
                    @if ($offer->approved_at)
                        <p><strong>Approuvée le:</strong> {{ $offer->approved_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    @if ($offer->status === 'pending_approval')
                        <form action="{{ route('admin.offers.approve', $offer) }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Approuver</button>
                        </form>

                        <button class="btn btn-danger w-100" data-bs-toggle="collapse" data-bs-target="#rejectForm">
                            Rejeter
                        </button>

                        <div class="collapse mt-2" id="rejectForm">
                            <form action="{{ route('admin.offers.reject', $offer) }}" method="POST">
                                @csrf
                                <textarea name="reason" class="form-control" rows="3" placeholder="Raison du rejet" required></textarea>
                                @error('reason')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <button type="submit" class="btn btn-danger w-100 mt-2">Confirmer le rejet</button>
                            </form>
                        </div>
                    @endif

                    <form action="{{ route('admin.offers.destroy', $offer) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100"
                            onclick="return confirm('Supprimer cette offre ?')">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
