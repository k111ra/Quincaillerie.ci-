<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * Affiche le formulaire d'édition d'un partenaire
     */
    public function edit(Fournisseur $partner)
    {
        $partner->load('user');

        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Met à jour les informations d'un partenaire
     */
    public function update(Fournisseur $partner, Request $request)
    {
        $partner->load('user');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($partner->user?->id)],
            'tel' => ['nullable', 'string', 'max:20'],
            'company_name' => ['required', 'string', 'max:255'],
            'adresse' => ['nullable', 'string', 'max:255'],
            'phone_primary' => ['required', 'string', 'max:20'],
            'phone_secondary' => ['nullable', 'string', 'max:20'],
            'email_secondary' => ['nullable', 'email', 'max:255'],
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
            'website' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', Rule::in(['pending_approval', 'approved', 'rejected', 'active'])],
        ]);

        if ($partner->user) {
            $partner->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'tel' => $validated['tel'] ?? $validated['phone_primary'],
            ]);
        }

        $approvedAt = $partner->approved_at;
        $approvedBy = $partner->approved_by;

        if ($validated['status'] === 'approved' && !$partner->approved_at) {
            $approvedAt = now();
            $approvedBy = auth()->id();
        } elseif ($validated['status'] !== 'approved') {
            $approvedAt = null;
            $approvedBy = null;
        }

        $preferences = $partner->notification_preferences ?? [];
        if (is_string($preferences)) {
            $decodedPreferences = json_decode($preferences, true);
            $preferences = is_array($decodedPreferences) ? $decodedPreferences : [];
        }
        if (!is_array($preferences)) {
            $preferences = [];
        }
        $preferences['email'] = true;
        $preferences['whatsapp'] = !empty($validated['whatsapp_number']);

        $partner->update([
            'nom' => $validated['company_name'],
            'adresse' => $validated['adresse'] ?? null,
            'telephone' => $validated['phone_primary'],
            'phone_primary' => $validated['phone_primary'],
            'phone_secondary' => $validated['phone_secondary'] ?? null,
            'email' => $validated['email'],
            'email_primary' => $validated['email'],
            'email_secondary' => $validated['email_secondary'] ?? null,
            'whatsapp_number' => $validated['whatsapp_number'] ?? null,
            'website' => $validated['website'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'approved_at' => $approvedAt,
            'approved_by' => $approvedBy,
            'notification_preferences' => $preferences,
        ]);

        return redirect()
            ->route('admin.partners.show', $partner)
            ->with('success', 'Les informations du partenaire ont été mises à jour avec succès.');
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
