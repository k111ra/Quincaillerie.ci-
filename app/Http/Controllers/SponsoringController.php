<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSponsoring;
use Illuminate\Http\Request;

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
            ->when($validated['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.sponsorings.index', compact('sponsorings'));
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
}
