@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Demandes de sponsoring')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Demandes de sponsoring</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="GET" class="form-inline mb-3">
            <label for="status" class="mr-2">Statut</label>
            <select name="status" id="status" class="form-control mr-2">
                <option value="">Tous</option>
                @foreach (['pending' => 'En attente', 'active' => 'Actif', 'expired' => 'Expiré'] as $value => $label)
                    <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-secondary">Filtrer</button>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Produit</th>
                        <th>Demandeur</th>
                        <th>Téléphone partenaire</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Expiration</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sponsorings as $sponsoring)
                        <tr>
                            <td>{{ $sponsoring->reference }}</td>
                            <td>{{ $sponsoring->product->nom }}</td>
                            <td>{{ $sponsoring->user->name ?? 'Compte supprimé' }}</td>
                            <td>{{ $sponsoring->partner_phone ?: '—' }}</td>
                            <td>{{ number_format($sponsoring->amount, 0, ',', ' ') }} FCFA</td>
                            <td>{{ ['pending' => 'En attente', 'active' => 'Actif', 'expired' => 'Expiré'][$sponsoring->status] }}</td>
                            <td>{{ $sponsoring->expires_at ? $sponsoring->expires_at->format('d/m/Y H:i') : '—' }}</td>
                            <td>
                                @if ($sponsoring->status === 'pending')
                                    <form method="POST"
                                        action="{{ route('admin.sponsorings.activate', $sponsoring) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Valider et activer</button>
                                    </form>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Aucune demande de sponsoring trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $sponsorings->links('pagination::bootstrap-4') }}
    </div>
@endsection
