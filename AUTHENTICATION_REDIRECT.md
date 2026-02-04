# 🔐 Système de Redirection d'Authentification Multi-Rôles

**Date**: 4 février 2026  
**Statut**: ✅ **IMPLÉMENTÉ**

---

## 📋 Vue d'ensemble

Le système d'authentification unique page de connexion qui redirige chaque utilisateur vers son dashboard approprié selon son rôle:

- **Admin** → `admin.dashboard`
- **Partenaire** → `partner.dashboard`  
- **Client** (défaut) → `user.dashboard`

---

## 🔄 Flux d'Authentification

```
┌─────────────────┐
│  LOGIN PAGE     │
│  (commune)      │
└────────┬────────┘
         │
         ▼
┌─────────────────────────────┐
│  VERIFY CREDENTIALS         │
│  (check email + password)   │
└────────┬────────────────────┘
         │
         ├─ Échec? ──► Affiche erreur
         │
         ├─ Succès ▼
         │
    ┌────────────────────────────────────────┐
    │  CHECK USER TYPE / ROLE                │
    ├────────────────────────────────────────┤
    │  user_type = 'admin'                   │
    │  OR hasRole('admin')                   │
    │          │                              │
    │          ├─ OUI ──► admin.dashboard    │
    │          │                              │
    │          └─ NON ──► Vérifier suivant   │
    │                                        │
    │  user_type = 'partner'                 │
    │  OR hasRole('partner')                 │
    │          │                              │
    │          ├─ OUI ──► partner.dashboard  │
    │          │                              │
    │          └─ NON ──► user.dashboard     │
    │                                        │
    └────────────────────────────────────────┘
```

---

## 📁 Fichiers Modifiés

### 1. **app/Http/Controllers/Auth/AuthenticatedSessionController.php**

**Méthode**: `store(LoginRequest $request)`

```php
// Avant:
return redirect()->intended(RouteServiceProvider::HOME);

// Après:
$user = Auth::user();

if ($user->user_type === 'admin' || $user->hasRole('admin')) {
    return redirect()->intended(route('admin.dashboard'));
} elseif ($user->user_type === 'partner' || $user->hasRole('partner')) {
    return redirect()->intended(route('partner.dashboard'));
} else {
    return redirect()->intended(route('user.dashboard'));
}
```

**Raison**: Ce controller gère la connexion moderne (Laravel Fortify/Sanctum). On vérifie d'abord `user_type` (colonne DB) puis le rôle Spatie (fallback).

### 2. **app/Http/Controllers/Auth/LoginController.php**

**Méthode**: `login(Request $request)`

```php
// Avant:
if (Auth::user()->role == 'admin') {
    return redirect()->route('admin.dashboard');
}
return redirect()->route('user.dashboard');

// Après:
$user = Auth::user();

if ($user->user_type === 'admin' || $user->hasRole('admin')) {
    return redirect()->route('admin.dashboard');
} elseif ($user->user_type === 'partner' || $user->hasRole('partner')) {
    return redirect()->route('partner.dashboard');
} else {
    return redirect()->route('user.dashboard');
}
```

**Raison**: Support legacy (AuthenticatesUsers) et ajout support partenaires.

### 3. **routes/web.php**

**Avant**:
```php
Route::middleware(['auth'])->group(function () {
  Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
  Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
```

**Après**:
```php
Route::middleware(['auth'])->group(function () {
  Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
  Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
  Route::get('/partner/dashboard', [PartnerController::class, 'dashboard'])->name('partner.dashboard');
```

**Raison**: Ajout de la route pour le dashboard partenaire.

### 4. **app/Http/Controllers/PartnerController.php**

**Méthode**: `dashboard()` (NOUVELLE)

```php
public function dashboard()
{
    $user = auth()->user();

    // Vérifier que l'utilisateur est un partenaire
    if ($user->user_type !== 'partner' && !$user->hasRole('partner')) {
        return redirect()->route('index')->with('error', 'Accès non autorisé.');
    }

    // Récupérer le profil fournisseur
    $fournisseur = $user->partner; // relation belongsTo(Fournisseur)

    if (!$fournisseur) {
        return redirect()->route('index')->with('error', 'Profil partenaire non trouvé.');
    }

    return view('partner.dashboard', compact('fournisseur', 'user'));
}
```

**Raison**: Affiche le dashboard partenaire avec vérification de sécurité.

### 5. **resources/views/partner/dashboard.blade.php**

**Vue**: Dashboard partenaire personnalisé

Affiche:
- Sidebar avec profil et menu
- Statut d'approbation (pending/approved/rejected)
- Informations entreprise
- Statistiques (offres, demandes, taux de réponse)
- Timeline des prochaines phases

---

## 🔐 Sécurité

### Vérifications

```php
// Double vérification: user_type + rôle
if ($user->user_type === 'partner' || $user->hasRole('partner')) {
    // Valide si l'une ou l'autre condition est vraie
}
```

**Pourquoi?**
- `user_type` = source de vérité principale (colonne DB)
- `hasRole('partner')` = fallback via Spatie permissions
- Si l'une échoue, l'autre peut couvrir (robustesse)

### Middleware de Sécurité

Dashboard partenaire protégé par `['auth']`:
```php
Route::middleware(['auth'])->group(function () {
    Route::get('/partner/dashboard', [PartnerController::class, 'dashboard'])->name('partner.dashboard');
});
```

