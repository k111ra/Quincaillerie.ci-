# 🧪 Test du Système de Redirection d'Authentification

## Commandes de Test (PHP Artisan Tinker)

```bash
php artisan tinker
```

### Test 1: Vérifier un utilisateur admin

```php
>>> $admin = User::where('user_type', 'admin')->first();
>>> $admin->user_type;
// Output: "admin"

>>> $admin->hasRole('admin');
// Output: true

>>> $admin->roles;
// Output: Collection containing 'admin' role
```

### Test 2: Vérifier un utilisateur partenaire

```php
>>> $partner = User::where('user_type', 'partner')->first();
>>> $partner->user_type;
// Output: "partner"

>>> $partner->hasRole('partner');
// Output: true

>>> $partner->partner; // Relation belongsTo(Fournisseur)
// Output: Fournisseur object

>>> $partner->fournisseur_id;
// Output: (ID du fournisseur lié)
```

### Test 3: Vérifier un utilisateur client

```php
>>> $client = User::where('user_type', 'customer')->first();
>>> $client->user_type;
// Output: "customer"

>>> $client->hasRole('customer');
// Output: true
```

### Test 4: Tester la redirection (simulation)

```php
>>> $user = User::find(1);
>>> Auth::login($user);

// La redirection se ferait automatiquement dans le contrôleur:
// - Si admin → admin.dashboard
// - Si partner → partner.dashboard  
// - Si customer → user.dashboard

>>> auth()->user()->user_type;
// Output: (affiche le type)
```

### Test 5: Vérifier les rôles et permissions

```php
>>> $partner = User::where('user_type', 'partner')->first();
>>> $partner->roles()->pluck('name');
// Output: ["partner"]

>>> $partner->permissions()->pluck('name');
// Output: ["publish.offers", "edit.own.offers", ...]

>>> $admin = User::where('user_type', 'admin')->first();
>>> $admin->roles()->pluck('name');
// Output: ["admin"]

>>> $admin->permissions()->pluck('name');
// Output: ["manage.offers", "approve.offers", ...]
```

### Test 6: Accès au Dashboard

**Via navigateur**:

1. **Test Admin**:
   ```
   GET /login
   POST /login (credentials admin)
   → Redirection vers /admin/dashboard ✅
   ```

2. **Test Partenaire**:
   ```
   GET /login
   POST /login (credentials partenaire)
   → Redirection vers /partner/dashboard ✅
   ```

3. **Test Client**:
   ```
   GET /login
   POST /login (credentials client)
   → Redirection vers /user/dashboard ✅
   ```

### Test 7: Vérification de Sécurité

**Via navigateur**:

1. **Client accédant à partner/dashboard**:
   ```
   GET /partner/dashboard (connecté en tant que client)
   → Redirection vers / avec erreur "Accès non autorisé" ✅
   ```

2. **Client accédant à admin/dashboard**:
   ```
   GET /admin/dashboard (connecté en tant que client)
   → Redirection ou erreur 403 (dépend du middleware) ✅
   ```

### Test 8: Vérifier le lien dans le header

Dans la vue header.blade.php:

```blade
<a href="{{ route('partner.register') }}">Devenez Partenaire</a>
```

**Test**:
```
1. Visiter homepage
2. Cliquer sur "Devenez Partenaire"
3. → Redirection vers /partner/register ✅
4. Remplir le formulaire
5. → Création User avec user_type='partner' ✅
6. → Création Fournisseur avec status='pending_approval' ✅
7. → Assignation du rôle 'partner' ✅
```

---

## 📊 Résultats Attendus

### Scénario 1: Login Admin
```
Email: admin@example.com
Password: password

Expected:
✅ Authentification réussie
✅ user_type === 'admin'
✅ hasRole('admin') === true
✅ Redirection vers /admin/dashboard
✅ Page affiche admin dashboard
```

### Scénario 2: Login Partenaire
```
Email: partner@example.com
Password: password

Expected:
✅ Authentification réussie
✅ user_type === 'partner'
✅ hasRole('partner') === true
✅ Redirection vers /partner/dashboard
✅ Page affiche partner dashboard
✅ Affiche statut d'approbation
✅ Affiche infos entreprise
```

