@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Demandes de sponsoring')

@section('content')
    <style>
        .admin-sponsoring {
            --sponsor-admin-navy: #0f2c59;
            --sponsor-admin-orange: #ff6b00;
            --sponsor-admin-bg: #f4f6f9;
            --sponsor-admin-muted: #697586;
            color: #253247;
        }

        .admin-sponsoring-hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
            border-radius: 14px;
            padding: 24px 28px;
            color: #fff;
            background: linear-gradient(115deg, #0f2c59, #194981);
        }

        .admin-sponsoring-hero h1 {
            margin: 4px 0;
            color: #fff;
            font-size: 25px;
            font-weight: 800;
        }

        .admin-sponsoring-hero p {
            margin: 0;
            color: #dce8f7;
            font-size: 13px;
        }

        .admin-sponsoring-eyebrow {
            color: #ffb16f;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .admin-sponsoring-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }

        .admin-sponsoring-stat {
            display: flex;
            align-items: center;
            gap: 13px;
            border: 1px solid #e8edf3;
            border-radius: 12px;
            padding: 16px;
            background: #fff;
            box-shadow: 0 4px 15px rgb(15 44 89 / 4%);
        }

        .admin-sponsoring-stat-icon {
            display: grid;
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            place-items: center;
            border-radius: 12px;
            color: #0f2c59;
            background: #eaf1fa;
            font-size: 19px;
            font-weight: 800;
        }

        .admin-sponsoring-stat-pending .admin-sponsoring-stat-icon {
            color: #a45a00;
            background: #fff2db;
        }

        .admin-sponsoring-stat-active .admin-sponsoring-stat-icon {
            color: #16764b;
            background: #e2f5eb;
        }

        .admin-sponsoring-stat-value {
            display: block;
            color: #0f2c59;
            font-size: 22px;
            font-weight: 800;
            line-height: 1.1;
        }

        .admin-sponsoring-stat-label {
            color: var(--sponsor-admin-muted);
            font-size: 12px;
        }

        .admin-sponsoring-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 22px;
            border: 1px solid #e8edf3;
            border-radius: 12px;
            padding: 13px 16px;
            background: #fff;
        }

        .admin-sponsoring-toolbar-title {
            color: #0f2c59;
            font-size: 14px;
            font-weight: 800;
        }

        .admin-sponsoring-filter {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0;
        }

        .admin-sponsoring-filter label {
            margin: 0;
            color: var(--sponsor-admin-muted);
            font-size: 12px;
            font-weight: 700;
        }

        .admin-sponsoring-filter select {
            min-width: 155px;
            border: 1px solid #dce3ec;
            border-radius: 8px;
            padding: 8px 30px 8px 11px;
            color: #253247;
            background-color: #fff;
            font-size: 13px;
        }

        .admin-sponsoring-section {
            margin-top: 28px;
        }

        .admin-sponsoring-section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }

        .admin-sponsoring-section-heading h2 {
            margin: 0;
            color: #0f2c59;
            font-size: 17px;
            font-weight: 800;
        }

        .admin-sponsoring-section-count {
            border-radius: 20px;
            padding: 4px 9px;
            color: #526175;
            background: #e9eef5;
            font-size: 11px;
            font-weight: 800;
        }

        .admin-sponsoring-list {
            display: grid;
            gap: 11px;
        }

        .admin-sponsoring-card {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 18px;
            align-items: center;
            border: 1px solid #e7ecf2;
            border-radius: 12px;
            padding: 17px 19px;
            background: #fff;
            box-shadow: 0 3px 12px rgb(15 44 89 / 3%);
        }

        .admin-sponsoring-card-pending {
            border-left: 4px solid #ffb13b;
        }

        .admin-sponsoring-card-main {
            min-width: 0;
        }

        .admin-sponsoring-card-heading {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 11px;
        }

        .admin-sponsoring-reference {
            color: #0f2c59;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .admin-sponsoring-plan {
            border-radius: 20px;
            padding: 4px 9px;
            color: #8a4600;
            background: #fff0df;
            font-size: 11px;
            font-weight: 800;
        }

        .admin-sponsoring-meta {
            display: grid;
            grid-template-columns: repeat(3, minmax(120px, 1fr));
            gap: 12px 20px;
        }

        .admin-sponsoring-meta-item {
            min-width: 0;
        }

        .admin-sponsoring-meta-label {
            display: block;
            margin-bottom: 3px;
            color: #8390a2;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .4px;
            text-transform: uppercase;
        }

        .admin-sponsoring-meta-value {
            display: block;
            overflow-wrap: anywhere;
            color: #344258;
            font-size: 13px;
            font-weight: 600;
        }

        .admin-sponsoring-amount {
            color: #0f2c59;
            font-size: 16px;
            font-weight: 800;
            white-space: nowrap;
        }

        .admin-sponsoring-status {
            display: inline-block;
            border-radius: 20px;
            padding: 5px 9px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .admin-sponsoring-status-pending {
            color: #815100;
            background: #fff2cf;
        }

        .admin-sponsoring-status-active {
            color: #14683b;
            background: #dff5e8;
        }

        .admin-sponsoring-status-expired {
            color: #586273;
            background: #e9edf2;
        }

        .admin-sponsoring-activate {
            min-width: 155px;
            border: 0;
            border-radius: 8px;
            padding: 10px 13px;
            color: #fff;
            background: #16834a;
            font-size: 12px;
            font-weight: 800;
            line-height: 1.35;
            text-align: center;
        }

        .admin-sponsoring-activate:hover {
            color: #fff;
            background: #106c3c;
        }

        .admin-sponsoring-empty {
            border: 1px dashed #cfd8e3;
            border-radius: 11px;
            padding: 24px;
            color: var(--sponsor-admin-muted);
            background: #fff;
            font-size: 13px;
            text-align: center;
        }

        .admin-sponsoring-pagination {
            display: flex;
            justify-content: center;
            margin-top: 13px;
        }

        @media (max-width: 900px) {
            .admin-sponsoring-meta {
                grid-template-columns: repeat(2, minmax(120px, 1fr));
            }
        }

        @media (max-width: 600px) {
            .admin-sponsoring-hero {
                align-items: flex-start;
                padding: 20px;
            }

            .admin-sponsoring-hero h1 {
                font-size: 21px;
            }

            .admin-sponsoring-stats {
                gap: 8px;
            }

            .admin-sponsoring-stat {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
                padding: 12px;
            }

            .admin-sponsoring-stat-icon {
                width: 34px;
                height: 34px;
                flex-basis: 34px;
                border-radius: 9px;
                font-size: 16px;
            }

            .admin-sponsoring-stat-value {
                font-size: 19px;
            }

            .admin-sponsoring-stat-label {
                font-size: 10px;
            }

            .admin-sponsoring-toolbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .admin-sponsoring-filter {
                width: 100%;
            }

            .admin-sponsoring-filter select {
                flex: 1;
            }

            .admin-sponsoring-card {
                grid-template-columns: 1fr;
                gap: 14px;
                padding: 15px;
            }

            .admin-sponsoring-meta {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .admin-sponsoring-activate {
                width: 100%;
            }
        }
    </style>

    <div class="container-fluid py-3 admin-sponsoring">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <header class="admin-sponsoring-hero">
            <div>
                <span class="admin-sponsoring-eyebrow">Marketplace · Gestion commerciale</span>
                <h1>Demandes de sponsoring</h1>
                <p>Vérifiez les reçus reçus, puis activez les produits après confirmation du paiement.</p>
            </div>
        </header>

        <section class="admin-sponsoring-stats" aria-label="Résumé des demandes">
            <article class="admin-sponsoring-stat admin-sponsoring-stat-pending">
                <span class="admin-sponsoring-stat-icon" aria-hidden="true">◷</span>
                <div>
                    <span class="admin-sponsoring-stat-value">{{ number_format($stats['pending']) }}</span>
                    <span class="admin-sponsoring-stat-label">À vérifier</span>
                </div>
            </article>
            <article class="admin-sponsoring-stat admin-sponsoring-stat-active">
                <span class="admin-sponsoring-stat-icon" aria-hidden="true">✓</span>
                <div>
                    <span class="admin-sponsoring-stat-value">{{ number_format($stats['active']) }}</span>
                    <span class="admin-sponsoring-stat-label">Actifs</span>
                </div>
            </article>
            <article class="admin-sponsoring-stat">
                <span class="admin-sponsoring-stat-icon" aria-hidden="true">⌁</span>
                <div>
                    <span class="admin-sponsoring-stat-value">{{ number_format($stats['expired']) }}</span>
                    <span class="admin-sponsoring-stat-label">Expirés</span>
                </div>
            </article>
        </section>

        <section class="admin-sponsoring-toolbar" aria-label="Filtres de demandes">
            <span class="admin-sponsoring-toolbar-title">Toutes les demandes</span>
            <form method="GET" class="admin-sponsoring-filter">
                <label for="status">Filtrer par statut</label>
                <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                    <option value="">Tous les statuts</option>
                    @foreach (['pending' => 'À vérifier', 'active' => 'Actifs', 'expired' => 'Expirés'] as $value => $label)
                        <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </form>
        </section>

        <section class="admin-sponsoring-section" aria-labelledby="individual-sponsorings-title">
            <div class="admin-sponsoring-section-heading">
                <h2 id="individual-sponsorings-title">Demandes unitaires</h2>
                <span class="admin-sponsoring-section-count">{{ $sponsorings->total() }} au total</span>
            </div>

            @if ($sponsorings->isEmpty())
                <div class="admin-sponsoring-empty">Aucune demande unitaire pour ce filtre.</div>
            @else
                <div class="admin-sponsoring-list">
                    @foreach ($sponsorings as $sponsoring)
                        <article class="admin-sponsoring-card {{ $sponsoring->status === 'pending' ? 'admin-sponsoring-card-pending' : '' }}">
                            <div class="admin-sponsoring-card-main">
                                <div class="admin-sponsoring-card-heading">
                                    <span class="admin-sponsoring-reference">{{ $sponsoring->reference }}</span>
                                    <span class="admin-sponsoring-status admin-sponsoring-status-{{ $sponsoring->status }}">
                                        {{ ['pending' => 'À vérifier', 'active' => 'Actif', 'expired' => 'Expiré'][$sponsoring->status] }}
                                    </span>
                                </div>
                                <div class="admin-sponsoring-meta">
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Produit</span>
                                        <span class="admin-sponsoring-meta-value">{{ $sponsoring->product->nom }}</span>
                                    </div>
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Partenaire</span>
                                        <span class="admin-sponsoring-meta-value">{{ $sponsoring->user->name ?? 'Compte supprimé' }}</span>
                                    </div>
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Téléphone</span>
                                        <span class="admin-sponsoring-meta-value">{{ $sponsoring->partner_phone ?: 'Non renseigné' }}</span>
                                    </div>
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Durée</span>
                                        <span class="admin-sponsoring-meta-value">{{ $sponsoring->duration_days }} jours</span>
                                    </div>
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Expiration</span>
                                        <span class="admin-sponsoring-meta-value">{{ $sponsoring->expires_at ? $sponsoring->expires_at->format('d/m/Y H:i') : 'Après validation' }}</span>
                                    </div>
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Montant</span>
                                        <span class="admin-sponsoring-amount">{{ number_format($sponsoring->amount, 0, ',', ' ') }} FCFA</span>
                                    </div>
                                </div>
                            </div>
                            @if ($sponsoring->status === 'pending')
                                <form method="POST" action="{{ route('admin.sponsorings.activate', $sponsoring) }}">
                                    @csrf
                                    <button type="submit" class="admin-sponsoring-activate">
                                        Vérifier le reçu<br>et activer
                                    </button>
                                </form>
                            @endif
                        </article>
                    @endforeach
                </div>
                <div class="admin-sponsoring-pagination">{{ $sponsorings->links('pagination::bootstrap-4') }}</div>
            @endif
        </section>

        <section class="admin-sponsoring-section" aria-labelledby="campaign-sponsorings-title">
            <div class="admin-sponsoring-section-heading">
                <h2 id="campaign-sponsorings-title">Campagnes et packs partenaires</h2>
                <span class="admin-sponsoring-section-count">{{ $campaigns->total() }} au total</span>
            </div>

            @if ($campaigns->isEmpty())
                <div class="admin-sponsoring-empty">Aucune campagne partenaire pour ce filtre.</div>
            @else
                <div class="admin-sponsoring-list">
                    @foreach ($campaigns as $campaign)
                        <article class="admin-sponsoring-card {{ $campaign->status === 'pending' ? 'admin-sponsoring-card-pending' : '' }}">
                            <div class="admin-sponsoring-card-main">
                                <div class="admin-sponsoring-card-heading">
                                    <span class="admin-sponsoring-reference">{{ $campaign->reference }}</span>
                                    <span class="admin-sponsoring-plan">{{ $campaign->plan_name }}</span>
                                    <span class="admin-sponsoring-status admin-sponsoring-status-{{ $campaign->status }}">
                                        {{ ['pending' => 'À vérifier', 'active' => 'Actif', 'expired' => 'Expiré'][$campaign->status] }}
                                    </span>
                                </div>
                                <div class="admin-sponsoring-meta">
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Partenaire</span>
                                        <span class="admin-sponsoring-meta-value">{{ $campaign->user->name ?? 'Compte supprimé' }}</span>
                                    </div>
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Produits sélectionnés</span>
                                        <span class="admin-sponsoring-meta-value">{{ $campaign->products->pluck('nom')->join(', ') ?: 'Aucun produit disponible' }}</span>
                                    </div>
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Téléphone</span>
                                        <span class="admin-sponsoring-meta-value">{{ $campaign->partner_phone ?: 'Non renseigné' }}</span>
                                    </div>
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Durée</span>
                                        <span class="admin-sponsoring-meta-value">{{ $campaign->duration_days }} jours</span>
                                    </div>
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Période</span>
                                        <span class="admin-sponsoring-meta-value">
                                            {{ $campaign->starts_at ? $campaign->starts_at->format('d/m/Y') . ' – ' . $campaign->expires_at->format('d/m/Y') : 'Après validation' }}
                                        </span>
                                    </div>
                                    <div class="admin-sponsoring-meta-item">
                                        <span class="admin-sponsoring-meta-label">Montant</span>
                                        <span class="admin-sponsoring-amount">{{ number_format($campaign->amount, 0, ',', ' ') }} FCFA</span>
                                    </div>
                                </div>
                            </div>
                            @if ($campaign->status === 'pending' && $campaign->products->isNotEmpty())
                                <form method="POST" action="{{ route('admin.sponsoring-campaigns.activate', $campaign) }}">
                                    @csrf
                                    <button type="submit" class="admin-sponsoring-activate">
                                        Vérifier le reçu<br>et activer le pack
                                    </button>
                                </form>
                            @endif
                        </article>
                    @endforeach
                </div>
                <div class="admin-sponsoring-pagination">{{ $campaigns->links('pagination::bootstrap-4') }}</div>
            @endif
        </section>
    </div>
@endsection
