<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\User;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PartnerController extends Controller
{
  /**
   * Affiche la page d'information pour devenir partenaire
   */
  public function showInfo()
  {
    return view('partner.info');
  }

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
      'website' => ['nullable', 'max:255'],
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
        'notification_preferences' => [
          'email' => true,
          'whatsapp' => !empty($request->whatsapp_number),
        ],
      ]);

      // Assigner le rôle 'partner'
      $user->assignRole('partner');

      // Lier l'utilisateur au fournisseur
      $user->update(['fournisseur_id' => $fournisseur->id]);

      // Connecter automatiquement l'utilisateur
      Auth::login($user);

      return redirect()->route('partner.dashboard')
        ->with('success', 'Bienvenue ! Votre compte partenaire a été créé avec succès. Nous examinons votre profil et vous confirmerons bientôt par email.');
    } catch (\Exception $e) {
      Log::error('Partner registration error: ' . $e->getMessage(), ['exception' => $e]);
      return back()->withInput()
        ->with('error', 'Une erreur est survenue lors de l\'inscription: ' . $e->getMessage());
    }
  }

  /**
   * Affiche le dashboard du partenaire
   */
  public function dashboard()
  {
    /** @var \App\Models\User $user */
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

  /**
   * Met à jour le profil du partenaire connecté
   */
  public function updateProfile(Request $request)
  {
    /** @var \App\Models\User $user */
    $user = auth()->user();

    if ($user->user_type !== 'partner' && !$user->hasRole('partner')) {
      return redirect()->route('index')->with('error', 'Accès non autorisé.');
    }

    $fournisseur = $user->partner;

    if (!$fournisseur) {
      return redirect()->route('index')->with('error', 'Profil partenaire non trouvé.');
    }

    $validated = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
      'company_name' => ['required', 'string', 'max:255'],
      'telephone' => ['required', 'string', 'max:20'],
      'phone_secondary' => ['nullable', 'string', 'max:20'],
      'adresse' => ['nullable', 'string', 'max:255'],
      'whatsapp_number' => ['nullable', 'string', 'max:20'],
      'website' => ['nullable', 'string', 'max:255'],
      'description' => ['nullable', 'string', 'max:1000'],
    ]);

    $user->update([
      'name' => $validated['name'],
      'email' => $validated['email'],
      'tel' => $validated['telephone'],
    ]);

    $preferences = $fournisseur->notification_preferences ?? [];
    if (is_string($preferences)) {
      $decodedPreferences = json_decode($preferences, true);
      $preferences = is_array($decodedPreferences) ? $decodedPreferences : [];
    }
    if (!is_array($preferences)) {
      $preferences = [];
    }
    $preferences['email'] = true;
    $preferences['whatsapp'] = !empty($validated['whatsapp_number']);

    $requiresReview = in_array($fournisseur->status, ['approved', 'active', 'rejected'], true);

    $fournisseur->update([
      'nom' => $validated['company_name'],
      'adresse' => $validated['adresse'] ?? null,
      'telephone' => $validated['telephone'],
      'phone_primary' => $validated['telephone'],
      'phone_secondary' => $validated['phone_secondary'] ?? null,
      'email' => $validated['email'],
      'email_primary' => $validated['email'],
      'whatsapp_number' => $validated['whatsapp_number'] ?? null,
      'website' => $validated['website'] ?? null,
      'description' => $validated['description'] ?? null,
      'status' => $requiresReview ? 'pending_approval' : $fournisseur->status,
      'approved_at' => $requiresReview ? null : $fournisseur->approved_at,
      'approved_by' => $requiresReview ? null : $fournisseur->approved_by,
      'notification_preferences' => $preferences,
    ]);

    $message = $requiresReview
      ? 'Vos informations ont été mises à jour. Votre profil est maintenant en attente de validation par un administrateur.'
      : 'Vos informations ont été mises à jour avec succès.';

    return redirect()->route('partner.dashboard')->with('success', $message);
  }
}
