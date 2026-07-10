@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Cotations automatiques - Administration')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0"><i class="bx bx-envelope"></i> Demandes de cotation</h4>
            <form method="POST" action="{{ route('admin.cotations.process') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-refresh"></i> Vérifier les emails maintenant
                </button>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            @php
                $statusMeta = [
                    'detecte' => ['label' => 'Détectées', 'color' => 'info'],
                    'analyse' => ['label' => 'À compléter', 'color' => 'warning'],
                    'pret' => ['label' => 'Prêtes à envoyer', 'color' => 'primary'],
                    'envoye' => ['label' => 'Envoyées', 'color' => 'success'],
                    'erreur' => ['label' => 'Erreurs', 'color' => 'danger'],
                ];
            @endphp
            @foreach ($statusMeta as $status => $meta)
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body py-3">
                            <h3 class="mb-0 text-{{ $meta['color'] }}">{{ $counts[$status] ?? 0 }}</h3>
                            <small>{{ $meta['label'] }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Sujet</th>
                            <th>Produits</th>
                            <th>Score</th>
                            <th>Statut</th>
                            <th>Reçu le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $req)
                            <tr>
                                <td>{{ $req->quote_number ?? $req->id }}</td>
                                <td>
                                    <strong>{{ $req->from_name ?: '—' }}</strong><br>
                                    <small class="text-muted">{{ $req->from_email }}</small>
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($req->subject, 40) }}</td>
                                <td>{{ $req->items_count }}</td>
                                <td>{{ $req->detection_score }}/100</td>
                                <td>
                                    @php
                                        $colors = [
                                            'nouveau' => 'secondary', 'detecte' => 'info', 'analyse' => 'warning',
                                            'pret' => 'primary', 'envoye' => 'success', 'rejete' => 'dark', 'erreur' => 'danger',
                                        ];
                                    @endphp
                                    <span class="badge bg-label-{{ $colors[$req->status] ?? 'secondary' }}">
                                        {{ \App\Models\QuoteRequest::statusLabels()[$req->status] ?? $req->status }}
                                    </span>
                                </td>
                                <td>{{ optional($req->received_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.cotations.show', $req) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-show"></i> Ouvrir
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    Aucune demande de cotation détectée pour le moment.<br>
                                    <small>Cliquez sur « Vérifier les emails maintenant » ou attendez le traitement automatique (toutes les 10 min).</small>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                {{ $requests->links() }}
            </div>
        </div>
    </div>
@endsection
