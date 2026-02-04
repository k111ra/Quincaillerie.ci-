<?php

/**
 * SCRIPT DE TEST - MODULE PARTENAIRES MVP
 *
 * Commandes à exécuter dans php artisan tinker
 * pour vérifier que tout est configuré correctement
 */

// 1. Vérifier que le seeder a créé les rôles
echo "=== VÉRIFICATION DES RÔLES ===\n";
$roles = \Spatie\Permission\Models\Role::all();
echo "Rôles créés: " . $roles->count() . "\n";
foreach ($roles as $role) {
    echo "  - " . $role->name . "\n";
}

echo "\n=== VÉRIFICATION DES PERMISSIONS ===\n";
$permissions = \Spatie\Permission\Models\Permission::all();
echo "Permissions créées: " . $permissions->count() . "\n";

echo "\n=== TESTER L'INSCRIPTION PARTENAIRE ===\n";
echo "Allez à: http://localhost/partner/register\n";
echo "Remplissez le formulaire et inscrivez-vous\n";

echo "\n=== VÉRIFIER LA CRÉATION DE L'UTILISATEUR ===\n";
echo "php artisan tinker\n";
echo ">>> \$user = User::where('user_type', 'partner')->first();\n";
echo ">>> \$user->partner\n";
echo ">>> \$user->getRoleNames()\n";

echo "\n=== VÉRIFIER LE FOURNISSEUR ===\n";
echo ">>> \$partner = Fournisseur::where('status', 'pending_approval')->first();\n";
echo ">>> \$partner->user\n";
echo ">>> \$partner->notification_preferences\n";

echo "\n=== COMMANDS UTILES ===\n";
echo "Voir toutes les routes:\n";
echo "  php artisan route:list\n\n";

echo "Voir les routes partenaires:\n";
echo "  php artisan route:list | grep partner\n\n";

echo "Voir les rôles dans tinker:\n";
echo "  php artisan tinker\n";
echo "  >>> Role::with('permissions')->get()\n\n";

echo "Assigner un rôle:\n";
echo "  >>> \$user = User::find(1);\n";
echo "  >>> \$user->assignRole('partner');\n\n";

echo "Vérifier permissions de l'utilisateur:\n";
echo "  >>> \$user->getPermissionNames()\n\n";
