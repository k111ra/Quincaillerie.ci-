# 📊 ARCHITECTURE MODULE PARTENAIRES - DIAGRAMME

## Flux d'Inscription Partenaire

```
┌─────────────────────────────────────────────────────────────┐
│                    ACCUEIL QUINCAILLERIE.CI                  │
│                                                              │
│  [Header] → Cliquer "Devenez Partenaire"                   │
│             ↓                                                │
│  → GET /partner/register (PartnerController@showRegisterForm)
│             ↓                                                │
│  → Affiche: resources/views/partner/register.blade.php      │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  FORMULAIRE D'INSCRIPTION PARTENAIRE                │   │
│  │  ════════════════════════════════════════════════════│   │
│  │                                                       │   │
│  │  Section 1: Informations Personnelles               │   │
│  │  ├─ Nom complet *                                  │   │
│  │  ├─ Email * (unique)                              │   │
│  │  ├─ Mot de passe * (min 8)                        │   │
│  │  └─ Confirmer mot de passe *                      │   │
│  │                                                       │   │
│  │  Section 2: Informations Entreprise                │   │
│  │  ├─ Nom entreprise *                              │   │
│  │  ├─ Téléphone *                                   │   │
│  │  ├─ WhatsApp (optionnel)                          │   │
│  │  ├─ Site web (optionnel)                          │   │
│  │  └─ Description activité (optionnel)              │   │
│  │                                                       │   │
│  │  [CRÉER MON COMPTE PARTENAIRE] ✓                  │   │
│  └──────────────────────────────────────────────────────┘   │
│             ↓                                                │
│  POST /partner/register (PartnerController@register)        │
└─────────────────────────────────────────────────────────────┘
                         ↓
        ┌────────────────────────────────────┐
        │   VALIDATIONS CÔTÉ SERVEUR         │
        ├────────────────────────────────────┤
        │ ✓ Email unique                     │
        │ ✓ Mot de passe confirmé           │
        │ ✓ Champs requis                   │
        │ ✓ Format téléphone                │
        │ ✓ URL valide (site web)           │
        └────────────────────────────────────┘
                         ↓
        ┌────────────────────────────────────┐
        │     CRÉATION DONNÉES EN BASE        │
        ├────────────────────────────────────┤
        │                                    │
        │  1. INSERT INTO users              │
        │     ├─ name, email, password (hash)│
        │     ├─ tel                         │
        │     ├─ user_type = 'partner'       │
        │     └─ created_at = NOW()          │
        │                                    │
        │  2. INSERT INTO fournisseurs       │
        │     ├─ user_id (FK)                │
        │     ├─ nom                         │
        │     ├─ status = 'pending_approval' │
        │     ├─ whatsapp_number             │
        │     ├─ notification_preferences    │
        │     └─ created_at = NOW()          │
        │                                    │
        │  3. INSERT INTO model_has_roles    │
        │     ├─ role_id = 'partner'         │
        │     ├─ model_id = user.id          │
        │     └─ model_type = 'App\\Models\\User'
        │                                    │
        └────────────────────────────────────┘
                         ↓
        ┌────────────────────────────────────┐
        │         REDIRECTION                │
        ├────────────────────────────────────┤
        │  GET / (accueil)                   │
        │  Avec message:                     │
        │  "Inscription réussie!             │
        │   Nous examinons votre profil..."  │
        └────────────────────────────────────┘
```

---

## Structure Base de Données

