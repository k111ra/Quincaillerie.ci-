<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
  public function showCart(Request $request)
  {
    $categories = Category::with('parent')->get();
    $parents = Category::pluck('name', 'id')->prepend('None', '');

    // Get the current cart from the session
    $cart = $request->session()->get('cart', []);

    // Get the details of products in the cart
    $cartDetails = [];
    foreach ($cart as $productId => $quantity) {
      $product = Product::find($productId);
      if ($product) {
        $cartDetails[] = [
          'product' => $product,
          'quantity' => $quantity,
          'total' => floatval($product->prix) * floatval($quantity),
          'image' => $product->image,
          'slug' => $product->slug,
          'nom' => $product->nom,
          'prix' => $product->prix,
          'id' => $product->id,
          // Add this line to include the 'image' key
        ];
      }
    }

    // Pass the variables to the view
    return view('cart.show', [
      'categories' => $categories,
      'cart' => $cart,
      'cartDetails' => $cartDetails
    ]);
  }

  public function addToCart($id)
  {
    $product = Product::find($id);

    if (!$product) {
      abort(404);
    }

    // Get the current cart from the session
    $cart = session()->get('cart', []);

    // Check if the product is already in the cart
    if (isset($cart[$product->id])) {
      // If the product is in the cart, increment the quantity
      $cart[$product->id]['quantity']++;
    } else {
      // If the product is not in the cart, add it
      $cart[$product->id] = [
        'id' => $product->id,
        'nom' => $product->nom,
        'prix' => $product->prix,
        'quantity' => 1,
        // Initial quantity
        // Add other necessary product details
      ];
    }

    // Store the updated cart in the session
    session(['cart' => $cart]);

    return redirect()->route('cart.show')->with('success', 'Product added to cart successfully');
  }

  public function remove($productId)
  {
      // Logique pour supprimer le produit du panier
      // Utilisez la session ou le mécanisme de stockage que vous utilisez pour le panier

      // Exemple avec la session
      $cart = session()->get('cart', []);

      // Recherchez l'index du produit dans le panier
      foreach ($cart as $index => $item) {
          if ($item['id'] == $productId) {
              // Supprimez le produit si trouvé
              unset($cart[$index]);
              break; // Sortez de la boucle une fois que le produit est supprimé
          }
      }

      // Mettez à jour la session avec le panier modifié
      session()->put('cart', $cart);

      // Redirigez l'utilisateur vers la page du panier ou une autre page
      return redirect()->route('cart.show')->with('success', 'Produit supprimé du panier');
  }



}
