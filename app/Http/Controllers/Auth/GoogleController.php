<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Throwable;

class GoogleController extends Controller
{
  /**
   * Redirige l'utilisateur vers la page de consentement Google.
   */
  public function redirectToGoogle()
  {
    return Socialite::driver('google')->redirect();
  }

  /**
   * Gère le callback OAuth Google et connecte/crée un compte client.
   */
  public function handleGoogleCallback(): RedirectResponse
  {
    try {
      $googleUser = Socialite::driver('google')->user();
      $email = $googleUser->getEmail();

      if (empty($email)) {
        return redirect()->route('login')->withErrors([
          'google' => 'Impossible de récupérer votre email Google. Vérifiez les permissions puis réessayez.',
        ]);
      }

      $user = User::where('email', $email)->first();

      if (!$user) {
        $user = User::create([
          'role' => 'user',
          'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Utilisateur Google',
          'email' => $email,
          'password' => Hash::make(uniqid('google_', true)),
          'user_type' => 'customer',
          'is_verified' => true,
        ]);

        if (!$user->hasRole('user')) {
          $user->assignRole('user');
        }
      }

      Auth::login($user, true);

      if ($user->user_type === 'admin' || $user->hasRole('admin')) {
        return redirect()->intended(route('admin.dashboard'));
      }

      if ($user->user_type === 'partner' || $user->hasRole('partner')) {
        return redirect()->intended(route('partner.dashboard'));
      }

      if (empty($user->tel)) {
        return redirect()->to(route('user.dashboard') . '#profil')->with(
          'warning',
          'Veuillez renseigner votre numéro de téléphone pour finaliser votre profil client.'
        );
      }

      return redirect()->intended(route('user.dashboard'));
    } catch (Throwable $e) {
      Log::error('Google auth failed: ' . $e->getMessage(), [
        'exception' => $e,
      ]);

      return redirect()->route('login')->withErrors([
        'google' => 'La connexion avec Google a échoué. Veuillez réessayer.',
      ]);
    }
  }
}
