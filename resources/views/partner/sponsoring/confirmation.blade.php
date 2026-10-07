@extends('layouts.layout')

@section('title', 'Paiement du sponsoring')

@section('content')
    <link rel="stylesheet"
        href="{{ asset('front/assets/css/partner-sponsoring.css') }}?v={{ filemtime(public_path('front/assets/css/partner-sponsoring.css')) }}">

    <main class="partner-sponsoring">
        <div class="sponsoring-container sponsoring-confirmation-wrap">
            <section class="sponsoring-confirmation">
                <span class="sponsoring-confirmation-icon" aria-hidden="true">✓</span>
                <span class="sponsoring-eyebrow">DEMANDE ENREGISTRÉE</span>
                <h1>Il ne reste qu’à régler votre offre</h1>
                <p>Votre campagne sera activée après vérification manuelle du reçu par notre équipe.</p>

                <dl class="sponsoring-summary">
                    <div><dt>Référence</dt><dd>{{ $campaign->reference }}</dd></div>
                    <div><dt>Offre</dt><dd>{{ $campaign->plan_name }}</dd></div>
                    <div><dt>Produits choisis</dt><dd>{{ $campaign->products->pluck('nom')->join(', ') }}</dd></div>
                    <div><dt>Durée</dt><dd>{{ $campaign->duration_days }} jours après validation</dd></div>
                    <div><dt>À payer</dt><dd class="sponsoring-summary-amount">{{ number_format($campaign->amount, 0, ',', ' ') }} FCFA</dd></div>
                </dl>

                <a class="sponsoring-wave-button" href="{{ $wavePaymentUrl }}" target="_blank" rel="noopener noreferrer">
                    Payer {{ number_format($campaign->amount, 0, ',', ' ') }} FCFA avec Wave
                </a>

                @php
                    $receiptMessage = "Bonjour, je viens de payer l'offre {$campaign->plan_name} de " .
                        number_format($campaign->amount, 0, ',', ' ') .
                        " FCFA (Réf: {$campaign->reference}). Voici la capture de mon reçu Wave.";
                @endphp
                <a class="sponsoring-receipt-button"
                    href="https://wa.me/2250747104513?text={{ urlencode($receiptMessage) }}" target="_blank"
                    rel="noopener noreferrer">
                    Envoyer le reçu sur WhatsApp
                </a>
                <p class="sponsoring-confirmation-note">Joignez la capture de votre reçu dans WhatsApp. La campagne reste en attente jusqu’à la validation par l’équipe Quincaillerie.ci.</p>
                <a class="sponsoring-back-link" href="{{ route('partner.sponsoring.index') }}">Retour aux offres et à mes campagnes</a>
            </section>
        </div>
    </main>
@endsection
