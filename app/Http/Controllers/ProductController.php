<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
{
  public function index()
  {
    $products = Product::all();
    return view('admin.products.index', compact('products'));
  }

  public function create()
  {
    $categories = Category::all();
    $tags = Tag::all();
    return view('admin.products.create', compact('categories', 'tags'));
  }
  public function store(Request $request)
  {
    // Valider les données du formulaire
    $validatedData = $request->validate([
      'nom' => 'required|max:255',
      'description' => 'required',
      'prix' => 'required|numeric',
      'quantite' => 'required|numeric',
      'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Valider chaque image
      'categorie_id' => 'required|exists:categories,id',
      'tags' => 'nullable|array',
      'tags.*' => 'exists:tags,id'
    ]);

    // Créer un nouveau produit avec les données du formulaire
    $product = new Product;
    $product->nom = $validatedData['nom'];
    $product->description = $validatedData['description'];
    $product->prix = $validatedData['prix'];
    $product->quantite = $validatedData['quantite'];
    $product->categorie_id = $validatedData['categorie_id'];
    $product->slug = Str::slug($validatedData['nom']);

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
    // Enregistrer les tags liés au produit
    if (isset($validatedData['tags'])) {
      $product->tags()->attach($validatedData['tags']);
    }
    // Enregistrer le produit dans la base de données
    $product->save();

    return redirect()->route('admin.products.index', ['product' => $product->id]);
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

    return view('admin.products.edit', compact('product', 'categories', 'tags', 'productTags'));
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
      'tags.*' => 'exists:tags,id',
    ]);

    // Mettre à jour les propriétés du produit avec les données validées
    $product->nom = $validatedData['nom'];
    $product->description = $validatedData['description'];
    $product->prix = $validatedData['prix'];
    $product->quantite = $validatedData['quantite'];
    $product->categorie_id = $validatedData['categorie_id'];

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
    if (isset($validatedData['tags'])) {
      $product->tags()->sync($validatedData['tags']);
    } else {
      // Si aucun tag n'est sélectionné, supprimer tous les tags existants
      $product->tags()->detach();
    }

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
    $product = Product::where('slug', $slug)->first();
    $categories = Category::with('parent')->get();
    $parents = Category::pluck('name', 'id')->prepend('None', '');

    return view('product', compact('product', 'categories'));
  }
}
