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
    // Création des rôles
    $adminRole = Role::create(['name' => 'admin']);
    $userRole = Role::create(['name' => 'user']);

    // Création d'un utilisateur admin
    $admin = User::create([
      'name' => 'Admin User',
      'email' => 'admin@example.com',
      'password' => bcrypt('password123'),
    ]);

    // Attribution du rôle admin à l'utilisateur admin
    $admin->assignRole($adminRole);

    // Création d'un utilisateur simple
    $user = User::create([
      'name' => 'Regular User',
      'email' => 'user@example.com',
      'password' => bcrypt('password123'),
    ]);

    // Attribution du rôle utilisateur à l'utilisateur simple
    $user->assignRole($userRole);
  }
}
