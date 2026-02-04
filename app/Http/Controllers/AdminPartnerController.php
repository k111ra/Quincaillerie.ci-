<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPartnerController extends Controller
{
    /**
     * Affiche la liste de tous les partenaires
     */
    public function index()
    {
        $partners = Fournisseur::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Affiche les partenaires en attente d'approbation
     */
    public function pending()
    {
        $partners = Fournisseur::where('status', 'pending_approval')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.partners.pending', compact('partners'));
    }

    /**
     * Affiche les partenaires approuvés
     */
    public function approved()
    {
        $partners = Fournisseur::where('status', 'approved')
            ->with('user')
            ->orderBy('approved_at', 'desc')
            ->paginate(15);

        return view('admin.partners.approved', compact('partners'));
    }

    /**
     * Affiche les détails d'un partenaire
     */
    public function show(Fournisseur $partner)
    {
        $partner->load('user');
        return view('admin.partners.show', compact('partner'));
    }

    /**
     * Approuve un partenaire
     */
    public function approve(Fournisseur $partner)
    {
        $partner->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        // Envoyer email de confirmation (Phase 4)
        // Mail::send(new PartnerApprovedMail($partner));

        return redirect()
            ->route('admin.partners.show', $partner)
            ->with('success', 'Partenaire approuvé avec succès!');
    }

    /**
     * Rejette un partenaire
     */
    public function reject(Fournisseur $partner, Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $partner->update([
            'status' => 'rejected',
        ]);

        // Envoyer email de rejet avec raison (Phase 4)
        // Mail::send(new PartnerRejectedMail($partner, $request->reason));

        return redirect()
            ->route('admin.partners.show', $partner)
            ->with('success', 'Partenaire rejeté. Email de notification envoyé.');
    }

    /**
     * Supprime un partenaire
     */
    public function destroy(Fournisseur $partner)
    {
        // Soft delete
        $partner->delete();

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partenaire supprimé avec succès!');
    }

    /**
     * Restaure un partenaire supprimé
     */
    public function restore($id)
    {
        $partner = Fournisseur::withTrashed()->findOrFail($id);
        $partner->restore();

        return redirect()
            ->route('admin.partners.show', $partner)
            ->with('success', 'Partenaire restauré avec succès!');
    }
}
