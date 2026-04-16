<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
  public function dashboard()
  {
    /** @var \App\Models\User $user */
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
      'user' => $user,
    ]);
  }

  public function updateProfile(Request $request)
  {
    /** @var \App\Models\User $user */
    $user = auth()->user();

    $validated = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
      'tel' => ['nullable', 'string', 'max:20'],
    ]);

    $user->update($validated);

    return redirect()->route('user.dashboard')->with('success', 'Vos informations personnelles ont été mises à jour avec succès.');
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
