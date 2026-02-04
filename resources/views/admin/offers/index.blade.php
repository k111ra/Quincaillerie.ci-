@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Offres - Admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Toutes les Offres</h5>
            <div>
                <a href="{{ route('admin.offers.pending') }}" class="btn btn-warning btn-sm">À approuver</a>
                <a href="{{ route('admin.offers.approved') }}" class="btn btn-success btn-sm">Approuvées</a>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Partenaire</th>
                        <th>Statut</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offers as $offer)
                        <tr>
                            <td>{{ $offer->title }}</td>
                            <td>{{ $offer->user->name ?? 'N/A' }}</td>
                            <td>
                                @if ($offer->status === 'approved')
                                    <span class="badge bg-success">Approuvée</span>
                                @elseif($offer->status === 'pending_approval')
                                    <span class="badge bg-warning">En attente</span>
                                @else
                                    <span class="badge bg-danger">Rejetée</span>
                                @endif
                            </td>
                            <td>{{ $offer->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.offers.show', $offer) }}" class="btn btn-sm btn-info">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucune offre</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $offers->links() }}
        </div>
    </div>
@endsection
