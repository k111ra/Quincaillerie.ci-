<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurControlleur extends Controller
{
  public function index()
  {
    return view('fournisseurs.index');
  }

  public function store(Request $request)
  {
    // Valider la requête
    $request->validate([
      'nom' => 'required|string|max:255',
      'adresse' => 'required|string|max:255',
      'telephone' => 'required|string|max:20',
      'email' => 'required|string|email|max:255|unique:fournisseurs,email',
      'logo' => 'nullable|image|max:2048',
    ]);

    try {
      $fournisseur = new Fournisseur();

      $fournisseur->nom = $request->input('nom');
      $fournisseur->adresse = $request->input('adresse');
      $fournisseur->telephone = $request->input('telephone');
      $fournisseur->email = $request->input('email');
      if ($request->hasFile('logo')) {
        $fournisseur->logo = $request->file('logo')->store('logos', 'public');
      }

      $fournisseur->save();

      return redirect()->back()->with('success', 'Fournisseur ajouté avec succès.');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement du fournisseur. Veuillez réessayer.']);
    }
  }
}
