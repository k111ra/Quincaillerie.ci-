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
      'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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

    // Stocker l'image si elle existe
    if ($request->hasFile('image')) {
      $path = $request->file('image')->store('public/images/product');
      $product->image = str_replace('public/', '', $path);
    }

    // Enregistrer le produit dans la base de données
    $product->save();

    // Enregistrer les tags liés au produit
    if (isset($validatedData['tags'])) {
      $product->tags()->attach($validatedData['tags']);
    }

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
          'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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

      // Mettre à jour l'image si elle existe
      if ($request->hasFile('image')) {
          $path = $request->file('image')->store('public/images/product');
          $product->image = str_replace('public/', '', $path);
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
}
