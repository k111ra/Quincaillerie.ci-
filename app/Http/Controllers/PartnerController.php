<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\User;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    /**
     * Affiche le formulaire d'enregistrement partenaire
     */
    public function showRegisterForm()
    {
        return view('partner.register');
    }

    /**
     * Enregistre un nouveau partenaire (fournisseur)
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company_name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:20'],
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:1000'],
            'website' => ['nullable', 'url', 'max:255'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Créer l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tel' => $request->telephone,
                'user_type' => 'partner',
            ]);

            // Créer le profil fournisseur
            $fournisseur = Fournisseur::create([
                'user_id' => $user->id,
                'nom' => $request->company_name,
                'telephone' => $request->telephone,
                'phone_primary' => $request->telephone,
                'whatsapp_number' => $request->whatsapp_number,
                'email' => $request->email,
                'email_primary' => $request->email,
                'description' => $request->description,
                'website' => $request->website,
                'status' => 'pending_approval',
                'notification_preferences' => json_encode([
                    'email' => true,
                    'whatsapp' => !empty($request->whatsapp_number),
                ]),
            ]);

            // Assigner le rôle 'partner'
            $user->assignRole('partner');

            // Lier l'utilisateur au fournisseur
            $user->update(['fournisseur_id' => $fournisseur->id]);

            return redirect()->route('index')
                ->with('success', 'Inscription réussie! Nous examinons votre profil et vous confirmerons bientôt par email.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.');
        }
    }

    /**
     * Affiche le dashboard du partenaire
     */
    public function dashboard()
    {
        $user = auth()->user();

        // Vérifier que l'utilisateur est un partenaire
        if ($user->user_type !== 'partner' && !$user->hasRole('partner')) {
            return redirect()->route('index')->with('error', 'Accès non autorisé.');
        }

        // Récupérer le profil fournisseur de l'utilisateur
        $fournisseur = $user->partner;

        if (!$fournisseur) {
            return redirect()->route('index')->with('error', 'Profil partenaire non trouvé.');
        }

        // Charger les offres du partenaire
        $offers = Service::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Charger les produits du partenaire (via relation fournisseur)
        $products = Product::where('fournisseur_id', $fournisseur->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistiques
        $stats = [
            'total_offers' => $offers->count(),
            'approved_offers' => $offers->where('status', 'approved')->count(),
            'pending_offers' => $offers->where('status', 'pending_approval')->count(),
            'rejected_offers' => $offers->where('status', 'rejected')->count(),
            'total_products' => $products->count(),
        ];

        return view('partner.dashboard', compact('fournisseur', 'user', 'offers', 'products', 'stats'));
    }
}
