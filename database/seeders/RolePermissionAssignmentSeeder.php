<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionAssignmentSeeder extends Seeder
{
  public function run()
  {
    // Assigner toutes les permissions au rôle 'admin'
    $adminRole = Role::where('name', 'admin')->first();
    $adminRole->givePermissionTo(Permission::all());

    // Assigner certaines permissions au rôle 'user'
    $userRole = Role::where('name', 'user')->first();
    $userPermissions = ['voir les utilisateurs', 'voir les commandes'];
    $userRole->givePermissionTo($userPermissions);

    // Assigner des permissions spécifiques au rôle 'manager'
    $managerRole = Role::where('name', 'manager')->first();
    $managerPermissions = ['creer les produits', 'modifier les produits', 'supprimer les produits'];
    $managerRole->givePermissionTo($managerPermissions);
  }
}