```
┌──────────────────────────────────────────────────────────────┐
│                    USERS TABLE                                │
├──────────────────────────────────────────────────────────────┤
│ id         │ BIGINT (PRIMARY KEY)                             │
│ name       │ VARCHAR(255)                                     │
│ email      │ VARCHAR(255) UNIQUE                              │
│ password   │ VARCHAR(255) - HASHED                            │
│ tel        │ VARCHAR(20)                                      │
│ user_type  │ ENUM('customer', 'partner', 'admin')            │ ← NEW
│ fournisseur_id │ BIGINT FOREIGN KEY (fournisseurs.id)        │ ← NEW
│ is_verified    │ BOOLEAN DEFAULT false                        │ ← NEW
│ created_at │ TIMESTAMP                                        │
│ updated_at │ TIMESTAMP                                        │
└──────────────────────────────────────────────────────────────┘
                           ↓ FK
┌──────────────────────────────────────────────────────────────┐
│              FOURNISSEURS TABLE                               │
├──────────────────────────────────────────────────────────────┤
│ id                    │ BIGINT (PRIMARY KEY)                  │
│ user_id              │ BIGINT FOREIGN KEY (users.id)         │ ← NEW
│ nom                  │ VARCHAR(255)                           │
│ status               │ ENUM('active', 'inactive',            │ ← NEW
│                      │       'pending_approval')              │
│ phone_primary        │ VARCHAR(20)                            │ ← NEW
│ phone_secondary      │ VARCHAR(20)                            │ ← NEW
│ email_primary        │ VARCHAR(255)                           │ ← NEW
│ email_secondary      │ VARCHAR(255)                           │ ← NEW
│ whatsapp_number      │ VARCHAR(20)                            │ ← NEW
│ website              │ VARCHAR(255)                           │ ← NEW
│ description          │ LONGTEXT                               │ ← NEW
│ approved_at          │ TIMESTAMP NULL                         │ ← NEW
│ approved_by          │ BIGINT FK (users.id)                  │ ← NEW
│ notification_prefs   │ JSON                                   │ ← NEW
│ created_at           │ TIMESTAMP                              │
│ updated_at           │ TIMESTAMP                              │
│ deleted_at           │ TIMESTAMP NULL (soft delete)           │ ← NEW
└──────────────────────────────────────────────────────────────┘
                           ↓ FK (Spatie)
┌──────────────────────────────────────────────────────────────┐
│         MODEL_HAS_ROLES TABLE (Spatie)                        │
├──────────────────────────────────────────────────────────────┤
│ role_id    │ BIGINT (FK roles.id)                             │
│ model_type │ VARCHAR (App\Models\User)                        │
│ model_id   │ BIGINT (FK users.id)                             │
│ created_at │ TIMESTAMP                                        │
└──────────────────────────────────────────────────────────────┘
```

---

## Rôles et Permissions

```
┌───────────────────────────────────────────────────────────┐
│                       RÔLES                               │
├───────────────────────────────────────────────────────────┤
│                                                           │
│ PARTNER (Fournisseur)                                    │
│ ├─ publish.offers                                        │
│ ├─ edit.own.offers                                       │
│ ├─ view.own.inquiries                                    │
│ ├─ respond.to.inquiries                                  │
│ ├─ view.own.profile                                      │
│ └─ edit.own.profile                                      │
│                                                           │
│ ADMIN                                                     │
│ ├─ manage.offers                                         │
│ ├─ approve.offers                                        │
│ ├─ reject.offers                                         │
│ ├─ manage.inquiries                                      │
│ ├─ manage.partners                                       │
│ ├─ approve.partners                                      │
│ ├─ view.notification.logs                               │
│ └─ view.analytics                                        │
│ + TOUTES les permissions client                          │
│                                                           │
│ CUSTOMER (Client)                                        │
│ ├─ view.offers                                           │
│ ├─ create.inquiry                                        │
│ ├─ view.own.inquiries                                    │
│ ├─ view.own.profile                                      │
│ └─ edit.own.profile                                      │
│                                                           │
└───────────────────────────────────────────────────────────┘
```

---

## Controllers - Responsabilités

```
┌──────────────────────────────────────────────────────────┐
│        PartnerController                                  │
├──────────────────────────────────────────────────────────┤
│                                                          │
│ showRegisterForm()                                       │
│ │                                                        │
│ └─ return view('partner.register')                      │
│                                                          │
│ register(Request $request)                              │
│ │                                                        │
│ ├─ Valider les données                                  │
│ ├─ Créer User {                                         │
│ │   name, email, password (hash),                       │
│ │   tel, user_type = 'partner'                          │
│ │ }                                                      │
│ ├─ Créer Fournisseur {                                  │
│ │   user_id, nom, telephone, whatsapp_number,           │
│ │   email, website, description,                        │
│ │   status = 'pending_approval'                         │
│ │ }                                                      │
│ ├─ Assigner rôle 'partner' → user                      │
│ ├─ Lier user.fournisseur_id                            │
│ └─ Rediriger vers accueil avec succès                   │
│                                                          │
└──────────────────────────────────────────────────────────┘
```

