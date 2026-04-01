<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Fournisseur;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
{
  public function index(Request $request)
  {
    // Initialiser la requête de base pour les produits
    $query = Product::query();

    // Filtrer par recherche si un terme est fourni
    if ($request->has('search') && $request->input('search') != '') {
      $query->where('nom', 'like', '%' . $request->input('search') . '%');
    }

    // Filtrer par catégorie si sélectionnée
    if ($request->has('categorie_id') && $request->input('categorie_id') != '') {
      $query->where('categorie_id', $request->input('categorie_id'));
    }

    // Filtrer par fournisseur si sélectionné
    if ($request->has('fournisseur_id') && $request->input('fournisseur_id') != '') {
      $query->where('fournisseur_id', $request->input('fournisseur_id'));
    }

    // Tri des résultats
    $sort = $request->input('sort', 'recent');
    switch ($sort) {
      case 'ancien':
        $query->orderBy('id', 'asc');
        break;
      case 'nom_asc':
        $query->orderBy('nom', 'asc');
        break;
      case 'nom_desc':
        $query->orderBy('nom', 'desc');
        break;
      case 'prix_asc':
        $query->orderBy('prix', 'asc');
        break;
      case 'prix_desc':
        $query->orderBy('prix', 'desc');
        break;
      case 'recent':
      default:
        $query->orderBy('id', 'desc');
        break;
    }

    // Récupérer les catégories et fournisseurs pour les filtres
    $categories = Category::all();
    $fournisseurs = Fournisseur::all();

    // Pagination des résultats (par exemple, 15 produits par page)
    $products = $query->paginate(15);

    return view('admin.products.index', compact('products', 'categories', 'fournisseurs'));
  }



  public function create()
  {
    $categories = Category::all();
    $tags = Tag::all();
    $fournisseurs = Fournisseur::all();
    $parents = Category::pluck('name', 'id')->prepend('None', '');
    return view('admin.products.create', compact('categories', 'tags', 'fournisseurs', 'parents'));
  }
  public function store(Request $request)
  {
    $request->validate([
      'nom' => 'required|max:255',
      'description' => 'required',
      'prix' => 'required|numeric',
      'quantite' => 'required|numeric',
      'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'categorie_id' => 'required|exists:categories,id',
      'tags' => 'nullable|array',
      'tags.*' => 'exists:tags,id',
      'fournisseur_id' => 'required|exists:fournisseurs,id',
    ]);

    // Utilisation d'un bloc try-catch pour gérer les erreurs
    try {
      // Créer un nouveau produit avec les données du formulaire
      $product = new Product;
      $product->nom = $request->nom;
      $product->description = $request->description;
      $product->prix = $request->prix;
      $product->quantite = $request->quantite;
      $product->categorie_id = $request->categorie_id;
      $product->slug = Str::slug($request->nom);
      $product->fournisseur_id = $request->fournisseur_id;

      // Stocker les images si elles existent
      $imagePaths = [];
      if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
          // Stocker chaque image et ajouter le chemin dans le tableau
          $path = $image->store('public/images/product');
          $imagePaths[] = str_replace('public/', '', $path);
        }
      }

      // Enregistrer les chemins des images dans la colonne "images" en tant que JSON
      $product->images = json_encode($imagePaths);

      // Enregistrer le produit dans la base de données
      $product->save();

      // Enregistrer les tags liés au produit
      if (isset($request['tags'])) {
        $product->tags()->attach($request['tags']);
      }


      // Rediriger avec un message de succès
      return redirect()->route('admin.products.index', ['product' => $product->id])
        ->with('success', 'Produit créé avec succès.');
    } catch (\Exception $e) {
      // En cas d'erreur, rediriger avec un message d'erreur
      return redirect()->back()->with('error', 'Erreur lors de la création du produit : ' . $e->getMessage());
    }
  }




  public function show(Product $product)
  {
    return view('admin.products.show', compact('product'));
  }

  public function edit($id)
  {
    $product = Product::findOrFail($id);
    $categories = Category::all();
    $tags = Tag::all();
    $productTags = $product->tags->pluck('id')->toArray();
    $fournisseurs = Fournisseur::all();

    return view('admin.products.edit', compact('product', 'categories', 'tags', 'productTags', 'fournisseurs'));
  }


  public function update(Request $request, Product $product)
  {
    // Valider les données du formulaire
    $validatedData = $request->validate([
      'nom' => 'required|max:255',
      'description' => 'required',
      'prix' => 'required|numeric',
      'quantite' => 'required|numeric',
      'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Valider plusieurs images
      'categorie_id' => 'required|exists:categories,id',
      'tags' => 'nullable|array',
      'tags.*' => 'string', // Permet les tags non numériques pour les nouveaux tags
      'fournisseur_id' => 'required|exists:fournisseurs,id',
    ]);

    // Mettre à jour les propriétés du produit avec les données validées
    $product->nom = $validatedData['nom'];
    $product->description = $validatedData['description'];
    $product->prix = $validatedData['prix'];
    $product->quantite = $validatedData['quantite'];
    $product->categorie_id = $validatedData['categorie_id'];
    $product->fournisseur_id = $validatedData['fournisseur_id'];

    // Traitement des nouvelles images
    if ($request->hasFile('images')) {
      $images = [];

      // Supprimer les anciennes images du stockage
      if ($product->images) {
        foreach (json_decode($product->images) as $image) {
          Storage::delete('public/' . $image);
        }
      }

      // Stocker chaque nouvelle image
      foreach ($request->file('images') as $imageFile) {
        $path = $imageFile->store('public/images/product');
        $images[] = str_replace('public/', '', $path); // Enregistrer le chemin de l'image sans le préfixe 'public/'
      }

      // Mettre à jour le champ 'images' en JSON
      $product->images = json_encode($images);
    }

    // Enregistrer les modifications dans la base de données
    $product->save();

    // Mettre à jour les tags liés au produit
    $tagIds = [];
    if (isset($validatedData['tags'])) {
      foreach ($validatedData['tags'] as $tag) {
        if (is_numeric($tag)) {
          // Tag existant
          $tagIds[] = $tag;
        } else {
          // Nouveau tag, on le crée
          $newTag = Tag::firstOrCreate(['name' => $tag]);
          $tagIds[] = $newTag->id;
        }
      }
    }

    // Synchroniser les tags avec le produit
    $product->tags()->sync($tagIds);

    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
  }


  public function destroy($id)
  {
    // Recherche du produit à supprimer
    $product = Product::findOrFail($id);

    // Suppression des relations avec les tags
    $product->tags()->detach();

    // Suppression du produit
    $product->delete();

    // Redirection vers la liste des produits avec un message flash
    return redirect()->route('admin.products.index')->with('success', 'Le produit a été supprimé.');
  }

  public function singleProduct($slug)
  {
    $product = Product::where('slug', $slug)->firstOrFail();
    $categories = Category::with('parent')->get();
    $parents = Category::pluck('name', 'id')->prepend('None', '');

    return view('product', compact('product', 'categories'));
  }

  /**
   * Affiche les produits du partenaire connecté
   */
  public function partnerIndex()
  {
    $user = auth()->user();
    $fournisseur = $user->partner;

    if (!$fournisseur) {
      return redirect()->route('partner.dashboard')->with('error', 'Profil partenaire non trouvé.');
    }

    $products = Product::where('fournisseur_id', $fournisseur->id)
      ->orderBy('created_at', 'desc')
      ->paginate(15);

    return view('partner.products.index', compact('products'));
  }

  /**
   * Affiche le formulaire de création de produit pour le partenaire
   */
  public function partnerCreate()
  {
    $categories = Category::all();
    $tags = Tag::all();

    return view('partner.products.create', compact('categories', 'tags'));
  }

  /**
   * Enregistre un nouveau produit pour le partenaire
   */
  public function partnerStore(Request $request)
  {
    $user = auth()->user();
    $fournisseur = $user->partner;

    if (!$fournisseur) {
      return redirect()->route('partner.dashboard')->with('error', 'Profil partenaire non trouvé.');
    }

    $request->validate([
      'nom' => 'required|max:255',
      'description' => 'required',
      'prix' => 'required|numeric',
      'quantite' => 'required|numeric',
      'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'categorie_id' => 'required|exists:categories,id',
      'tags' => 'nullable|array',
      'tags.*' => 'exists:tags,id',
    ]);

    try {
      $product = new Product;
      $product->nom = $request->nom;
      $product->description = $request->description;
      $product->prix = $request->prix;
      $product->quantite = $request->quantite;
      $product->categorie_id = $request->categorie_id;
      $product->slug = Str::slug($request->nom);
      $product->fournisseur_id = $fournisseur->id;

      // Traitement des images
      $imagePaths = [];
      if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
          $path = $image->store('public/images/product');
          $imagePaths[] = str_replace('public/', '', $path);
        }
      }

      $product->images = json_encode($imagePaths);
      $product->save();

      // Ajouter les tags
      if ($request->has('tags')) {
        $product->tags()->attach($request->tags);
      }

      return redirect()->route('products.index')
        ->with('success', 'Produit créé avec succès.');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Erreur lors de la création du produit : ' . $e->getMessage());
    }
  }

  /**
   * Affiche le formulaire d'édition de produit pour le partenaire
   */
  public function partnerEdit(Product $product)
  {
    $user = auth()->user();
    $fournisseur = $user->partner;

    // Vérifier que le produit appartient au partenaire
    if ($product->fournisseur_id !== $fournisseur->id) {
      return redirect()->route('products.index')->with('error', 'Accès non autorisé.');
    }

    $categories = Category::all();
    $tags = Tag::all();
    $productTags = $product->tags->pluck('id')->toArray();

    return view('partner.products.edit', compact('product', 'categories', 'tags', 'productTags'));
  }

  /**
   * Met à jour un produit du partenaire
   */
  public function partnerUpdate(Request $request, Product $product)
  {
    $user = auth()->user();
    $fournisseur = $user->partner;

    // Vérifier que le produit appartient au partenaire
    if ($product->fournisseur_id !== $fournisseur->id) {
      return redirect()->route('products.index')->with('error', 'Accès non autorisé.');
    }

    $request->validate([
      'nom' => 'required|max:255',
      'description' => 'required',
      'prix' => 'required|numeric',
      'quantite' => 'required|numeric',
      'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'categorie_id' => 'required|exists:categories,id',
      'tags' => 'nullable|array',
      'tags.*' => 'exists:tags,id',
    ]);

    try {
      $product->nom = $request->nom;
      $product->description = $request->description;
      $product->prix = $request->prix;
      $product->quantite = $request->quantite;
      $product->categorie_id = $request->categorie_id;
      $product->slug = Str::slug($request->nom);

      // Traitement des images
      if ($request->hasFile('images')) {
        // Supprimer les anciennes images
        if ($product->images) {
          foreach (json_decode($product->images) as $image) {
            Storage::delete('public/' . $image);
          }
        }

        $imagePaths = [];
        foreach ($request->file('images') as $image) {
          $path = $image->store('public/images/product');
          $imagePaths[] = str_replace('public/', '', $path);
        }

        $product->images = json_encode($imagePaths);
      }

      $product->save();

      // Mettre à jour les tags
      if ($request->has('tags')) {
        $product->tags()->sync($request->tags);
      } else {
        $product->tags()->detach();
      }

      return redirect()->route('products.index')
        ->with('success', 'Produit mis à jour avec succès.');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
    }
  }

  /**
   * Supprime un produit du partenaire
   */
  public function partnerDestroy(Product $product)
  {
    $user = auth()->user();
    $fournisseur = $user->partner;

    // Vérifier que le produit appartient au partenaire
    if ($product->fournisseur_id !== $fournisseur->id) {
      return redirect()->route('products.index')->with('error', 'Accès non autorisé.');
    }

    try {
      // Supprimer les images
      if ($product->images) {
        foreach (json_decode($product->images) as $image) {
          Storage::delete('public/' . $image);
        }
      }

      // Détacher les tags
      $product->tags()->detach();

      // Supprimer le produit
      $product->delete();

      return redirect()->route('products.index')
        ->with('success', 'Produit supprimé avec succès.');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
    }
  }

  /**
   * Affiche le formulaire d'import des produits
   */
  public function showImportForm()
  {
    $categories = Category::all();
    $fournisseurs = Fournisseur::all();
    $tags = Tag::all();
    return view('admin.products.import', compact('categories', 'fournisseurs', 'tags'));
  }

  /**
   * Importe les produits à partir d'un fichier CSV
   */
  public function importProducts(Request $request)
  {
    $request->validate([
      'csv_file' => 'required|file|mimes:csv,txt|max:5120',
      'categorie_id' => 'required|exists:categories,id',
      'fournisseur_id' => 'required|exists:fournisseurs,id',
    ]);

    try {
      $file = $request->file('csv_file');
      $path = $file->getRealPath();
      $csv = array_map('str_getcsv', file($path));

      // Vérifier que le CSV a un header
      if (empty($csv)) {
        return redirect()->back()->with('error', 'Le fichier CSV est vide.');
      }

      // Extraire le header (première ligne)
      $header = array_shift($csv);

      // Créer un mapping des colonnes
      $headerMap = array_flip($header);

      $imported = 0;
      $errors = [];

      foreach ($csv as $index => $row) {
        try {
          // Vérifier que la ligne n'est pas vide
          if (empty(array_filter($row))) {
            continue;
          }

          // Créer un tableau associatif avec le header
          $data = array_combine($header, $row);

          // Validation des données requises
          if (!isset($data['nom']) || empty($data['nom'])) {
            $errors[] = "Ligne " . ($index + 2) . ": Le nom du produit est requis.";
            continue;
          }

          if (!isset($data['prix']) || empty($data['prix'])) {
            $errors[] = "Ligne " . ($index + 2) . ": Le prix est requis.";
            continue;
          }

          // Créer le produit
          $product = new Product();
          $product->nom = trim($data['nom']);
          $product->description = isset($data['description']) ? trim($data['description']) : '';
          $product->prix = floatval($data['prix']);
          $product->quantite = isset($data['quantite']) ? intval($data['quantite']) : 0;
          $product->categorie_id = $request->categorie_id;
          $product->fournisseur_id = $request->fournisseur_id;
          $product->slug = Str::slug($product->nom);
          $product->images = json_encode([]);

          $product->save();
          $imported++;
        } catch (\Exception $e) {
          $errors[] = "Ligne " . ($index + 2) . ": " . $e->getMessage();
        }
      }

      $message = "$imported produit(s) importé(s) avec succès.";
      if (!empty($errors)) {
        $message .= " " . count($errors) . " erreur(s) détectées.";
      }

      return redirect()->route('admin.products.index')
        ->with('success', $message)
        ->with('errors', $errors);
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Erreur lors de l\'import : ' . $e->getMessage());
    }
  }

  /**
   * Export des produits en CSV
   */
  public function exportProducts()
  {
    $products = Product::with('category', 'fournisseur')->get();

    $headers = array(
      'Content-Type' => 'text/csv; charset=utf-8',
      'Content-Disposition' => 'attachment; filename=produits_' . date('Y-m-d_H-i-s') . '.csv'
    );

    $callback = function () use ($products) {
      $file = fopen('php://output', 'w');

      // Header du CSV
      fputcsv($file, ['nom', 'description', 'prix', 'quantite', 'categorie', 'fournisseur']);

      // Données
      foreach ($products as $product) {
        fputcsv($file, [
          $product->nom,
          $product->description,
          $product->prix,
          $product->quantite,
          $product->category ? $product->category->name : '',
          $product->fournisseur ? $product->fournisseur->nom : ''
        ]);
      }

      fclose($file);
    };

    return response()->stream($callback, 200, $headers);
  }
}
