<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
  public function redirectToGoogle()
  {
    return Socialite::driver('google')->redirect();
  }

  public function handleGoogleCallback()
  {
    $googleUser = Socialite::driver('google')->stateless()->user();
    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
      $user = User::create([
        'name' => $googleUser->getName(),
        'email' => $googleUser->getEmail(),
        'password' => bcrypt(uniqid()),
        // Ajoutez d'autres champs si nécessaire
      ]);
    }

    Auth::login($user);
    return redirect()->intended('/');
  }
}
