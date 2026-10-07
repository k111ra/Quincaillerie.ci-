<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSponsoring;
use App\Models\SponsoringCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PartnerSponsoringController extends Controller
{
    private const WAVE_PAYMENT_BASE_URL = 'https://pay.wave.com/m/M_ci_UlNcTCk9-MiY/c/ci/';

    private const PLANS = [
        'flash' => [
            'name' => 'Flash Découverte',
            'type' => 'unit',
            'amount' => 2000,
            'duration_days' => 5,
            'max_products' => 1,
            'tagline' => 'Le ticket d’entrée idéal',
            'details' => [
                'Épinglage en tête de catégorie',
                'Une diffusion sur un statut WhatsApp commercial',
                'Visibilité pendant 5 jours',
            ],
        ],
        'week' => [
            'name' => 'Pass Semaine Chantier',
            'type' => 'unit',
            'amount' => 3000,
            'duration_days' => 7,
            'max_products' => 1,
            'tagline' => 'Une semaine de visibilité ciblée',
            'details' => [
                'Épinglage prioritaire pendant 7 jours',
                'Deux diffusions WhatsApp (mercredi et samedi)',
            ],
        ],
        'shock' => [
            'name' => 'Produit Choc / Déstockage',
            'type' => 'unit',
            'amount' => 5000,
            'duration_days' => 10,
            'max_products' => 1,
            'tagline' => 'Pour accélérer une vente ou un déstockage',
            'details' => [
                'Badge « Offre Choc » et épinglage prioritaire',
                'Mise en avant dans les devis entrants',
                'Visibilité pendant 10 jours',
            ],
        ],
        'monthly-reseller' => [
            'name' => 'Petit Revendeur / Artisan',
            'type' => 'monthly',
            'amount' => 10000,
            'duration_days' => 30,
            'max_products' => 2,
            'tagline' => 'Quincailleries de quartier, revendeurs indépendants et artisans',
            'details' => [
                'Jusqu’à 2 produits sponsorisés simultanément pendant 30 jours',
                'Quatre diffusions WhatsApp par mois',
                'Badge « Vendeur Recommandé »',
            ],
        ],
        'monthly-pro' => [
            'name' => 'Boost Ventes Pro',
            'type' => 'monthly',
            'amount' => 25000,
            'duration_days' => 30,
            'max_products' => 5,
            'tagline' => 'Distributeurs d’outillage, plomberie, peinture et carrelage',
            'details' => [
                'Jusqu’à 5 produits sponsorisés simultanément',
                'Présence dans la section « Offres populaires » de l’accueil',
                'Diffusion hebdomadaire sur Facebook et LinkedIn',
            ],
        ],
        'monthly-major' => [
            'name' => 'Partenaire Majeur / Gros Œuvre',
            'type' => 'monthly',
            'amount' => 65000,
            'duration_days' => 30,
            'max_products' => 15,
            'tagline' => 'Usines, importateurs directs, fer, ciment et carrières',
            'details' => [
                'Jusqu’à 15 produits sponsorisés simultanément',
                'Grande bannière d’en-tête',
                'Intégration prioritaire aux proformas de gros chantiers',
            ],
        ],
    ];

    public function index(Request $request)
    {
        $partner = $request->user()->partner;
        if (!$partner) {
            return redirect()->route('partner.dashboard')
                ->with('error', 'Profil partenaire non trouvé.');
        }

        $products = Product::where('fournisseur_id', $partner->id)
            ->orderBy('nom')
            ->get(['id', 'nom']);

        $campaigns = SponsoringCampaign::with('products:id,nom')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('partner.sponsoring.index', [
            'plans' => self::PLANS,
            'clientPlans' => collect(self::PLANS)->map(function ($plan, $code) {
                return [
                    'code' => $code,
                    'name' => $plan['name'],
                    'amount' => number_format($plan['amount'], 0, ',', ' '),
                    'maxProducts' => $plan['max_products'],
                ];
            })->values(),
            'products' => $products,
            'campaigns' => $campaigns,
        ]);
    }

    public function store(Request $request)
    {
        $planData = $request->validate([
            'plan_code' => ['required', Rule::in(array_keys(self::PLANS))],
        ]);
        $plan = self::PLANS[$planData['plan_code']];

        $validated = Validator::make($request->all(), [
            'plan_code' => ['required', Rule::in(array_keys(self::PLANS))],
            'products' => ['required', 'array', 'min:1', 'max:' . $plan['max_products']],
            'products.*' => ['required', 'integer', 'distinct', 'exists:products,id'],
            'partner_phone' => ['nullable', 'string', 'max:30'],
        ])->validate();

        $partner = $request->user()->partner;
        if (!$partner) {
            return redirect()->route('partner.dashboard')
                ->with('error', 'Profil partenaire non trouvé.');
        }

        $selectedProducts = Product::where('fournisseur_id', $partner->id)
            ->whereIn('id', $validated['products'])
            ->get();

        if ($selectedProducts->count() !== count($validated['products'])) {
            throw ValidationException::withMessages([
                'products' => 'Sélectionnez uniquement des produits de votre catalogue partenaire.',
            ]);
        }

        do {
            $reference = 'SPON-' . Str::upper(Str::random(6));
        } while (
            ProductSponsoring::where('reference', $reference)->exists()
            || SponsoringCampaign::where('reference', $reference)->exists()
        );

        $campaign = DB::transaction(function () use ($request, $validated, $plan, $reference, $selectedProducts) {
            $campaign = SponsoringCampaign::create([
                'reference' => $reference,
                'plan_code' => $validated['plan_code'],
                'plan_name' => $plan['name'],
                'user_id' => $request->user()->id,
                'partner_phone' => $validated['partner_phone'] ?? null,
                'amount' => $plan['amount'],
                'duration_days' => $plan['duration_days'],
                'status' => 'pending',
            ]);

            $campaign->products()->attach($selectedProducts->modelKeys());

            return $campaign;
        });

        return redirect()->route('partner.sponsoring.confirmation', $campaign->reference);
    }

    public function confirmation(Request $request, string $reference)
    {
        $campaign = SponsoringCampaign::with('products:id,nom')
            ->where('reference', $reference)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return view('partner.sponsoring.confirmation', [
            'campaign' => $campaign,
            'wavePaymentUrl' => self::WAVE_PAYMENT_BASE_URL . '?amount=' . (int) $campaign->amount,
        ]);
    }
}
