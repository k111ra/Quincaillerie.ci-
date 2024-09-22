<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class OrderController extends Controller
{
  public function index()
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
    return view('checkout')->with([
      'categories' => $categories,
      'products' => $products,
      'cart' => $cart,
    ]);
  }
  public function store(Request $request)
  {
    // Validation des données
    $request->validate([
      'shipping_address' => 'required|string|max:255',
      'shipping_method' => 'required|string|max:255',
    ]);

    // Création de la commande
    $order = new Order();
    $order->user_id = Auth::id();  // Définir l'ID utilisateur à partir de l'utilisateur connecté
    $order->shipping_address = $request->shipping_address;  // Définir l'adresse de livraison
    $order->shipping_method = $request->shipping_method;    // Définir la méthode de livraison
    $order->total_amount = session('cart_total');           // Récupérer le total du panier depuis la session
    $order->status = 'pending';                            // Statut initial de la commande
    $order->order_number = 'CO-' . time();                // Générer un numéro de commande unique

    // Enregistrement de la commande dans la base de données
    $order->save();

    // Vider le panier après la validation de la commande
    session()->forget('cart');

    // Redirection avec message de succès
    return redirect('/')->with('success', 'Votre commande a été passée avec succès.');
  }
}