### Scénario 3: Login Client
```
Email: client@example.com
Password: password

Expected:
✅ Authentification réussie
✅ user_type === 'customer' OR NULL
✅ hasRole('customer') === true OR NO ROLE
✅ Redirection vers /user/dashboard
✅ Page affiche client dashboard
```

### Scénario 4: Non Authentifié
```
Action: Accéder directement à /partner/dashboard

Expected:
❌ Middleware 'auth' redirige vers /login
✅ Affiche formulaire login
```

### Scénario 5: Accès Non Autorisé
```
Connecté: Client
Action: Accéder à /partner/dashboard

Expected:
❌ Vérification dans le controller
✅ Redirection vers /
✅ Affiche message d'erreur "Accès non autorisé"
```

---

## 🔍 Vérification en Tinker

### Check 1: Compter les utilisateurs par type

```php
>>> User::select('user_type')->groupBy('user_type')->selectRaw('COUNT(*) as count')->get();

// Output (exemple):
// [
//   {"user_type": "admin", "count": 1},
//   {"user_type": "partner", "count": 5},
//   {"user_type": "customer", "count": 120},
//   {"user_type": null, "count": 10}
// ]
```

### Check 2: Vérifier une inscription partenaire

```php
>>> $partner = Fournisseur::where('status', 'pending_approval')->first();
>>> $partner->user;
// Output: User object
>>> $partner->user->user_type;
// Output: "partner"
>>> $partner->user->hasRole('partner');
// Output: true
```

### Check 3: Vérifier les permissions asignées

```php
>>> Role::with('permissions')->get();
// Output: Tous les rôles avec leurs permissions

>>> Role::where('name', 'partner')->first()->permissions->pluck('name');
// Output: ["publish.offers", "edit.own.offers", ...]
```

### Check 4: Vérifier la relation User-Fournisseur

```php
>>> $user = User::where('user_type', 'partner')->first();
>>> $user->partner;
// Output: Fournisseur object OR NULL

>>> $user->fournisseur_id;
// Output: ID du fournisseur

>>> $user->partner->status;
// Output: "pending_approval" OR "approved"
```

---

## 🎯 Points Critiques à Tester

1. **Double Vérification**: `user_type` ET `hasRole()`
2. **Fallback**: Si l'une échoue, l'autre prend le relais
3. **Ordre de Vérification**: Admin AVANT Partner AVANT Customer
4. **Sécurité**: Pas d'accès croisé entre types d'utilisateurs
5. **Relations**: User.partner → Fournisseur (belongsTo)
6. **Status**: Fournisseur.status = pending_approval OR approved OR rejected
7. **Rôles**: Spatie roles assignés correctement à l'inscription
8. **Routes**: Toutes les routes enregistrées et accessibles

---

## 📋 Checklist de Validation

- [ ] Route /login existe et est accessible
- [ ] Route /admin/dashboard redirigée pour les admins
- [ ] Route /partner/dashboard redirigée pour les partenaires
- [ ] Route /user/dashboard redirigée pour les clients
- [ ] Middleware 'auth' protège les routes
- [ ] Vérification de sécurité dans les controllers
- [ ] Double vérification (user_type + hasRole)
- [ ] Fallback fonctionne correctement
- [ ] Header affiche le lien "Devenez Partenaire"
- [ ] Inscription partenaire fonctionne
- [ ] Création Fournisseur + assignation rôle OK
- [ ] Redirection après login fonctionne
- [ ] Dashboard affiche les bonnes informations
- [ ] Logs d'erreur sont clairs
- [ ] Tests de sécurité passent

---

## 🚀 Déploiement

```bash
# 1. Vérifier les migrations
php artisan migrate:status

# 2. Vérifier les routes
php artisan route:list

# 3. Tester l'authentification
php artisan tinker

# 4. Vider le cache
php artisan cache:clear

# 5. Régénérer les routes
php artisan route:cache

# 6. Tester en navigateur
# - Accéder à /login
# - Tester chaque type d'utilisateur
# - Vérifier les redirections
```

---

**Créé**: 4 février 2026  
**Dernier test**: [À effectuer]  
**Status**: 🟢 Ready for Testing
