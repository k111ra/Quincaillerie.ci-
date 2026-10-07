<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSponsoring;
use App\Models\SponsoringCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SponsoringController extends Controller
{
    private const AMOUNT = 2000;
    private const DURATION_DAYS = 5;
    private const WAVE_PAYMENT_URL = 'https://pay.wave.com/m/M_ci_UlNcTCk9-MiY/c/ci/?amount=2000';

    public function initiate(Request $request, Product $product)
    {
        $validated = $request->validate([
            'partner_phone' => ['nullable', 'string', 'max:30'],
        ]);

        $sponsoring = ProductSponsoring::create([
            'reference' => ProductSponsoring::generateReference(),
            'product_id' => $product->id,
            'user_id' => $request->user()->id,
            'partner_phone' => $validated['partner_phone'] ?? null,
            'amount' => self::AMOUNT,
            'duration_days' => self::DURATION_DAYS,
            'status' => 'pending',
        ]);

        return redirect()->route('sponsoring.confirmation', $sponsoring->reference);
    }

    public function confirmation(string $reference)
    {
        $sponsoring = ProductSponsoring::with('product')
            ->where('reference', $reference)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('sponsoring.confirmation', [
            'sponsoring' => $sponsoring,
            'wavePaymentUrl' => self::WAVE_PAYMENT_URL,
        ]);
    }

    public function adminIndex(Request $request)
    {
        $validated = $request->validate([
            'status' => ['nullable', 'in:pending,active,expired'],
        ]);

        $sponsorings = ProductSponsoring::with([
            'product:id,nom,slug',
            'user:id,name,email',
        ])
            ->whereNull('campaign_id')
            ->when($validated['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $campaigns = SponsoringCampaign::with([
            'products:id,nom',
            'user:id,name,email',
        ])
            ->when($validated['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(20, ['*'], 'campaign_page')
            ->withQueryString();

        $individualStats = ProductSponsoring::whereNull('campaign_id')
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');
        $campaignStats = SponsoringCampaign::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $stats = [
            'pending' => (int) ($individualStats['pending'] ?? 0) + (int) ($campaignStats['pending'] ?? 0),
            'active' => (int) ($individualStats['active'] ?? 0) + (int) ($campaignStats['active'] ?? 0),
            'expired' => (int) ($individualStats['expired'] ?? 0) + (int) ($campaignStats['expired'] ?? 0),
        ];

        return view('admin.sponsorings.index', compact('sponsorings', 'campaigns', 'stats'));
    }

    public function adminActivate(ProductSponsoring $sponsoring)
    {
        if ($sponsoring->status !== 'pending') {
            return redirect()->route('admin.sponsorings.index')
                ->with('error', 'Seules les demandes en attente peuvent être activées.');
        }

        $startsAt = now();
        $sponsoring->update([
            'status' => 'active',
            'starts_at' => $startsAt,
            'expires_at' => $startsAt->copy()->addDays($sponsoring->duration_days),
        ]);

        return redirect()->route('admin.sponsorings.index')
            ->with('success', 'Le sponsoring a été activé.');
    }

    public function adminActivateCampaign(SponsoringCampaign $campaign)
    {
        $error = DB::transaction(function () use ($campaign) {
            $campaign = SponsoringCampaign::whereKey($campaign->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($campaign->status !== 'pending') {
                return 'Seules les campagnes en attente peuvent être activées.';
            }

            $products = $campaign->products;
            if ($products->isEmpty()) {
                return 'Cette campagne ne contient plus de produit à sponsoriser.';
            }

            $startsAt = now();
            $expiresAt = $startsAt->copy()->addDays($campaign->duration_days);

            $campaign->update([
                'status' => 'active',
                'starts_at' => $startsAt,
                'expires_at' => $expiresAt,
            ]);

            foreach ($products as $product) {
                ProductSponsoring::create([
                    'reference' => $this->generateUniqueReference(),
                    'product_id' => $product->id,
                    'user_id' => $campaign->user_id,
                    'campaign_id' => $campaign->id,
                    'partner_phone' => $campaign->partner_phone,
                    'amount' => 0,
                    'duration_days' => $campaign->duration_days,
                    'status' => 'active',
                    'starts_at' => $startsAt,
                    'expires_at' => $expiresAt,
                ]);
            }

            return null;
        });

        if ($error) {
            return redirect()->route('admin.sponsorings.index')->with('error', $error);
        }

        return redirect()->route('admin.sponsorings.index')
            ->with('success', 'La campagne a été validée et ses produits sont maintenant sponsorisés.');
    }

    private function generateUniqueReference(): string
    {
        do {
            $reference = 'SPON-' . Str::upper(Str::random(6));
        } while (
            ProductSponsoring::where('reference', $reference)->exists()
            || SponsoringCampaign::where('reference', $reference)->exists()
        );

        return $reference;
    }
}
