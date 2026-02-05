<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;


class RegisteredUserController extends Controller
{
  protected function validator(array $data)
  {

    return Validator::make($data, [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);
  }

  /**
   * Display the registration view.
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
    $categories = Category::with('parent')->get();
    $parents = Category::pluck('name', 'id')->prepend('None', '');

    return view('auth.register')->with('categories', $categories);
  }

  /**
   * Handle an incoming registration request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ], [
      'name.required' => 'Le champ "Nom" est obligatoire.',
      'email.required' => 'Le champ "Email" est obligatoire.',
      'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',
      'password.required' => 'Le champ "Mot de passe" est obligatoire.',
      'password.confirmed' => 'Les mots de passe ne correspondent pas.',
    ]);

    // Création de l'utilisateur
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);
    
    // Assigner le rôle 'user' (par défaut pour l'inscription standard)
    if (!$user->hasRole('user')) {
      $user->assignRole('user');
    }

    // Déclencher l'événement "Registered"
    event(new Registered($user));

    // Authentification de l'utilisateur
    Auth::login($user);

    // Rediriger vers la page d'accueil après l'inscription
    return redirect(RouteServiceProvider::HOME);
  }
}
