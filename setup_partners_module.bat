@echo off
REM Script de setup pour le module Partenaires MVP (Windows)
REM Usage: setup_partners_module.bat

echo ================================
echo Setup Module Partenaires MVP
echo ================================
echo.

echo Step 1: Vider le cache de routes...
php artisan route:clear
echo ✓ Cache de routes vide
echo.

echo Step 2: Lancer les migrations...
php artisan migrate
if %errorlevel% neq 0 (
    echo ✗ Erreur lors des migrations!
    exit /b 1
)
echo ✓ Migrations lancees avec succes
echo.

echo Step 3: Creer les roles et permissions...
php artisan db:seed --class=PartnerRolesAndPermissionsSeeder
if %errorlevel% neq 0 (
    echo ✗ Erreur lors du seeding!
    exit /b 1
)
echo ✓ Roles et permissions crees
echo.

echo ================================
echo ✅ Setup termine!
echo ================================
echo.
echo Prochaines etapes:
echo 1. Naviguer vers: http://localhost/partner/register
echo 2. Remplir le formulaire d'enregistrement partenaire
echo 3. Verifier dans la base: users.user_type = 'partner'
echo 4. Commencer la Phase 2: Offres + Demandes
echo.
pause
