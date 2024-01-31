<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function showCart(Request $request)
    {
        // Votre logique pour récupérer les catégories
        $categories = Category::with('parent')->get();
        $parents = Category::pluck('name', 'id')->prepend('None', '');

        // Récupérez le panier actuel depuis la session
        $cart = $request->session()->get('cart', []);

        // Récupérez les détails des produits dans le panier
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
                ];
            }
        }

        // Passez les variables à la vue
        return view('cart.show', [
            'categories' => $categories,
            'cart' => $cart,
            'cartDetails' => $cartDetails
        ]);
    }

    public function addToCart($id)
    {
        // Votre logique pour ajouter un produit au panier
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        // Récupérez le panier actuel depuis la session
        $cart = session()->get('cart', []);

        // Vérifiez si le produit est déjà dans le panier
        if (isset($cart[$product->id])) {
            // Si le produit est dans le panier, incrémentez la quantité
            $cart[$product->id]['quantity']++;
        } else {
            // Si le produit n'est pas dans le panier, ajoutez-le
            $cart[$product->id] = [
                'id' => $product->id,
                'nom' => $product->nom,
                'prix' => $product->prix,
                'quantity' => 1,
            ];
        }

        // Stockez le panier mis à jour dans la session
        session(['cart' => $cart]);

        return redirect()->route('cart.show')->with('success', 'Produit ajouté au panier avec succès');
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
        return redirect()->route('cart.show')->with('success', 'Panier mis à jour avec succès');
    }

    public function clearCart(Request $request)
    {
        // Supprimez complètement le panier de la session
        $request->session()->forget('cart');

        // Redirigez l'utilisateur vers la page du panier ou une autre page
        return redirect()->route('cart.show')->with('success', 'Panier vidé avec succès');
    }
}
