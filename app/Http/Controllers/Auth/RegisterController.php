<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminNotificationMail;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Http\Controllers\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'tel' => ['nullable', 'string', 'max:15'],
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Models\User
   */
  protected function create(array $data)
  {
    // Créer l'utilisateur
    $user = User::create([
      'role' => $data['role'],
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
      'tel' => $data['tel'],
    ]);

    // Assigner le rôle "user" à cet utilisateur
    $user->assignRole('user'); // Assure-toi que le rôle 'user' existe dans la table 'roles'

    try {
      Mail::to(config('mail.admin.address'))->send(new AdminNotificationMail(
        'Nouvelle inscription client',
        'Un nouveau client vient de créer un compte',
        'Un nouvel utilisateur s\'est enregistré sur la plateforme.',
        [
          'Nom' => $user->name,
          'Email' => $user->email,
          'Téléphone' => $user->tel ?? 'Non renseigné',
        ]
      ));
    } catch (\Throwable $e) {
      Log::error('Admin customer registration notification failed: ' . $e->getMessage(), [
        'user_id' => $user->id,
      ]);
    }

    return $user;
  }
}
