<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role; // Importer le modèle de Spatie
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Liste des rôles à créer avec le guard_name
    $roles = [
      ['name' => 'admin', 'guard_name' => 'web'],
      ['name' => 'user', 'guard_name' => 'web'],
      ['name' => 'manager', 'guard_name' => 'web'],
    ];

    // Création des rôles
    foreach ($roles as $role) {
      // Vérifie si le rôle n'existe pas déjà avant de le créer
      if (!Role::where('name', $role)->where('guard_name', 'web')->exists()) {
        Role::create(['name' => $role, 'guard_name' => 'web']);
      }
    }
  }
}
