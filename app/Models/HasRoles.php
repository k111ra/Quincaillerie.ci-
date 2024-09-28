<?php

namespace App\Models;

use Spatie\Permission\Models\Role;

trait HasRoles
{
  /**
   * Relation: Un utilisateur peut avoir plusieurs rôles.
   */
  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }

  /**
   * Vérifie si l'utilisateur a un rôle spécifique.
   *
   * @param string $roleSlug Le slug du rôle à vérifier.
   * @return bool
   */
  public function hasRole($roleSlug)
  {
    return $this->roles->contains('slug', $roleSlug);
  }

  /**
   * Assigne un rôle à l'utilisateur.
   *
   * @param int|Role $role L'ID ou l'instance du rôle à assigner.
   * @return void
   */
  public function assignRole($role)
  {
    if (is_numeric($role)) {
      $role = Role::find($role);
    }

    if ($role instanceof Role) {
      $this->roles()->attach($role);
    }
  }

  /**
   * Retire un rôle de l'utilisateur.
   *
   * @param int|Role $role L'ID ou l'instance du rôle à retirer.
   * @return void
   */
  public function removeRole($role)
  {
    if (is_numeric($role)) {
      $role = Role::find($role);
    }

    if ($role instanceof Role) {
      $this->roles()->detach($role);
    }
  }
}
