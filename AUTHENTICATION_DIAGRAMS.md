# 🔄 Diagramme du Système de Redirection d'Authentification

## 1. Flux Global de Connexion

```
┌────────────────────────────────────────────────────────────────┐
│                    ENTREZ LES CREDENTIALS                       │
│                     (Page Login Unique)                          │
│                                                                  │
│                 ┌─────────────────────────┐                     │
│                 │  Email + Password       │                     │
│                 └────────────┬────────────┘                     │
│                              │                                   │
└──────────────────────────────┼────────────────────────────────┘
                               │
                               ▼
                    ┌──────────────────────┐
                    │  Vérifier les        │
                    │  credentials (DB)    │
                    └──────────┬───────────┘
                               │
                    ┌──────────┴──────────┐
                    │                     │
                    ▼                     ▼
            ❌ Invalides          ✅ Valides
            (Affiche erreur)    (Authenticate)
                    │                     │
                    └─────────┬───────────┘
                              │
                              ▼
                   ┌─────────────────────┐
                   │ Récupère User       │
                   │ $user = Auth::user()│
                   └─────────┬───────────┘
                             │
                             ▼
            ┌────────────────────────────────────┐
            │   VÉRIFIER LE TYPE/RÔLE            │
            └────────────────────────────────────┘
                             │
        ┌────────────────────┼────────────────────┐
        │                    │                    │
        ▼                    ▼                    ▼
  ┌─────────────┐    ┌─────────────┐    ┌─────────────┐
  │   ADMIN?    │    │  PARTNER?   │    │  CUSTOMER?  │
  │ user_type   │    │ user_type   │    │ user_type   │
  │   ='admin'  │    │  ='partner' │    │ ='customer' │
  │      OR     │    │      OR     │    │      OR     │
  │ hasRole()   │    │ hasRole()   │    │ hasRole()   │
  └──────┬──────┘    └──────┬──────┘    └──────┬──────┘
         │ OUI              │ OUI              │ OUI
         ▼                  ▼                  ▼
    ┌─────────────────┐ ┌──────────────┐ ┌──────────────┐
    │ /admin/         │ │ /partner/    │ │ /user/       │
    │ dashboard       │ │ dashboard    │ │ dashboard    │
    │                 │ │              │ │              │
    │ Admin Panel     │ │ Partner      │ │ Client       │
    │ (Approvals,     │ │ Dashboard    │ │ Dashboard    │
    │  Analytics)     │ │ (Profile,    │ │ (Orders,     │
    │                 │ │  Offers,     │ │  Favorites)  │
    │                 │ │  Inquiries)  │ │              │
    └─────────────────┘ └──────────────┘ └──────────────┘
```

---

## 2. Matrice de Redirection

```
┌──────────────────┬──────────────┬─────────────────┬──────────────┐
│  User Type       │  Role        │  Authentifié    │  Destination │
├──────────────────┼──────────────┼─────────────────┼──────────────┤
│  admin           │  admin       │  ✅ OUI         │  /admin/     │
│                  │              │                 │  dashboard   │
├──────────────────┼──────────────┼─────────────────┼──────────────┤
│  partner         │  partner     │  ✅ OUI         │  /partner/   │
│                  │              │                 │  dashboard   │
├──────────────────┼──────────────┼─────────────────┼──────────────┤
│  customer        │  customer    │  ✅ OUI         │  /user/      │
│  (ou NULL)       │  (ou NULL)   │                 │  dashboard   │
├──────────────────┼──────────────┼─────────────────┼──────────────┤
│  N/A             │  N/A         │  ❌ NON         │  /login      │
│  (Any)           │  (Any)       │  (redirect)     │  (form)      │
├──────────────────┼──────────────┼─────────────────┼──────────────┤
│  customer        │  customer    │  ✅ OUI         │  /           │
│  (accès direct   │              │                 │  + Error     │
│   /partner/...)  │              │                 │  Message     │
└──────────────────┴──────────────┴─────────────────┴──────────────┘
```

---

## 3. Logique de Décision (Code)

```
START
  │
  ├─→ POST /login
  │   ├─→ Validator::make()
  │   │   ├─→ email required|email
  │   │   ├─→ password required
  │   │
  │   ├─→ Auth::attempt($credentials)
  │   │
  │   ├─→ IF Success
  │   │   ├─→ $user = Auth::user()
  │   │   │
  │   │   ├─→ IF ($user->user_type === 'admin' OR hasRole('admin'))
  │   │   │   └─→ redirect('admin.dashboard')
  │   │   │
  │   │   ├─→ ELSEIF ($user->user_type === 'partner' OR hasRole('partner'))
  │   │   │   └─→ redirect('partner.dashboard')
  │   │   │
  │   │   └─→ ELSE
  │   │       └─→ redirect('user.dashboard')
  │   │
  │   └─→ IF Failure
  │       └─→ back()->withErrors(['email' => 'Invalid credentials'])
  │
  └─→ END
```

