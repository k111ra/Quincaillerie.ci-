@extends('layouts.layout')

@section('title', 'Sponsoring de produits')

@section('content')
    <link rel="stylesheet"
        href="{{ asset('front/assets/css/partner-sponsoring.css') }}?v={{ filemtime(public_path('front/assets/css/partner-sponsoring.css')) }}">

    <main class="partner-sponsoring">
        @if ($errors->any())
            <div class="sponsoring-container sponsoring-error-summary" role="alert">
                <strong>Vérifiez les informations de votre demande :</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="sponsoring-hero">
            <div class="sponsoring-container">
                <span class="sponsoring-eyebrow">ESPACE PARTENAIRE</span>
                <h1>Faites remarquer vos produits</h1>
                <p>Gagnez en visibilité auprès des acheteurs, artisans et professionnels du BTP.</p>
                <a class="sponsoring-hero-link" href="#sponsoring-offers">Découvrir les offres <span aria-hidden="true">↓</span></a>
            </div>
        </section>

        <div class="sponsoring-container sponsoring-content">
            <section class="sponsoring-explainer" aria-labelledby="sponsoring-benefits-title">
                <div class="sponsoring-section-heading">
                    <span class="sponsoring-eyebrow">VISIBILITÉ QUI COMPTE</span>
                    <h2 id="sponsoring-benefits-title">Ce qu’implique la sponsorisation</h2>
                    <p>Votre produit est mis en avant pendant la durée de l’offre choisie.</p>
                </div>

                <div class="sponsoring-benefits">
                    <article class="sponsoring-benefit">
                        <span class="sponsoring-benefit-icon">↟</span>
                        <h3>Positionnement prioritaire</h3>
                        <p>Votre produit remonte en tête de sa catégorie et bénéficie d’un badge distinctif dans le catalogue.</p>
                    </article>
                    <article class="sponsoring-benefit">
                        <span class="sponsoring-benefit-icon">◉</span>
                        <h3>Diffusion locale</h3>
                        <p>Selon la formule, nos équipes relaient votre offre sur les statuts WhatsApp commerciaux et nos réseaux.</p>
                    </article>
                    <article class="sponsoring-benefit">
                        <span class="sponsoring-benefit-icon">▤</span>
                        <h3>Visibilité auprès des pros</h3>
                        <p>Les offres concernées peuvent être mises en avant lors du traitement des demandes de devis BTP.</p>
                    </article>
                    <article class="sponsoring-benefit">
                        <span class="sponsoring-benefit-icon">☎</span>
                        <h3>Contact direct</h3>
                        <p>Les acheteurs intéressés peuvent consulter la fiche et contacter votre entreprise directement.</p>
                    </article>
                    <article class="sponsoring-benefit sponsoring-benefit-wide">
                        <span class="sponsoring-benefit-icon">✓</span>
                        <h3>Vos ventes vous appartiennent</h3>
                        <p>Aucune commission supplémentaire n’est prélevée sur les ventes réalisées grâce à la visibilité sponsorisée.</p>
                    </article>
                </div>
            </section>

            <section id="sponsoring-offers" class="sponsoring-offers" aria-labelledby="sponsoring-offers-title">
                <div class="sponsoring-section-heading">
                    <span class="sponsoring-eyebrow">À LA CARTE</span>
                    <h2 id="sponsoring-offers-title">Choisissez votre formule</h2>
                    <p>Une offre unitaire pour tester, ou un pack mensuel pour installer votre visibilité.</p>
                </div>

                <h3 class="sponsoring-group-title">Offres unitaires</h3>
                <div class="sponsoring-plan-grid sponsoring-plan-grid-three">
                    @foreach ($plans as $code => $plan)
                        @continue($plan['type'] !== 'unit')
                        <article class="sponsoring-plan-card">
                            <div class="sponsoring-plan-topline">
                                <span>{{ $plan['duration_days'] }} jours</span>
                                @if ($code === 'flash')
                                    <span class="sponsoring-plan-label">Pour commencer</span>
                                @elseif ($code === 'shock')
                                    <span class="sponsoring-plan-label sponsoring-plan-label-orange">Offre Choc</span>
                                @endif
                            </div>
                            <h4>{{ $plan['name'] }}</h4>
                            <p class="sponsoring-plan-tagline">{{ $plan['tagline'] }}</p>
                            <p class="sponsoring-price">{{ number_format($plan['amount'], 0, ',', ' ') }} <small>FCFA</small></p>
                            <ul class="sponsoring-plan-details">
                                @foreach ($plan['details'] as $detail)
                                    <li><span aria-hidden="true">✓</span> {{ $detail }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="sponsoring-select-plan" data-plan-code="{{ $code }}">
                                Sélectionner cette offre
                            </button>
                        </article>
                    @endforeach
                </div>

                <h3 class="sponsoring-group-title sponsoring-monthly-title">Packs mensuels</h3>
                <div class="sponsoring-plan-grid sponsoring-plan-grid-three">
                    @foreach ($plans as $code => $plan)
                        @continue($plan['type'] !== 'monthly')
                        <article class="sponsoring-plan-card {{ $code === 'monthly-reseller' ? 'sponsoring-plan-popular' : '' }}">
                            @if ($code === 'monthly-reseller')
                                <span class="sponsoring-popular-ribbon">LE PLUS POPULAIRE</span>
                            @endif
                            <div class="sponsoring-plan-topline">
                                <span>30 jours</span>
                                <span class="sponsoring-plan-label">Jusqu’à {{ $plan['max_products'] }} produit(s)</span>
                            </div>
                            <h4>{{ $plan['name'] }}</h4>
                            <p class="sponsoring-plan-tagline">{{ $plan['tagline'] }}</p>
                            <p class="sponsoring-price">{{ number_format($plan['amount'], 0, ',', ' ') }} <small>FCFA / mois</small></p>
                            @if ($code === 'monthly-reseller')
                                <p class="sponsoring-daily-rate">Environ 330 FCFA par jour</p>
                            @endif
                            <ul class="sponsoring-plan-details">
                                @foreach ($plan['details'] as $detail)
                                    <li><span aria-hidden="true">✓</span> {{ $detail }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="sponsoring-select-plan" data-plan-code="{{ $code }}">
                                Sélectionner ce pack
                            </button>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="sponsoring-how-it-works">
                <div>
                    <span class="sponsoring-eyebrow">SIMPLE ET TRANSPARENT</span>
                    <h2>Comment ça marche ?</h2>
                </div>
                <ol>
                    <li><span>1</span> Choisissez une formule et vos produits.</li>
                    <li><span>2</span> Réglez le montant affiché sur Wave.</li>
                    <li><span>3</span> Envoyez le reçu par WhatsApp avec votre référence.</li>
                    <li><span>4</span> Après vérification, l’équipe active votre campagne.</li>
                </ol>
                <p class="sponsoring-manual-note">La preuve de paiement est vérifiée manuellement. Les diffusions prévues par votre offre sont ensuite coordonnées par notre équipe commerciale.</p>
            </section>

            <section class="sponsoring-history">
                <div class="sponsoring-section-heading">
                    <span class="sponsoring-eyebrow">VOTRE ACTIVITÉ</span>
                    <h2>Mes demandes de sponsoring</h2>
                </div>
                @if ($campaigns->isEmpty())
                    <p class="sponsoring-empty">Vos campagnes et leur statut apparaîtront ici après votre première demande.</p>
                @else
                    <div class="sponsoring-table-wrap">
                        <table class="sponsoring-table">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Offre</th>
                                    <th>Produits</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                    <th>Période</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campaigns as $campaign)
                                    <tr>
                                        <td>{{ $campaign->reference }}</td>
                                        <td>{{ $campaign->plan_name }}</td>
                                        <td>{{ $campaign->products->pluck('nom')->join(', ') ?: 'Produit supprimé' }}</td>
                                        <td>{{ number_format($campaign->amount, 0, ',', ' ') }} FCFA</td>
                                        <td><span class="sponsoring-status sponsoring-status-{{ $campaign->status }}">
                                                {{ ['pending' => 'En attente du reçu', 'active' => 'Actif', 'expired' => 'Expiré'][$campaign->status] }}
                                            </span></td>
                                        <td>{{ $campaign->starts_at ? $campaign->starts_at->format('d/m/Y') . ' – ' . $campaign->expires_at->format('d/m/Y') : 'Après validation' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $campaigns->links('pagination::bootstrap-4') }}
                @endif
            </section>
        </div>

        <a class="sponsoring-whatsapp-help"
            href="https://wa.me/2250747104513?text={{ urlencode('Bonjour, je souhaite des informations sur les offres de sponsoring de produits.') }}"
            target="_blank" rel="noopener noreferrer">
            <span aria-hidden="true">☏</span><span>Discuter avec un conseiller commercial</span>
        </a>
    </main>

    <dialog class="sponsoring-modal" id="sponsoring-product-modal" aria-labelledby="sponsoring-modal-title">
        <form method="POST" action="{{ route('partner.sponsoring.store') }}" id="sponsoring-purchase-form">
            @csrf
            <input type="hidden" name="plan_code" id="sponsoring-plan-code">
            <div class="sponsoring-modal-header">
                <div>
                    <span class="sponsoring-eyebrow">VOTRE SÉLECTION</span>
                    <h2 id="sponsoring-modal-title">Choisir les produits</h2>
                </div>
                <button type="button" class="sponsoring-modal-close" data-close-sponsoring-modal aria-label="Fermer">×</button>
            </div>
            <p id="sponsoring-modal-plan" class="sponsoring-modal-plan"></p>
            @if ($products->isEmpty())
                <div class="sponsoring-no-products">
                    Vous n’avez pas encore de produit dans votre catalogue.
                    <a href="{{ route('products.create') }}">Ajouter un produit</a>
                </div>
            @else
                <label for="sponsoring-products">Produits à mettre en avant</label>
                <select id="sponsoring-products" name="products[]" multiple required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->nom }}</option>
                    @endforeach
                </select>
                <p id="sponsoring-product-count" class="sponsoring-field-hint">Sélectionnez un produit.</p>
                @error('products')
                    <p class="sponsoring-form-error">{{ $message }}</p>
                @enderror
                <label for="sponsoring-phone">Téléphone WhatsApp du vendeur (facultatif)</label>
                <input type="tel" id="sponsoring-phone" name="partner_phone" maxlength="30"
                    value="{{ old('partner_phone') }}" placeholder="+225 07 00 00 00 00">
                @error('partner_phone')
                    <p class="sponsoring-form-error">{{ $message }}</p>
                @enderror
                <div class="sponsoring-modal-actions">
                    <button type="button" class="sponsoring-modal-cancel" data-close-sponsoring-modal>Annuler</button>
                    <button type="submit" class="sponsoring-modal-submit" id="sponsoring-submit" disabled>Continuer vers Wave</button>
                </div>
            @endif
        </form>
    </dialog>

    <script>
        (() => {
            const plans = @json($clientPlans);
            const modal = document.getElementById('sponsoring-product-modal');
            const productSelect = document.getElementById('sponsoring-products');
            const submit = document.getElementById('sponsoring-submit');
            const countHint = document.getElementById('sponsoring-product-count');
            const hiddenPlan = document.getElementById('sponsoring-plan-code');
            let maxProducts = 1;

            document.querySelectorAll('.sponsoring-select-plan').forEach((button) => {
                button.addEventListener('click', () => {
                    const plan = plans.find((item) => item.code === button.dataset.planCode);
                    if (!plan || !modal) return;
                    hiddenPlan.value = plan.code;
                    maxProducts = plan.maxProducts;
                    document.getElementById('sponsoring-modal-title').textContent = plan.name;
                    document.getElementById('sponsoring-modal-plan').textContent =
                        `${plan.amount} FCFA · sélectionnez jusqu’à ${maxProducts} produit(s)`;
                    if (productSelect) {
                        Array.from(productSelect.options).forEach((option) => {
                            option.selected = false;
                            option.disabled = false;
                        });
                        updateSelection();
                    }
                    modal.showModal();
                });
            });

            function updateSelection() {
                if (!productSelect) return;
                const selected = Array.from(productSelect.selectedOptions);
                Array.from(productSelect.options).forEach((option) => {
                    option.disabled = selected.length >= maxProducts && !option.selected;
                });
                countHint.textContent = ` ${selected.length} produit(s) sélectionné(s) sur ${maxProducts} maximum.`;
                submit.disabled = selected.length === 0;
            }

            productSelect?.addEventListener('change', updateSelection);
            modal?.querySelectorAll('[data-close-sponsoring-modal]').forEach((button) => {
                button.addEventListener('click', () => modal.close());
            });
            modal?.addEventListener('click', (event) => {
                if (event.target === modal) modal.close();
            });

            @if ($errors->any() && old('plan_code'))
                const previousPlan = plans.find((item) => item.code === @json(old('plan_code')));
                if (previousPlan && modal) {
                    hiddenPlan.value = previousPlan.code;
                    maxProducts = previousPlan.maxProducts;
                    document.getElementById('sponsoring-modal-title').textContent = previousPlan.name;
                    document.getElementById('sponsoring-modal-plan').textContent =
                        `${previousPlan.amount} FCFA · sélectionnez jusqu’à ${maxProducts} produit(s)`;
                    if (productSelect) {
                        const previousProducts = @json(old('products', []));
                        Array.from(productSelect.options).forEach((option) => {
                            option.selected = previousProducts.map(String).includes(option.value);
                        });
                        updateSelection();
                    }
                    modal.showModal();
                }
            @endif
        })();
    </script>
@endsection
