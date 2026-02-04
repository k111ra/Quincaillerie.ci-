<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class AdminOfferController extends Controller
{
    public function index()
    {
        $offers = Service::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.offers.index', compact('offers'));
    }

    public function pending()
    {
        $offers = Service::where('status', 'pending_approval')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.offers.pending', compact('offers'));
    }

    public function approved()
    {
        $offers = Service::where('status', 'approved')
            ->with('user')
            ->orderBy('approved_at', 'desc')
            ->paginate(15);

        return view('admin.offers.approved', compact('offers'));
    }

    public function show(Service $offer)
    {
        $offer->load('user');
        return view('admin.offers.show', compact('offer'));
    }

    public function approve(Service $offer)
    {
        $offer->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.offers.show', $offer)
            ->with('success', 'Offre approuvée avec succès!');
    }

    public function reject(Service $offer, Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $offer->update([
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('admin.offers.show', $offer)
            ->with('success', 'Offre rejetée.');
    }

    public function destroy(Service $offer)
    {
        $offer->delete();

        return redirect()
            ->route('admin.offers.index')
            ->with('success', 'Offre supprimée avec succès!');
    }
}
