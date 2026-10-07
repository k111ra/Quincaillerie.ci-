@extends('layouts.layout')

@section('title', 'Confirmation du sponsoring')

@section('content')
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="h3 mb-4">Sponsoriser un produit</h1>
                        <p class="text-muted">Votre demande est enregistrée. Effectuez le paiement Wave, puis envoyez la
                            capture du reçu à notre équipe pour validation manuelle.</p>

                        <dl class="row mb-4">
                            <dt class="col-sm-5">Produit</dt>
                            <dd class="col-sm-7">{{ $sponsoring->product->nom }}</dd>

                            <dt class="col-sm-5">Référence</dt>
                            <dd class="col-sm-7"><strong>{{ $sponsoring->reference }}</strong></dd>

                            <dt class="col-sm-5">Montant</dt>
                            <dd class="col-sm-7">{{ number_format($sponsoring->amount, 0, ',', ' ') }} FCFA</dd>

                            <dt class="col-sm-5">Durée</dt>
                            <dd class="col-sm-7">{{ $sponsoring->duration_days }} jours à partir de la validation</dd>

                            <dt class="col-sm-5">Statut</dt>
                            <dd class="col-sm-7"><span class="badge badge-warning">En attente du paiement</span></dd>
                        </dl>

                        <a class="btn btn-primary btn-lg btn-block mb-3" href="{{ $wavePaymentUrl }}" target="_blank"
                            rel="noopener noreferrer">
                            Payer {{ number_format($sponsoring->amount, 0, ',', ' ') }} FCFA avec Wave
                        </a>

                        @php
                            $whatsappMessage = "Bonjour, j'ai validé mon paiement Wave de 2 000 FCFA pour le sponsoring (Réf: {$sponsoring->reference}). Voici la capture du reçu.";
                        @endphp
                        <a class="btn btn-success btn-block"
                            href="https://wa.me/2250594775690?text={{ urlencode($whatsappMessage) }}" target="_blank"
                            rel="noopener noreferrer">
                            Envoyer la preuve sur WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
