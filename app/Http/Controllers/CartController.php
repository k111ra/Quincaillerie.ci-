<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
  // public function showCart()
  // {
  //   // Votre logique pour récupérer les catégories
  //   $categories = Category::with('parent')->get();
  //   $parents = Category::pluck('name', 'id')->prepend('None', '');



  //   // Passez les variables à la vue
  //   return view('cart.show', compact('categories', 'parents'));
  // }

  public function showCart()
  {
    $categories = Category::with('parent')->get();
    $parents = Category::pluck('name', 'id')->prepend('None', '');
    $products = Product::all();
    $cart = session()->get('cart', []);
    $cartTotal = 0;

    foreach ($cart as $details) {
      $cartTotal += $details['price'] * $details['quantity'];
    }

    session()->put('cart_total', $cartTotal);
    return view('cart.show', compact('cart', 'categories', 'parents', 'products'));
  }
  public function addToCart(Request $request)
  {
    $product = Product::find($request->product_id);

    if (!$product) {
      return redirect()->back()->with('error', 'Produit non trouvé.');
    }

    // Récupérer le panier de la session ou initialiser un nouveau tableau
    $cart = session()->get('cart', []);

    // Si le produit est déjà dans le panier, on augmente la quantité
    if (isset($cart[$product->id])) {
      $cart[$product->id]['quantity'] += $request->quantity ?? 1;
    } else {
      // Décoder les images JSON en tableau
      $images = json_decode($product->images, true);

      // Ajouter le produit avec les champs corrects pour 'nom' et 'prix'
      $cart[$product->id] = [
        "nom" => $product->nom, // S'assurer que 'nom' est bien récupéré
        "quantity" => $request->quantity ?? 1, // Quantité par défaut 1 si non spécifiée
        "price" => $product->prix, // S'assurer que 'prix' est bien récupéré
        "image" => isset($images[0]) ? $images[0] : 'images/default-image.png' // Défaut si aucune image n'existe
      ];
    }

    // Calculer le total du panier
    $total = 0;
    foreach ($cart as $item) {
      $total += $item['price'] * $item['quantity'];
    }

    // Mettre à jour le panier et le total dans la session
    session()->put('cart', $cart);
    session()->put('cart_total', $total);

    // Redirection avec un message de succès
    return redirect()->back()->with('success', 'Produit ajouté au panier avec succès !');
  }



  public function remove($id)
  {
    // Votre logique pour supprimer un produit du panier
    $cart = session()->get('cart', []);

    // Recherchez l'index du produit dans le panier
    $productIndex = array_search($id, array_column($cart, 'id'));

    // Supprimez le produit s'il est trouvé
    if ($productIndex !== false) {
      unset($cart[$productIndex]);
    }

    // Mettez à jour la session avec le panier modifié
    session()->put('cart', $cart);

    // Redirigez l'utilisateur vers la page du panier ou une autre page
    return redirect()->route('cart.show')->with('success', 'Produit supprimé du panier');
  }

  public function update(Request $request)
  {
    $productId = $request->input('productId');
    $quantity = $request->input('quantity');

    // Récupérez le panier actuel depuis la session
    $cart = $request->session()->get('cart', []);

    // Mettez à jour la quantité du produit dans le panier
    if (isset($cart[$productId])) {
      $cart[$productId]['quantity'] = $quantity;
    }

    // Mettez à jour la session avec le panier modifié
    $request->session()->put('cart', $cart);

    // Redirigez l'utilisateur vers la page du panier avec un message de succès
    return redirect()->route('cart')->with('success', 'Panier mis à jour avec succès');
  }

  // Méthode pour vider le panier
  public function clear()
  {
    session()->forget('cart');
    session()->forget('cart_total');

    return redirect()->route('cart')->with('success', 'Panier vidé avec succès !');
  }
}
