@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Offres approuvées')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Offres approuvées</h5>
        <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary btn-sm">Retour</a>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Partenaire</th>
                    <th>Approuvée le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($offers as $offer)
                    <tr>
                        <td>{{ $offer->title }}</td>
                        <td>{{ $offer->user->name ?? 'N/A' }}</td>
                        <td>{{ $offer->approved_at ? $offer->approved_at->format('d/m/Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.offers.show', $offer) }}" class="btn btn-sm btn-info">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Aucune offre approuvée</td>
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
