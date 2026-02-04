# GUIDE DE DÉPLOIEMENT - MODULE PARTENAIRES (MVP)

## ✅ FICHIERS CRÉÉS

### 1. Controllers (1 fichier)
- ✅ `app/Http/Controllers/PartnerController.php` 
  - `showRegisterForm()` - Affiche le formulaire d'enregistrement
  - `register()` - Traite l'enregistrement du partenaire

### 2. Routes (Modification)
- ✅ `routes/web.php` - Ajout import + 2 routes publiques
  - GET `/partner/register` → `partner.register`
  - POST `/partner/register` → `partner.register.store`

### 3. Views (1 fichier)
- ✅ `resources/views/partner/register.blade.php` - Formulaire inscription partenaire (design moderne)

### 4. Models (2 modifications)
- ✅ `app/Models/User.php` 
  - Fillable: `user_type`, `fournisseur_id`, `is_verified`
  - Relations: `partner()`, `isPartner()`
- ✅ `app/Models/Fournisseur.php`
  - Fillable + relations complètes
  - Scopes: `approved()`, `pending()`, `active()`
  - Soft deletes activé

### 5. Migrations (2 fichiers)
- ✅ `database/migrations/2026_02_04_000001_add_partner_fields_to_users_table.php`
  - Ajoute: `user_type`, `fournisseur_id`, `is_verified`
- ✅ `database/migrations/2026_02_04_000002_modify_fournisseurs_table.php`
  - Ajoute: `user_id`, `status`, `phone_*`, `email_*`, `whatsapp_number`, `website`, `description`, `approved_*`, `notification_preferences`, `deleted_at`

### 6. Seeder (1 fichier)
- ✅ `database/seeders/PartnerRolesAndPermissionsSeeder.php`
  - Crée 3 rôles: `partner`, `admin`, `customer`
  - Crée 18 permissions (réparties par rôle)

### 7. Header (Modification)
- ✅ `resources/views/partials/header.blade.php`
  - Bloc "Devenez Partenaire" → lien cliquable vers `route('partner.register')`

---

## 🚀 ÉTAPES DE DÉPLOIEMENT

### Étape 1 : Préparer la base de données
```bash
# Lancer les migrations
php artisan migrate

# Remplir les rôles et permissions
php artisan db:seed --class=PartnerRolesAndPermissionsSeeder
```

### Étape 2 : Tester l'inscription partenaire
```
1. Naviguer vers http://localhost/partner/register
2. Remplir le formulaire:
   - Nom complet
   - Email
   - Mot de passe (min 8 caractères)
   - Nom entreprise
   - Téléphone
   - WhatsApp (optionnel)
   - Site web (optionnel)
   - Description
3. Cliquer "Créer mon compte partenaire"
```

### Étape 3 : Vérifier les données créées
```bash
# Dans tinker Laravel
php artisan tinker

# Vérifier utilisateur créé
>>> User::where('user_type', 'partner')->first()

# Vérifier fournisseur
>>> Fournisseur::where('status', 'pending_approval')->first()

# Vérifier rôle attribué
>>> User::find(1)->roles
```

---

## ✅ CHECKLIST DE VÉRIFICATION

- [ ] Migrations lancées sans erreur
- [ ] Seeder exécuté sans erreur
- [ ] Lien "Devenez Partenaire" cliquable dans le header
- [ ] Formulaire affiche correctement
- [ ] Validation du formulaire fonctionne
- [ ] Nouvel utilisateur créé dans `users` table
- [ ] Nouveau fournisseur créé dans `fournisseurs` table
- [ ] Rôle `partner` assigné à l'utilisateur
- [ ] Status du fournisseur = `pending_approval`
- [ ] Message de succès affiché après inscription

---

## 📊 DONNÉES CRÉÉES

Après enregistrement d'un partenaire:

### Table `users`
| Colonne | Valeur |
|---------|--------|
| name | Nom partenaire |
| email | Email unique |
| password | Hash bcrypt |
| tel | Téléphone |
| user_type | **partner** |
| fournisseur_id | ID fournisseur |
| is_verified | false |

### Table `fournisseurs`
| Colonne | Valeur |
|---------|--------|
| user_id | ID utilisateur |
| nom | Nom entreprise |
| status | **pending_approval** |
| phone_primary | Téléphone |
| whatsapp_number | WhatsApp (optionnel) |
| email_primary | Email |
| website | Site web (optionnel) |
| description | Description activité |
| notification_preferences | JSON {email: true, whatsapp: bool} |

### Table `model_has_roles` (Spatie)
| Colonne | Valeur |
|---------|--------|
| role_id | ID rôle 'partner' |
| model_id | ID utilisateur |
| model_type | App\Models\User |

---

## 🔄 PROCHAINES ÉTAPES (Phase 2)

1. **PartnerOffer Model** - Offres partenaires
2. **Inquiry Model** - Demandes clients
3. **PartnerDashboardController** - Tableau de bord partenaire
4. **AdminOfferController** - Approbation offres (admin)
5. **Notifications** - Email + WhatsApp
6. **Jobs** - Traitement asynchrone

---

## ⚠️ NOTES IMPORTANTES

1. **Soft Deletes**: Fournisseur supporte soft deletes → `deleted_at` sera NULL pour les actifs
2. **Rôles Spatie**: Les permissions sont créées automatiquement
3. **Status Fournisseur**: Peut être `active`, `inactive`, ou `pending_approval`
4. **Notification Preferences**: Stocké en JSON pour flexibilité future
5. **Email Unique**: Chaque utilisateur a un email unique (contrôle Laravel)

---

## 🛠️ DÉPANNAGE

**Erreur: "Route [partner.register] not defined"**
→ S'assurer que routes/web.php a été modifié et application cachée vidée:
```bash
php artisan route:clear
php artisan route:cache
```

**Erreur: "Table 'fournisseurs' doesn't exist"**
→ Lancer les migrations:
```bash
php artisan migrate
```

**Erreur: "Class 'PartnerRolesAndPermissionsSeeder' not found"**
→ S'assurer que le seeder est dans le bon dossier et lancer:
```bash
php artisan db:seed --class=PartnerRolesAndPermissionsSeeder
```

**Formulaire ne s'affiche pas**
→ Vérifier que `resources/views/partner/register.blade.php` existe
→ Vérifier les logs Laravel: `storage/logs/laravel.log`

---

## 📚 FICHIERS DE RÉFÉRENCE

```
Audit complet: AUDIT_PARTNERS_MODULE.md
```

Créé: 4 février 2026
Status: MVP Phase 1 ✅
