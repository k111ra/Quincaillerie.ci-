@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Cotation ' . ($cotation->quote_number ?? '#' . $cotation->id) . ' - Administration')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">
                <a href="{{ route('admin.cotations.index') }}" class="text-muted"><i class="bx bx-arrow-back"></i></a>
                Cotation {{ $cotation->quote_number ?? '#' . $cotation->id }}
                <span class="badge bg-label-primary">{{ \App\Models\QuoteRequest::statusLabels()[$cotation->status] ?? $cotation->status }}</span>
            </h4>
            <div>
                @if ($cotation->supplier_doc_path)
                    <a href="{{ route('admin.cotations.download-supplier', $cotation) }}" class="btn btn-outline-danger">
                        <i class="bx bx-download"></i> Doc fournisseurs (interne)
                    </a>
                @endif
                @if ($cotation->client_pdf_path)
                    <a href="{{ route('admin.cotations.download-client', $cotation) }}" class="btn btn-outline-primary">
                        <i class="bx bx-download"></i> Devis client (PDF)
                    </a>
                @endif
            </div>
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

        <div class="row">
            {{-- Email d'origine --}}
            <div class="col-md-5">
                <div class="card mb-4">
                    <div class="card-header"><strong><i class="bx bx-envelope"></i> Email reçu</strong></div>
                    <div class="card-body">
                        <p class="mb-1"><strong>De :</strong> {{ $cotation->from_name }} &lt;{{ $cotation->from_email }}&gt;</p>
                        <p class="mb-1"><strong>Sujet :</strong> {{ $cotation->subject }}</p>
                        <p class="mb-1"><strong>Reçu le :</strong> {{ optional($cotation->received_at)->format('d/m/Y H:i') }}</p>
                        <p class="mb-3"><strong>Score de détection :</strong> {{ $cotation->detection_score }}/100
                            — <strong>Extraction :</strong> {{ $cotation->extraction_method ?? '—' }}</p>
                        <div class="border rounded p-3 bg-lighter" style="max-height: 300px; overflow-y: auto; white-space: pre-wrap; font-size: 0.85rem;">{{ $cotation->body }}</div>
                    </div>
                </div>

                @if ($cotation->error_message)
                    <div class="alert alert-danger">
                        <strong>Erreur de traitement :</strong> {{ $cotation->error_message }}
                    </div>
                @endif
            </div>

            {{-- Produits + prix --}}
            <div class="col-md-7">
                <form method="POST" action="{{ route('admin.cotations.update', $cotation) }}">
                    @csrf
                    @method('PUT')
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong><i class="bx bx-package"></i> Produits demandés</strong>
                            <small class="text-muted">Marge appliquée : +{{ config('cotation.margin_percent') }}% (invisible pour le client)</small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th style="width:90px">Qté</th>
                                        <th style="width:100px">Unité</th>
                                        <th style="width:130px">Prix achat (F)</th>
                                        <th style="width:130px">Prix vente (F)</th>
                                        <th style="width:60px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cotation->items as $item)
                                        <tr>
                                            <td>
                                                {{ $item->product_name_raw }}
                                                @if ($item->fournisseur)
                                                    <br><small class="text-success"><i class="bx bx-store"></i>
                                                        {{ $item->fournisseur->nom }}
                                                        @if ($item->fournisseur->telephone ?? $item->fournisseur->phone_primary)
                                                            — {{ $item->fournisseur->telephone ?? $item->fournisseur->phone_primary }}
                                                        @endif
                                                    </small>
                                                @else
                                                    <br><small class="text-warning"><i class="bx bx-error"></i> Aucun fournisseur trouvé</small>
                                                @endif
                                                @if (!empty($itemsData[$item->id]['web_links']))
                                                    <br><small>
                                                        Chercher :
                                                        @foreach ($itemsData[$item->id]['web_links'] as $label => $url)
                                                            <a href="{{ $url }}" target="_blank" rel="noopener">{{ $label }}</a>@if (!$loop->last) · @endif
                                                        @endforeach
                                                    </small>
                                                @endif
                                            </td>
                                            <td><input type="number" step="0.01" name="items[{{ $item->id }}][quantity]"
                                                    value="{{ $item->quantity }}" class="form-control form-control-sm"></td>
                                            <td><input type="text" name="items[{{ $item->id }}][unit]"
                                                    value="{{ $item->unit }}" class="form-control form-control-sm"></td>
                                            <td><input type="number" step="1" name="items[{{ $item->id }}][purchase_price]"
                                                    value="{{ $item->purchase_price }}" class="form-control form-control-sm"
                                                    placeholder="À saisir"></td>
                                            <td><input type="number" step="1" name="items[{{ $item->id }}][selling_price]"
                                                    value="{{ $item->selling_price }}" class="form-control form-control-sm"
                                                    placeholder="Auto +{{ config('cotation.margin_percent') }}%"></td>
                                            <td>
                                                <button type="submit" form="remove-item-{{ $item->id }}"
                                                    class="btn btn-sm btn-outline-danger" title="Supprimer"
                                                    onclick="return confirm('Supprimer ce produit ?')">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-end">Total devis client :</th>
                                        <th colspan="2">{{ number_format($cotation->total(), 0, ',', ' ') }} FCFA</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-body">
                            <label class="form-label"><strong>Message d'accompagnement (email au client)</strong></label>
                            <textarea name="client_message" rows="6" class="form-control">{{ $cotation->client_message }}</textarea>
                            <small class="text-muted">Laissez vide pour utiliser le message par défaut. Astuce : si vous saisissez un prix d'achat sans prix de vente, la marge de {{ config('cotation.margin_percent') }}% est appliquée automatiquement.</small>
                        </div>
                        <div class="card-body pt-0 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save"></i> Enregistrer et régénérer les documents
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Formulaires de suppression de ligne (hors du formulaire principal) --}}
                @foreach ($cotation->items as $item)
                    <form id="remove-item-{{ $item->id }}" method="POST"
                        action="{{ route('admin.cotations.items.remove', [$cotation, $item]) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach

                {{-- Ajout manuel d'un produit --}}
                <div class="card mb-4">
                    <div class="card-header"><strong><i class="bx bx-plus"></i> Ajouter un produit</strong></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.cotations.items.add', $cotation) }}" class="row g-2">
                            @csrf
                            <div class="col-md-6">
                                <input type="text" name="product_name_raw" class="form-control" placeholder="Nom du produit" required>
                            </div>
                            <div class="col-md-2">
                                <input type="number" step="0.01" name="quantity" class="form-control" placeholder="Qté" value="1" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="unit" class="form-control" placeholder="Unité" value="unité">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-outline-primary w-100">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Actions finales --}}
                <div class="card">
                    <div class="card-body d-flex gap-2">
                        @if ($cotation->status !== \App\Models\QuoteRequest::STATUS_ENVOYE)
                            <form method="POST" action="{{ route('admin.cotations.send', $cotation) }}">
                                @csrf
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirm('Envoyer le devis à {{ $cotation->from_email }} ?')"
                                    @if (!$cotation->isReadyToSend()) disabled @endif>
                                    <i class="bx bx-send"></i> Valider et envoyer le devis au client
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.cotations.reject', $cotation) }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark"
                                    onclick="return confirm('Rejeter cette demande ?')">
                                    Rejeter
                                </button>
                            </form>
                        @else
                            <div class="alert alert-success mb-0 w-100">
                                <i class="bx bx-check-circle"></i> Devis envoyé le {{ optional($cotation->sent_at)->format('d/m/Y à H:i') }}
                                à {{ $cotation->from_email }}.
                            </div>
                        @endif
                    </div>
                    @if (!$cotation->isReadyToSend() && $cotation->status !== \App\Models\QuoteRequest::STATUS_ENVOYE)
                        <div class="card-body pt-0">
                            <small class="text-warning"><i class="bx bx-info-circle"></i>
                                L'envoi sera possible quand chaque produit aura un prix de vente et que le statut sera « Prêt à envoyer ».</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
