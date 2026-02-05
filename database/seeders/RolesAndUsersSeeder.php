<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesAndUsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Création des rôles (avec vérification d'existence)
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    $userRole = Role::firstOrCreate(['name' => 'user']);
    $partnerRole = Role::firstOrCreate(['name' => 'partner']);

    // Création d'un utilisateur admin (avec vérification d'existence)
    $admin = User::firstOrCreate(
      ['email' => 'admin@example.com'],
      [
        'name' => 'Admin User',
        'password' => bcrypt('password123'),
      ]
    );

    // Attribution du rôle admin à l'utilisateur admin
    if (!$admin->hasRole($adminRole)) {
      $admin->assignRole($adminRole);
    }

    // Création d'un utilisateur simple (avec vérification d'existence)
    $user = User::firstOrCreate(
      ['email' => 'user@example.com'],
      [
        'name' => 'Regular User',
        'password' => bcrypt('password123'),
      ]
    );

    // Attribution du rôle utilisateur à l'utilisateur simple
    if (!$user->hasRole($userRole)) {
      $user->assignRole($userRole);
    }
  }
}
