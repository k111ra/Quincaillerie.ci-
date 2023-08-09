<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected function redirectTo()
  {
      if (Auth::user()->hasRole('admin')) {
          return route('admin.dashboard');
      }

      return route('user.dashboard');
  }
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->redirectTo = route('user.dashboard'); // Redirection par défaut pour les utilisateurs non-admin

    if (Auth::check() && Auth::user()->hasRole('admin')) {
      $this->redirectTo = route('admin.dashboard'); // Redirection pour les utilisateurs admin
    }

    $this->middleware('guest')->except('logout');
  }
}
