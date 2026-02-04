<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  use AuthenticatesUsers;

  protected $redirectTo = '/';

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function login(Request $request)
  {

    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      $user = Auth::user();

      // Redirection basée sur le type/rôle d'utilisateur
      if ($user->user_type === 'admin' || $user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
      } elseif ($user->user_type === 'partner' || $user->hasRole('partner')) {
        return redirect()->route('partner.dashboard');
      } else {
        // Client par défaut
        return redirect()->route('user.dashboard');
      }
    }

    return back()->withErrors([
      'email' => 'Verifiez votre email et le mot de passe',
    ]);
  }
}