---

## 4. Architecture des Fichiers

```
Laravel Project
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php ✏️ MODIFIÉ
│   │   │   │   └── LoginController.php ✏️ MODIFIÉ
│   │   │   ├── AdminController.php (existant)
│   │   │   ├── UserController.php (existant)
│   │   │   └── PartnerController.php ✏️ MODIFIÉ (ajout dashboard())
│   │   │
│   │   └── Middleware/
│   │       └── Authenticate.php (redirige vers /login si non-auth)
│   │
│   └── Models/
│       ├── User.php ✏️ MODIFIÉ
│       └── Fournisseur.php ✏️ MODIFIÉ
│
├── routes/
│   └── web.php ✏️ MODIFIÉ (ajout route partner.dashboard)
│
├── resources/
│   └── views/
│       ├── auth/
│       │   └── login.blade.php (existant - vue unique)
│       ├── admin/
│       │   └── dashboard.blade.php (existant)
│       ├── user/
│       │   └── dashboard.blade.php (existant)
│       └── partner/
│           ├── register.blade.php ✅ CRÉÉ
│           └── dashboard.blade.php ✅ CRÉÉ
│
└── database/
    ├── migrations/
    │   ├── 2026_02_04_000001_add_partner_fields_to_users_table.php
    │   └── 2026_02_04_000002_modify_fournisseurs_table.php
    │
    └── seeders/
        └── PartnerRolesAndPermissionsSeeder.php
```

---

## 5. Flux d'Enregistrement Partenaire

```
START
  │
  ├─→ GET /partner/register
  │   └─→ PartnerController@showRegisterForm()
  │       └─→ view('partner.register')
  │
  ├─→ REMPLIR FORMULAIRE
  │   ├─→ Name
  │   ├─→ Email
  │   ├─→ Password
  │   ├─→ Company Name
  │   ├─→ Telephone
  │   ├─→ WhatsApp (optionnel)
  │   ├─→ Website (optionnel)
  │   └─→ Description (optionnel)
  │
  ├─→ POST /partner/register
  │   └─→ PartnerController@register()
  │       │
  │       ├─→ Validator::make()
  │       │   ├─→ Validation règles
  │       │   └─→ IF erreurs: back()->withErrors()
  │       │
  │       ├─→ User::create()
  │       │   ├─→ name
  │       │   ├─→ email
  │       │   ├─→ password (hashed)
  │       │   ├─→ user_type = 'partner' ← CLIQUE!
  │       │   └─→ tel
  │       │
  │       ├─→ Fournisseur::create()
  │       │   ├─→ user_id (FK)
  │       │   ├─→ nom
  │       │   ├─→ status = 'pending_approval' ← CLIQUE!
  │       │   ├─→ phone_primary
  │       │   ├─→ email_primary
  │       │   ├─→ whatsapp_number
  │       │   ├─→ website
  │       │   ├─→ description
  │       │   └─→ notification_preferences (JSON)
  │       │
  │       ├─→ $user->assignRole('partner') ← CLIQUE!
  │       │
  │       ├─→ $user->update(['fournisseur_id' => ...])
  │       │
  │       └─→ redirect('index')->with('success', ...)
  │
  ├─→ EMAIL SENT (Phase 4)
  │   └─→ "Votre inscription est en attente d'approbation"
  │
  ├─→ ADMIN APPROVES (Via Admin Dashboard)
  │   ├─→ Fournisseur::find($id)
  │   └─→ update(['status' => 'approved', 'approved_at' => now(), ...])
  │
  ├─→ PARTNER LOGS IN
  │   └─→ /login
  │       ├─→ user_type = 'partner'
  │       ├─→ hasRole('partner') = true
  │       └─→ redirect('partner.dashboard')
  │
  └─→ END
```

---

## 6. Sécurité en Couches

```
┌─────────────────────────────────────────────────────────────┐
│                    SÉCURITÉ EN COUCHES                       │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  COUCHE 1: Middleware 'auth'                                │
│  ┌────────────────────────────────────────┐               │
│  │ if (!auth()->check()) {                 │               │
│  │   redirect('/login')                    │               │
│  │ }                                       │               │
│  └────────────────────────────────────────┘               │
│  ↓ Utilisateur non authentifié →  Login Page              │
│                                                              │
│  COUCHE 2: Vérification Type d'Utilisateur                 │
│  ┌────────────────────────────────────────┐               │
│  │ if ($user->user_type !== 'partner') {   │               │
│  │   return error('Access Denied')         │               │
│  │ }                                       │               │
│  └────────────────────────────────────────┘               │
│  ↓ Utilisateur non autorisé → Page d'erreur              │
│                                                              │
│  COUCHE 3: Double Vérification (user_type + role)          │
│  ┌────────────────────────────────────────┐               │
│  │ if (                                    │               │
│  │   $user->user_type !== 'partner'        │               │
│  │   && !$user->hasRole('partner')         │               │
│  │ ) { error(...) }                        │               │
│  └────────────────────────────────────────┘               │
│  ↓ Robustesse accrue via fallback                          │
│                                                              │
│  COUCHE 4: Permissions Spatie                              │
│  ┌────────────────────────────────────────┐               │
│  │ if (!$user->can('publish.offers')) {    │               │
│  │   return error('Permission Denied')     │               │
│  │ }                                       │               │
│  └────────────────────────────────────────┘               │
│  ↓ Permissions granulaires (Phase 2+)                      │
│                                                              │
└─────────────────────────────────────────────────────────────┘
```

