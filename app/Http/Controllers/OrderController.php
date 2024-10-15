<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class OrderController extends Controller
{
  public function checkout()
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

  // Afficher les commandes pour l'administrateur, organisées par statut
  public function indexAdmin()
  {
    // Appliquer d'abord orderBy avant groupBy
    $orders = Order::with('user')
      ->orderBy('id', 'desc') // Appliquer orderBy sur la requête
      ->paginate(10); // Utiliser la pagination avant le groupBy

    // Ensuite, on regroupe les résultats par statut
    $ordersByStatus = $orders->groupBy('status');

    return view('admin.orders.index', compact('ordersByStatus'));
  }

  // Afficher l'historique des commandes pour un utilisateur authentifié
  public function indexUser()
  {
    // Récupérer les commandes de l'utilisateur connecté
    $userOrders = Order::where('user_id', Auth::id())
      ->orderBy('created_at', 'desc')
      ->get();

    return view('user.orders.index', compact('userOrders'));
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
    $order->user_id = Auth::id();
    $order->shipping_address = $request->shipping_address;
    $order->shipping_method = $request->shipping_method;
    $order->total_amount = session('cart_total');
    $order->status = 'pending';
    $order->order_number = 'CO-' . time();

    // Enregistrement de la commande dans la base de données
    $order->save();

    // Enregistrement des produits du panier en tant que OrderItem
    $cart = session('cart');
    foreach ($cart as $id => $details) {
      // Créer les items associés à la commande
      $order->items()->create([
        'product_id' => $id,
        'quantity' => $details['quantity'],
        'price' => $details['price'],
      ]);
    }

    // Vider le panier après la validation de la commande
    session()->forget('cart');

    // Redirection avec message de succès
    return redirect('/')->with('success', 'Votre commande a été passée avec succès.');
  }


  public function edit(Order $order)
  {
    // Charger les relations 'items' et 'items.product' pour afficher les articles et leurs produits dans la vue
    $order->load('items.product');

    // Récupérer la commande et afficher la vue d'édition avec ses articles et produits
    return view('admin.orders.edit', compact('order'));
  }



  public function update(Request $request, Order $order)
  {
    // Valider le statut
    $request->validate([
      'status' => 'required|in:pending,shipped,completed,cancelled',
    ]);

    // Mettre à jour le statut de la commande
    $order->status = $request->status;
    $order->save();

    return redirect()->route('admin.orders.index')->with('success', 'Commande mise à jour avec succès.');
  }

  public function generateDevis($id)
  {
    $order = Order::with('items.product')->findOrFail($id);
    $seller = [
      'name' => 'Sparksuite, Inc.',
      'address' => '12345 Sunny Road',
      'city' => 'Sunnyville, CA 12345'
    ];

    $pdf = Pdf::loadView('pdf.devis', compact('order', 'seller'));

    return $pdf->download('devis_commande_' . $order->order_number . '.pdf');
  }

  public function generateFacture($id)
  {
    $order = Order::with('items.product')->findOrFail($id);
    $seller = [
      'name' => 'Sparksuite, Inc.',
      'address' => '12345 Sunny Road',
      'city' => 'Sunnyville, CA 12345'
    ];

    $pdf = Pdf::loadView('pdf.facture', compact('order', 'seller'));

    return $pdf->download('facture_commande_' . $order->order_number . '.pdf');
  }
}