---

## Fichiers Créés/Modifiés

```
✅ CRÉÉS
├── app/Http/Controllers/PartnerController.php
├── resources/views/partner/register.blade.php
├── database/seeders/PartnerRolesAndPermissionsSeeder.php
├── database/migrations/2026_02_04_000001_add_partner_fields_to_users_table.php
├── database/migrations/2026_02_04_000002_modify_fournisseurs_table.php
├── AUDIT_PARTNERS_MODULE.md
├── DEPLOY_GUIDE_PARTNERS_MVP.md
├── DEPLOY_SUMMARY.md
├── PARTNER_GUIDE.md
├── setup_partners_module.sh
├── setup_partners_module.bat
└── TEST_PARTNERS_MVP.php

✏️ MODIFIÉS
├── routes/web.php (+ 2 routes + import)
├── app/Models/User.php (+ fillable + relations)
├── app/Models/Fournisseur.php (complètement refondu)
└── resources/views/partials/header.blade.php (lien cliquable)
```

---

## Processus de Validation

```
INPUT → VALIDATION → RÈGLES → RÉSULTAT
│         │
│         ├─ Email unique dans users table
│         ├─ Mot de passe min 8 caractères
│         ├─ Mot de passe confirmé
│         ├─ Champs requis non vides
│         └─ Format téléphone/URL valides
│
└─ SI ERREUR → Rediriger avec erreurs (Flash)
└─ SI OK → Créer User + Fournisseur + Rôle
```

---

## Status Fournisseur - Cycle de Vie

```
┌─────────────────────────────────────────┐
│  INSCRIPTION PARTENAIRE                  │
│  ↓                                       │
│  status = 'pending_approval'            │
│  ├─ Admin examine profil                │
│  │  ↓                                    │
│  │  APPROUVÉ? OUI → status = 'active'  │
│  │             (approved_at = NOW)      │
│  │             (approved_by = admin)    │
│  │             ↓                         │
│  │             Partenaire peut:         │
│  │             • Publier offres         │
│  │             • Voir demandes          │
│  │             • Répondre demandes      │
│  │                                       │
│  │  APPROUVÉ? NON → status = 'inactive'│
│  │             (or deleted = soft del)  │
│  │             ↓                         │
│  │             Partenaire informé       │
│  │             (peut renouveler)        │
│  │                                       │
└─────────────────────────────────────────┘
```

---

## Prochaines Phases (Phases 2-4)

```
PHASE 2: OFFRES
├── PartnerOffer Model
├── OfferController (CRUD)
├── OfferPolicy (authorization)
└── partner/offers/* views

PHASE 3: DEMANDES (INQUIRIES)
├── Inquiry Model
├── InquiryMessage Model
├── InquiryController
└── partner/inquiries/* views

PHASE 4: NOTIFICATIONS + ANALYTICS
├── WhatsAppService
├── SendPartnerNotificationJob
├── AdminDashboard enhancements
└── Analytics endpoints
```

---

## Timeline

```
JOUR 1-2: ✅ INSCRIPTION (FAIT)
├─ PartnerController
├─ Routes
├─ Views
├─ Migrations
└─ Seeder

JOUR 3-4: OFFRES (PROCHAIN)
├─ PartnerOffer Model
├─ CRUD Offres
└─ Admin Approval

JOUR 5-6: DEMANDES (PUIS)
├─ Inquiry Model
├─ InquiryMessage
└─ Coordination

JOUR 7-8: NOTIFICATIONS + ANALYTICS (APRÈS)
├─ WhatsApp Service
├─ Email Templates
└─ Dashboards
```

---

**Créé**: 4 février 2026  
**Phase Actuelle**: MVP - Inscription ✅  
**Status Global**: 30% complété