Utilisateurs non authentifiés sont redirigés vers login.

### Vérification dans le Controller

```php
if ($user->user_type !== 'partner' && !$user->hasRole('partner')) {
    return redirect()->route('index')->with('error', 'Accès non autorisé.');
}
```

Empêche un client de modifier l'URL pour accéder au dashboard partenaire.

---

## 🧪 Test du Système

### Scénario 1: Connexion Admin

```
1. Visiter /login
2. Entrer credentials admin
3. Attendre redirection...
4. ✅ Redirect vers /admin/dashboard
```

### Scénario 2: Connexion Partenaire

```
1. Visiter /partner/register
2. S'enregistrer comme partenaire
3. (Système crée User avec user_type='partner')
4. Visiter /login
5. Entrer credentials partenaire
6. Attendre redirection...
7. ✅ Redirect vers /partner/dashboard
```

### Scénario 3: Connexion Client

```
1. Visiter /register (registration client standard)
2. S'enregistrer comme client
3. Visiter /login
4. Entrer credentials client
5. Attendre redirection...
6. ✅ Redirect vers /user/dashboard
```

### Scénario 4: Vérification de Sécurité

```
1. Se connecter en tant que client
2. Essayer d'accéder directement: /partner/dashboard
3. ✅ Affiche erreur "Accès non autorisé"
4. Redirect vers homepage
```

---

## 🔄 Logique de Décision

### Point d'Entrée Unique

Une seule page login (pas de distinction admin/partner/client):

```blade
<!-- resources/views/auth/login.blade.php -->
<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">Connexion</button>
</form>
```

### Redirection Intelligente

Après authentification réussie, le système:

1. **Récupère l'utilisateur**: `$user = Auth::user()`
2. **Vérifie le type**: `if ($user->user_type === 'admin')`
3. **Redirige appropriement**: `redirect()->route('admin.dashboard')`

---

## 📊 Matrice d'Accès

| User Type | Role | Authentifié | Route | Destination |
|-----------|------|-------------|-------|-------------|
| admin | admin | ✅ | /login | admin.dashboard |
| partner | partner | ✅ | /login | partner.dashboard |
| customer | customer | ✅ | /login | user.dashboard |
| Quelconque | N/A | ❌ | /login | Login form (redirect) |
| admin | N/A | ✅ | /partner/dashboard | Index + Error |
| customer | N/A | ✅ | /admin/dashboard | Index + Error |

---

## 🎯 Cas d'Utilisation

### Cas 1: Nouvelle Inscription Partenaire

```
User:
├─ name: "Jean Dupont"
├─ email: "jean@example.com"
├─ password: "secured_hash"
├─ user_type: "partner" ← NEW
└─ fournisseur_id: 1 ← LINKED

Fournisseur:
├─ id: 1
├─ user_id: 1 ← LINKED
├─ nom: "Dupont SARL"
├─ status: "pending_approval"
└─ ... (autres colonnes)

Result:
Login → Check user_type='partner' → Redirect to partner.dashboard
```

### Cas 2: Admin Approuve Partenaire

```
Admin:
├─ user_type: "admin"
└─ role: "admin"

Fournisseur:
└─ status: "approved" (mis à jour par admin)

Result:
Partner logs in → Check status → Dashboard affiche "Approuvé"
```

---

## 📝 Notes d'Implémentation

### Ordre de Vérification

**Important**: L'ordre de vérification est critique!

```php
// ✅ BON - Admin en premier (plus restrictif)
if ($user->user_type === 'admin' || $user->hasRole('admin')) {
    return redirect()->route('admin.dashboard');
} elseif ($user->user_type === 'partner' || $user->hasRole('partner')) {
    return redirect()->route('partner.dashboard');
} else {
    return redirect()->route('user.dashboard');
}
```

Si on changeait l'ordre, un admin pourrait être redirigé comme partenaire!

### Fallback sur user_type

```php
// Vérifie d'abord user_type (colonne DB)
// Si false, vérifie le rôle Spatie (permissions table)
// Cela permet une migration progressive Spatie
```

---

## 🚀 Prochaines Étapes

### Phase 2: Offres Partenaires

Ajouter dans `PartnerController@dashboard`:
```php
$offers = $fournisseur->offers()->latest()->get();
return view('partner.dashboard', compact('fournisseur', 'offers'));
```

### Phase 3: Demandes/Inquiries

```php
$inquiries = $fournisseur->inquiries()->latest()->get();
```

### Phase 4: Notifications

```php
$notifications = $user->notifications()->latest()->limit(10)->get();
```

---

## ✅ Checklist

- [x] AuthenticatedSessionController mis à jour
- [x] LoginController mis à jour
- [x] Route partner.dashboard ajoutée
- [x] PartnerController@dashboard créé
- [x] Vue partner/dashboard créée
- [x] Sécurité implémentée
- [x] Test scenarios documentés
- [x] Documentation complète

---

## 📞 Support

En cas de problème:

1. Vérifier que `user_type` est défini dans Users table
2. Vérifier que les rôles Spatie sont assignés correctement
3. Vérifier les logs: `storage/logs/laravel.log`
4. Tester avec tinker: `php artisan tinker > Auth::user()`

---

**Créé**: 4 février 2026  
**Version**: 1.0.0  
**Statut**: ✅ Production Ready