---

## 7. Types d'Utilisateurs et Dashboards

```
┌──────────────────┬─────────────────────┬──────────────────────┐
│  Type            │  Dashboard URL      │  Contenu             │
├──────────────────┼─────────────────────┼──────────────────────┤
│  admin           │  /admin/dashboard   │  - Analytics         │
│                  │                     │  - Partner Approval  │
│                  │                     │  - Offer Approval    │
│                  │                     │  - Order Management  │
│                  │                     │  - User Management   │
│                  │                     │  - Reports           │
├──────────────────┼─────────────────────┼──────────────────────┤
│  partner         │  /partner/dashboard │  - Profile Info      │
│  (Fournisseur)   │                     │  - Approval Status   │
│                  │                     │  - My Offers (Ph.2)  │
│                  │                     │  - Inquiries (Ph.3)  │
│                  │                     │  - Timeline          │
│                  │                     │  - Notifications     │
├──────────────────┼─────────────────────┼──────────────────────┤
│  customer        │  /user/dashboard    │  - My Orders         │
│  (Client)        │                     │  - Favorites         │
│                  │                     │  - Wishlist          │
│                  │                     │  - Recent Searches   │
│                  │                     │  - Profile Settings  │
└──────────────────┴─────────────────────┴──────────────────────┘
```

---

## 8. Vérification de Sécurité (Test d'Accès Croisé)

```
┌─────────────────────────────────────────────────────────────┐
│  Test: Customer accédant à /partner/dashboard               │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  ✅ Étape 1: Middleware 'auth'                              │
│     └─ Customer est authentifié ✓                           │
│                                                              │
│  ✅ Étape 2: Vérification dans le Controller                │
│     └─ PartnerController@dashboard()                        │
│        if ($user->user_type !== 'partner') {                │
│          return redirect('/')->with('error', ...)           │
│        }                                                     │
│        ✓ Customer.user_type = 'customer' ≠ 'partner'        │
│        ✓ redirect('/') + error message                      │
│                                                              │
│  ✅ Résultat: Access Denied ✓                               │
│     └─ Redirect vers homepage avec message d'erreur         │
│                                                              │
└─────────────────────────────────────────────────────────────┘
```

---

## 9. Statuts d'Approbation des Partenaires

```
        ┌─────────────────────────────┐
        │  ENREGISTREMENT PARTENAIRE   │
        └──────────────┬──────────────┘
                       │
                       ▼
        ┌─────────────────────────────┐
        │  pending_approval ⏳         │
        │                             │
        │  - Email de confirmation    │
        │  - Dashboard réduit         │
        │  - En attente d'approbation  │
        │  - Admin review             │
        └──────────────┬──────────────┘
                       │
        ┌──────────────┴──────────────┐
        │                             │
        ▼                             ▼
  ┌──────────────┐          ┌──────────────┐
  │  approved ✅  │          │  rejected ❌  │
  │              │          │              │
  │ - Email OK   │          │ - Email KO   │
  │ - Full Access│          │ - No Access  │
  │ - Can Publish│          │ - Can Retry  │
  │ - Can Receive│          │ - Contact Us │
  │ - Offers OK  │          │ - Reason     │
  └──────────────┘          └──────────────┘
```

---

## 10. Timeline d'Intégration

```
AUJOURD'HUI (4 fév 2026)
├─ ✅ Phase 1: Authentification Multi-Rôles
│  ├─ Login unique page
│  ├─ Redirection intelligente
│  ├─ Dashboard partenaire
│  └─ Sécurité multicouches
│
├─ ⏳ Phase 2: Offres Partenaires (semaines 1-2)
│  ├─ PartnerOffer model
│  ├─ CRUD offres
│  ├─ Admin approval
│  └─ Partner list (clients)
│
├─ ⏳ Phase 3: Demandes/Inquiries (semaines 3-4)
│  ├─ Inquiry model
│  ├─ Timeline system
│  ├─ Admin coordination
│  └─ Partner responses
│
└─ ⏳ Phase 4: Notifications (semaines 5-6)
   ├─ WhatsApp service
   ├─ Email templates
   ├─ Notification logs
   └─ Advanced analytics
```

---

**Créé**: 4 février 2026  
**Version**: 1.0.0  
**Status**: ✅ Production Ready  
**Dernière mise à jour**: 4 février 2026 10:30

