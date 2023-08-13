<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;


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

  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected function redirectTo()
  {
    if (Auth::user()->role == 'admin') {
      return route('admin.dashboard');
    }

 return route('user.dashboard');
  }


}
