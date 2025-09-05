<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function dashboard()
  {
    $user = auth()->user();
    $categories = Category::with('parent')->get();
    $parents = Category::pluck('name', 'id')->prepend('None', '');

    // Récupération des données utilisateur (à adapter selon tes relations)
    $cart = method_exists($user, 'cartItems') ? $user->cartItems ?? [] : [];
    $favorites = method_exists($user, 'favorites') ? $user->favorites ?? [] : [];
    $orders = method_exists($user, 'orders') ? $user->orders ?? [] : [];
    $quotes = method_exists($user, 'quotes') ? $user->quotes ?? [] : [];

    return view('user.dashboard')->with([
      'categories' => $categories,
      'cart' => $cart,
      'favorites' => $favorites,
      'orders' => $orders,
      'quotes' => $quotes,
    ]);
  }

  public function register()
  {
    $categories = Category::with('parent')->get();
    $parents = Category::pluck('name', 'id')->prepend('None', '');
    return view('auth.register')->with(
      [
        'categories' => $categories,
        'parents' => $parents
      ]
    );
  }
}
