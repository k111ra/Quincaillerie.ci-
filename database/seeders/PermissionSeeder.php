<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
  public function run()
  {
    // Liste des permissions à créer
    $permissions = [
      'voir les utilisateurs',
      'modifier les utilisateurs',
      'supprimer les utilisateur',
      'creer les utilisateurs',
      'modifier les produits',
      'supprimer les produits',
      'creer les produits',
      'voir les commandes',
      'modifier les commandes',
      'supprimer les commandes',
    ];

    // Création des permissions
    foreach ($permissions as $permission) {
      // Vérifie si la permission n'existe pas déjà avant de la créer
      if (!Permission::where('name', $permission)->where('guard_name', 'web')->exists()) {
        Permission::create(['name' => $permission, 'guard_name' => 'web']);
      }
    }
  }
}
