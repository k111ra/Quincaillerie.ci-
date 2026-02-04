#!/bin/bash

# Script de setup pour le module Partenaires MVP
# Usage: bash setup_partners_module.sh

echo "================================"
echo "Setup Module Partenaires MVP"
echo "================================"
echo ""

echo "Step 1: Vider le cache de routes..."
php artisan route:clear
echo "✓ Cache de routes vidé"
echo ""

echo "Step 2: Lancer les migrations..."
php artisan migrate
if [ $? -eq 0 ]; then
    echo "✓ Migrations lancées avec succès"
else
    echo "✗ Erreur lors des migrations!"
    exit 1
fi
echo ""

echo "Step 3: Créer les rôles et permissions..."
php artisan db:seed --class=PartnerRolesAndPermissionsSeeder
if [ $? -eq 0 ]; then
    echo "✓ Rôles et permissions créés"
else
    echo "✗ Erreur lors du seeding!"
    exit 1
fi
echo ""

echo "================================"
echo "✅ Setup terminé!"
echo "================================"
echo ""
echo "Prochaines étapes:"
echo "1. Naviguer vers: http://localhost/partner/register"
echo "2. Remplir le formulaire d'enregistrement partenaire"
echo "3. Vérifier dans la base: users.user_type = 'partner'"
echo "4. Commencer la Phase 2: Offres + Demandes"
echo ""
