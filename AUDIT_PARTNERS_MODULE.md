# AUDIT STRUCTURE PROJET + PLAN D'INTÉGRATION MODULE PARTENAIRES

## ÉTAPE 1 : RÉSUMÉ STRUCTURE EXISTANTE DÉTECTÉE

### ✅ Architecture générale
- **Framework**: Laravel 9.x
- **Pattern**: Architecture "classique" Laravel (controllers thin + modèles)
- **Pas de**: Services layer, Repository pattern, ou DDD
- **Style**: Controllers directs → Views Blade
- **Auth**: Laravel native (Authenticatable) + Spatie/laravel-permission

### ✅ Authentification & Autorisation
- **Auth**: Laravel standard (middleware `auth`)
- **Rôles/Permissions**: **Spatie/laravel-permission v6.9** installé ✅
  - Tables: `roles`, `permissions`, `model_has_roles`, `model_has_permissions`, `role_has_permissions`
  - Trait `HasRoles` présent dans `User` model
  - Middlewares disponibles: `role`, `permission`, `role_or_permission`
  - Middleware custom: `AdminMiddleware`
  
### ✅ Structure Controllers
```
app/Http/Controllers/
├── AdminController.php              (dashboard admin basique)
├── UserController.php               (dashboard utilisateur)
├── OrderController.php              (gestion commandes existantes)
├── ProductController.php
├── ShopController.php
├── ServiceController.php
├── FournisseurControlleur.php       (EXISTE déjà ! - partenaire basique)
└── [Auth, dashboard, pages, UI...]  (admin templates)
```

### ✅ Structure Models
```
app/Models/
├── User.php                 (HasRoles, Notifiable)
├── Fournisseur.php         (supplier/partner - EXISTE MAIS VIDE!)
├── Order.php               (statuts: pending, shipped, delivered, cancelled)
├── OrderItem.php
├── Product.php             (avec slug, category, tags)
├── Category.php
├── Quote.php               (EXISTE MAIS VIDE!)
├── Service.php
├── CartItem.php
├── Favorite.py
├── Image.php
└── ...autres models
```

**🎯 Point clé**: 
- `Fournisseur` model existe mais est vide (pas de relations)
- `Quote` model existe mais est basique
- Table `fournisseurs` existe avec: id, nom, adresse, telephone, email, logo

### ✅ Routes
```
routes/web.php:
├── Public routes: /, /contact, /services, /shop, /product
├── Auth routes: /admin/dashboard, /user/dashboard, /checkout
├── Patterns: simple URL paths avec route names (no prefix groups actuellement)
└── Auth middleware: simple middleware(['auth']) wrapping
```

### ✅ Base de données - Migrations
- **Migrations actuelles**: 34 fichiers (OK)
- **Tables clés**: users, orders, order_items, products, categories, services, fournisseurs, quotes
- **Convention**: timestamps() standard, soft deletes NOT used
- **Permissions**: Spatie permission tables déjà créées (2024_09_19)

### ✅ UI & Views
```
resources/views/
├── admin/                  (admin dashboard)
├── user/                   (user dashboard)
├── partials/header.blade   (header.blade.php exists!)
├── layouts/                (layout templates)
├── [shop, product, checkout, contact, services...]
└── emails/                 (mail templates exist)
```

**Header actuel**: 
- Top bar: Promos, Favoris, Langue
- Logo, Recherche, Navigation menu
- Panier + Auth links
- "Devenez Partenaire" link exist! (line 367) → **HOOK POINT!**

### ✅ Notifications
- **Mail**: Configuré avec driver smtp/mailer
- **Queue**: driver `sync` (pas de Redis/Beanstalkd)
- **Jobs**: Standard Laravel jobs directory (si existe)
- **WhatsApp**: Pas de package installé → à ajouter

### ✅ Conventions de nommage
- Controllers: `SingularController.php` ou `PluralController.php`
- Models: PascalCase (User, Product, Order)
- Routes: snake-case (admin-dashboard → admin.dashboard)
- Blade files: kebab-case ou snake_case
- Migrations: timestamp_action_name.php
- Fillable: camelCase

### ✅ Assets & Storage
- **Public path**: `/public/` avec `/public/assets/`, `/public/css/`, `/public/front/`
- **Storage**: `storage/app/` (images, documents)
- **Mix/Webpack**: webpack.mix.js présent

---

## ÉTAPE 2 : STRATÉGIE D'INTÉGRATION (OPTION RECOMMANDÉE)

### 🎯 Décision: **OPTION A – Module Partenaires dans dossiers existants**

**Justification**:
✅ Projet ne suit pas DDD/Module pattern
✅ Simplicité maximale (ajouter dans controllers, models, routes existants)
✅ Cohérence avec architecture actuelle
✅ Zéro refactoring du code existant
✅ Table `fournisseurs` et `Quote` déjà créées
✅ Spatie Permission prêt à l'emploi

**Approche**:
1. Étendre `Fournisseur` model (relations)
2. Créer controllers: `PartnerDashboardController`, `OfferController`, `InquiryController`
3. Créer routes sous prefix `partner` (à ajouter)
4. Créer tables: `partner_offers`, `inquiries`, `inquiry_messages` (NEW)
5. Créer rôle "partner" dans seeder spatie
6. Views dans `resources/views/partner/` (NEW)
7. Services minimaux: `WhatsAppService`, `PartnerNotificationService`
8. Jobs: `SendPartnerNotification`, `SendCustomerNotification`

---

## ÉTAPE 3 : PLAN D'IMPLÉMENTATION PAR TOUCHPOINTS

### 🔴 FICHIERS À CRÉER (Nouveaux)

#### **Models** (3 fichiers)
```
app/Models/
├── PartnerOffer.php              (offre publiée par partenaire)
├── Inquiry.php                   (demande/commande admin-managed)
└── InquiryMessage.php            (messages dans l'inquiry workflow)
```

#### **Controllers** (3 fichiers)
```
app/Http/Controllers/
├── PartnerDashboardController.php   (partner view + respond to inquiries)
├── OfferController.php              (CRUD offres partenaire)
└── InquiryController.php            (admin dashboard gestion inquiries)
```

#### **Requests** (2 fichiers)
```
app/Http/Requests/
├── StoreOfferRequest.php
└── InquiryResponseRequest.php
```

#### **Services** (3 fichiers)
```
app/Services/
├── WhatsAppService.php             (notification WhatsApp)
├── PartnerNotificationService.php   (mail + whatsapp)
└── InquiryService.php              (business logic inquiries)
```

#### **Jobs** (2 fichiers)
```
app/Jobs/
├── SendPartnerNotificationJob.php
└── SendCustomerNotificationJob.php
```

#### **Notifications** (2 fichiers)
```
app/Notifications/
├── NewInquiryNotification.php
└── InquiryStatusChangedNotification.php
```

#### **Migrations** (4 fichiers)
```
database/migrations/
├── 2026_02_04_XXXXX_create_partner_offers_table.php
├── 2026_02_04_XXXXX_create_inquiries_table.php
├── 2026_02_04_XXXXX_create_inquiry_messages_table.php
└── 2026_02_04_XXXXX_add_role_to_users_table.php
```

#### **Seeders** (1 fichier)
```
database/seeders/
└── PartnerRolesAndPermissionsSeeder.php
```

#### **Policies** (1 fichier)
```
app/Policies/
└── InquiryPolicy.php
```

#### **Views** (12 fichiers)
```
resources/views/partner/
├── dashboard.blade.php
├── offers/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── inquiries/
│   ├── index.blade.php
│   └── show.blade.php
└── profile/
    └── index.blade.php

resources/views/admin/
├── offers/
│   ├── index.blade.php        (approval dashboard)
│   └── show.blade.php
├── inquiries/
│   ├── index.blade.php        (timeline, coordination)
│   └── show.blade.php
└── emails/
    ├── partner-new-inquiry.blade.php
    └── customer-status-change.blade.php
```

#### **Config** (1 fichier)
```
config/
└── partners.php                (feature flags, WhatsApp settings)
```

---

### 🟠 FICHIERS À MODIFIER (Existants)

#### **Models** (1 fichier)
```
app/Models/
└── Fournisseur.php
   - Ajouter relations: offers, inquiries, user
   - Ajouter Notifiable trait
```

#### **Controllers** (0 fichiers)
- Pas de modification directe
- Utiliser PartnerDashboardController au lieu d'AdminController pour partners

#### **Routes** (1 fichier)
```
routes/web.php
   - Ajouter prefix group 'partner' avec middleware ['auth', 'role:partner']
   - Ajouter routes admin inquiries
   - Ajouter route public pour "Devenir Partenaire"
```

#### **Config** (0 fichiers)
- Pas de modification de config existants

#### **Migrations** (0 fichiers)
- `fournisseurs` table existe déjà, ok

#### **User Model** (1 fichier)
```
app/Models/User.php
   - Ajouter relation partner: belongsTo(Fournisseur)
   - Ajouter method hasRole('partner')
```

#### **Views** (3 fichiers)
```
resources/views/partials/header.blade.php
   - Modifier ligne 367 "Devenez Partenaire" → route('partner.register')

resources/views/admin/dashboard.blade.php
   - Ajouter card/menu "Offres" + "Inquiries" avec counts

resources/views/layouts/app.blade.php
   - Ajouter partner menu si user is partner
```

#### **AppServiceProvider** (0 fichiers)
- Pas de modification (View composer existe)

---

## ÉTAPE 4 : SCHÉMA DB – TABLES À CRÉER/MODIFIER

### 📊 TABLE: `partner_offers` (NOUVELLE)
```sql
CREATE TABLE partner_offers (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    fournisseur_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description LONGTEXT,
    category VARCHAR(100),           -- product/service
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(500),
    status ENUM('draft', 'pending_approval', 'approved', 'rejected') DEFAULT 'draft',
    approval_reason TEXT,             -- motif rejet admin
    admin_approved_at TIMESTAMP NULL,
    approved_by BIGINT UNSIGNED,      -- admin user_id
    views_count INT DEFAULT 0,
    inquiries_count INT DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP NULL,        -- soft delete
    
    FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs(id) ON DELETE CASCADE,
    FOREIGN KEY (approved_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX (fournisseur_id),
    INDEX (status),
    INDEX (created_at)
);
```

### 📊 TABLE: `inquiries` (NOUVELLE)
```sql
CREATE TABLE inquiries (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    inquiry_number VARCHAR(50) UNIQUE NOT NULL,      -- INQ-202402-001
    customer_id BIGINT UNSIGNED NOT NULL,
    fournisseur_id BIGINT UNSIGNED NOT NULL,
    partner_offer_id BIGINT UNSIGNED,                -- from offer OR custom
    title VARCHAR(255) NOT NULL,
    description LONGTEXT,
    quantity INT,
    deadline_date DATE,                              -- quand besoin
    status ENUM('new', 'sent_to_partner', 'partner_responded', 'available', 'unavailable', 'closed', 'cancelled') DEFAULT 'new',
    admin_notes TEXT,                                -- internal notes
    partner_response TEXT,
    partner_availability ENUM('available', 'unavailable', 'partial') NULL,
    partner_response_deadline INT,                   -- délai en jours
    partner_responded_at TIMESTAMP NULL,
    customer_notified_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    closed_at TIMESTAMP NULL,
    
    FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs(id) ON DELETE CASCADE,
    FOREIGN KEY (partner_offer_id) REFERENCES partner_offers(id) ON DELETE SET NULL,
    INDEX (customer_id),
    INDEX (fournisseur_id),
    INDEX (status),
    INDEX (created_at),
    UNIQUE (inquiry_number)
);
```

### 📊 TABLE: `inquiry_messages` (NOUVELLE)
```sql
CREATE TABLE inquiry_messages (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    inquiry_id BIGINT UNSIGNED NOT NULL,
    sender_id BIGINT UNSIGNED NOT NULL,
    message TEXT,
    message_type ENUM('text', 'status_change', 'admin_note') DEFAULT 'text',
    action_type VARCHAR(50),                         -- e.g., 'status_changed_to_available'
    old_status VARCHAR(50),
    new_status VARCHAR(50),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (inquiry_id) REFERENCES inquiries(id) ON DELETE CASCADE,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX (inquiry_id),
    INDEX (sender_id),
    INDEX (created_at)
);
```

### 📊 TABLE: `partner_notification_logs` (NOUVELLE - AUDIT)
```sql
CREATE TABLE partner_notification_logs (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    fournisseur_id BIGINT UNSIGNED NOT NULL,
    inquiry_id BIGINT UNSIGNED,
    notification_type ENUM('email', 'whatsapp') NOT NULL,
    status ENUM('pending', 'sent', 'failed', 'retry') DEFAULT 'pending',
    phone_number VARCHAR(20),
    email VARCHAR(255),
    payload LONGTEXT,                               -- JSON request
    response LONGTEXT,                              -- JSON response
    error_message TEXT,
    retry_count INT DEFAULT 0,
    sent_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs(id) ON DELETE CASCADE,
    FOREIGN KEY (inquiry_id) REFERENCES inquiries(id) ON DELETE CASCADE,
    INDEX (fournisseur_id),
    INDEX (notification_type),
    INDEX (status),
    INDEX (created_at)
);
```

### 🔄 TABLE: `fournisseurs` – MODIFIER (ADD COLUMNS)
```sql
ALTER TABLE fournisseurs ADD (
    user_id BIGINT UNSIGNED UNIQUE,                 -- relation to user
    status ENUM('active', 'inactive', 'pending_approval') DEFAULT 'pending_approval',
    approved_at TIMESTAMP NULL,
    approved_by BIGINT UNSIGNED,                    -- admin user_id
    website VARCHAR(255),
    description LONGTEXT,
    phone_primary VARCHAR(20),
    phone_secondary VARCHAR(20),
    email_primary VARCHAR(255),
    email_secondary VARCHAR(255),
    whatsapp_number VARCHAR(20),
    notification_preferences JSON,                  -- {email: bool, whatsapp: bool}
    deleted_at TIMESTAMP NULL                       -- soft delete
);

-- Add indexes
ALTER TABLE fournisseurs ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
ALTER TABLE fournisseurs ADD FOREIGN KEY (approved_by) REFERENCES users(id) ON DELETE SET NULL;
ALTER TABLE fournisseurs ADD INDEX (status);
ALTER TABLE fournisseurs ADD INDEX (user_id);
```

### 🔄 TABLE: `users` – MODIFY (ADD COLUMNS)
```sql
ALTER TABLE users ADD (
    user_type ENUM('customer', 'partner', 'admin') DEFAULT 'customer',
    fournisseur_id BIGINT UNSIGNED UNIQUE,          -- si partner
    is_verified BOOLEAN DEFAULT FALSE
);

ALTER TABLE users ADD FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs(id) ON DELETE CASCADE;
ALTER TABLE users ADD INDEX (user_type);
```

### 📋 Autres tables existantes (no change)
- `orders`, `order_items` – réutiliser pour les "customer" orders de produits
- `quotes` – POURRAIT être rebranché si besoin (actuellement vide)
- `categories`, `products`, `services` – OK

---

## ÉTAPE 5 : ROUTES (Exemples concrets)

### 🌐 Routes Publiques (à ajouter à `routes/web.php`)
```php
// Partner Registration & Login (public)
Route::get('/partner/register', [PartnerController::class, 'showRegisterForm'])->name('partner.register');
Route::post('/partner/register', [PartnerController::class, 'register'])->name('partner.register.store');
Route::get('/partner/login', [PartnerController::class, 'showLoginForm'])->name('partner.login');

// View Partner Offers (public)
Route::get('/partners', [PublicPartnerController::class, 'index'])->name('partners.index');
Route::get('/partner/{slug}', [PublicPartnerController::class, 'show'])->name('partner.show');
Route::get('/offer/{slug}', [PublicOfferController::class, 'show'])->name('offer.show');

// Create Inquiry from Offer (public, no auth)
Route::post('/offer/{id}/inquiry', [PublicOfferController::class, 'createInquiry'])->name('offer.inquiry');
```

### 🔐 Routes Partner (avec middleware `auth`, `role:partner`)
```php
Route::middleware(['auth', 'role:partner'])->prefix('partner')->name('partner.')->group(function () {
    Route::get('/dashboard', [PartnerDashboardController::class, 'index'])->name('dashboard');
    
    // Offers CRUD
    Route::resource('offers', OfferController::class)->except(['destroy']);
    Route::get('offers/{offer}/analytics', [OfferController::class, 'analytics'])->name('offers.analytics');
    
    // Inquiries - Partner can only view & respond to own
    Route::get('inquiries', [PartnerInquiryController::class, 'index'])->name('inquiries.index');
    Route::get('inquiries/{inquiry}', [PartnerInquiryController::class, 'show'])->name('inquiries.show');
    Route::post('inquiries/{inquiry}/respond', [PartnerInquiryController::class, 'respond'])->name('inquiries.respond');
    
    // Profile
    Route::get('profile', [PartnerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [PartnerProfileController::class, 'update'])->name('profile.update');
});
```

### 🎛️ Routes Admin (avec middleware `auth`, `role:admin`)
```php
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard - ajouter counts
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Offers Management
    Route::resource('offers', AdminOfferController::class)->only(['index', 'show', 'update']);
    Route::post('offers/{offer}/approve', [AdminOfferController::class, 'approve'])->name('offers.approve');
    Route::post('offers/{offer}/reject', [AdminOfferController::class, 'reject'])->name('offers.reject');
    
    // Inquiries Management
    Route::resource('inquiries', AdminInquiryController::class)->only(['index', 'show', 'update']);
    Route::post('inquiries/{inquiry}/status', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.status');
    Route::post('inquiries/{inquiry}/notify', [AdminInquiryController::class, 'notifyPartner'])->name('inquiries.notify');
    
    // Partner Management
    Route::resource('partners', AdminPartnerController::class)->only(['index', 'show', 'update']);
    Route::post('partners/{partner}/approve', [AdminPartnerController::class, 'approve'])->name('partners.approve');
    Route::post('partners/{partner}/deactivate', [AdminPartnerController::class, 'deactivate'])->name('partners.deactivate');
    
    // Logs
    Route::get('notification-logs', [AdminLogsController::class, 'notificationLogs'])->name('logs.notifications');
});
```

---

## ÉTAPE 6 : POLICIES & PERMISSIONS (Spatie)

### 🔐 Rôles à créer (DatabaseSeeder ou PartnerRolesAndPermissionsSeeder)
```php
// ROLES
- 'admin'       // manage all
- 'partner'     // publish offers, respond to inquiries
- 'customer'    // view offers, create inquiries (default)

// PERMISSIONS
- manage.offers              (admin only)
- approve.offers            (admin only)
- manage.inquiries          (admin only)
- view.partner.inquiries    (partner: own inquiries)
- respond.inquiries         (partner: own inquiries)
- publish.offers            (partner)
- view.offers               (all)
```

### 🎯 Policy: `InquiryPolicy`
```php
public function view(User $user, Inquiry $inquiry) {
    return $user->id === $inquiry->customer_id ||
           ($user->partner && $user->partner->id === $inquiry->fournisseur_id) ||
           $user->hasRole('admin');
}

public function respond(User $user, Inquiry $inquiry) {
    return $user->partner && $user->partner->id === $inquiry->fournisseur_id;
}

public function update(User $user, Inquiry $inquiry) {
    return $user->hasRole('admin');
}
```

---

## ÉTAPE 7 : NOTIFICATIONS & JOBS

### 📧 Notifications (app/Notifications/)

#### `NewInquiryNotification.php`
```php
class NewInquiryNotification extends Notification {
    public function via() {
        return ['mail', 'database'];  // + custom 'whatsapp' later
    }
    
    public function toMail() {
        return (new MailMessage)
            ->subject('Nouvelle demande reçue')
            ->greeting('Bonjour {partner.nom}')
            ->line('Vous avez reçu une nouvelle demande:')
            ->line("Titre: {inquiry.title}")
            ->action('Voir la demande', url(...));
    }
}
```

#### `InquiryStatusChangedNotification.php`
```php
class InquiryStatusChangedNotification extends Notification {
    public function via() {
        return ['mail', 'database'];
    }
    
    public function toMail() {
        return (new MailMessage)
            ->subject('Statut de votre demande mis à jour')
            ->line("Votre demande #{inquiry.inquiry_number} est maintenant: {status}");
    }
}
```

### 🔔 Jobs (app/Jobs/)

#### `SendPartnerNotificationJob.php`
```php
class SendPartnerNotificationJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function handle(InquiryService $inquiryService, PartnerNotificationService $notificationService) {
        // 1. Send Email
        $partner->notify(new NewInquiryNotification($inquiry));
        
        // 2. Send WhatsApp
        if ($partner->notification_preferences['whatsapp']) {
            dispatch(new SendWhatsAppNotificationJob($partner, $inquiry));
        }
        
        // 3. Log
        PartnerNotificationLog::create([...]);
    }
}
```

#### `SendWhatsAppNotificationJob.php`
```php
class SendWhatsAppNotificationJob implements ShouldQueue {
    public function handle(WhatsAppService $whatsApp) {
        $whatsApp->sendMessage(
            phone: $partner->whatsapp_number,
            message: "Nouvelle demande: {inquiry.title}..."
        );
        
        // Log response
        PartnerNotificationLog::create([
            'status' => 'sent',
            'response' => $response
        ]);
    }
}
```

### 🌐 WhatsApp Service (app/Services/WhatsAppService.php)
```php
class WhatsAppService {
    protected $apiUrl = 'https://api.whatsapp.com/send'; // or Twilio/other provider
    protected $apiKey;
    
    public function sendMessage(string $phone, string $message): array {
        $response = Http::post($this->apiUrl, [
            'phone' => $phone,
            'message' => $message,
            'api_key' => $this->apiKey,
        ]);
        
        return [
            'status' => $response->status() === 200 ? 'sent' : 'failed',
            'response' => $response->json(),
        ];
    }
}
```

---

## ÉTAPE 8 : UI – MENUS & TEMPLATES

### 🎨 Header Modification (resources/views/partials/header.blade.php)

**Ligne 367** (Devenez Partenaire):
```blade
<!-- AVANT -->
<div class="user_zone_block d-flex flex-row align-items-center justify-content-end ml-auto">
    <div class="icon"><i class="fa fa-gift"></i></div>
    <h6 class="text">Devenez Partenaire</h6>
</div>

<!-- APRÈS -->
<div class="user_zone_block d-flex flex-row align-items-center justify-content-end ml-auto">
    <a href="{{ route('partner.register') }}" class="d-flex flex-row align-items-center">
        <div class="icon"><i class="fa fa-gift"></i></div>
        <h6 class="text">Devenez Partenaire</h6>
    </a>
</div>
```

### 🎯 Admin Dashboard Addition (resources/views/admin/dashboard.blade.php)

Ajouter dans la section dashboard cards:
```blade
<!-- Offers Approval Card -->
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h5>Offres en attente</h5>
            <h2>{{ \App\Models\PartnerOffer::where('status', 'pending_approval')->count() }}</h2>
            <a href="{{ route('admin.offers.index') }}" class="btn btn-sm btn-primary">Examiner</a>
        </div>
    </div>
</div>

<!-- Inquiries Card -->
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h5>Demandes (Non traitées)</h5>
            <h2>{{ \App\Models\Inquiry::whereIn('status', ['new', 'sent_to_partner'])->count() }}</h2>
            <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm btn-primary">Gérer</a>
        </div>
    </div>
</div>

<!-- Partners Card -->
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h5>Partenaires actifs</h5>
            <h2>{{ \App\Models\Fournisseur::where('status', 'active')->count() }}</h2>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-sm btn-primary">Liste</a>
        </div>
    </div>
</div>
```

### 👥 Partner Sidebar Menu (resources/views/layouts/sidebar.blade.php - NEW)

```blade
@if(auth()->user()->hasRole('partner'))
<ul class="navbar-nav">
    <li class="nav-item">
        <a href="{{ route('partner.dashboard') }}" class="nav-link">
            <i class="fa fa-home"></i> Tableau de bord
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('partner.offers.index') }}" class="nav-link">
            <i class="fa fa-box"></i> Mes Offres
            <span class="badge">{{ auth()->user()->partner->offers()->count() }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('partner.inquiries.index') }}" class="nav-link">
            <i class="fa fa-envelope"></i> Demandes
            <span class="badge">{{ auth()->user()->partner->inquiries()->where('status', '!=', 'closed')->count() }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('partner.profile.edit') }}" class="nav-link">
            <i class="fa fa-user"></i> Profil
        </a>
    </li>
</ul>
@endif
```

---

## ÉTAPE 9 : MVP (2 SEMAINES) vs V2 (6 SEMAINES)

### 🎯 MVP – SEMAINE 1-2 (Core functionality)
**Livrable**: Partenaires peuvent créer offres (admin approve) + clients créent inquiries + partenaires voient inquiries

#### Week 1:
- [ ] Migrations: fournisseurs, partner_offers, inquiries tables
- [ ] Models: PartnerOffer, Inquiry, InquiryMessage
- [ ] Controllers: OfferController (partner), AdminOfferController (admin)
- [ ] Views: partner/offers CRUD, admin/offers approval
- [ ] Routes: partner.offers.*, admin.offers.*
- [ ] Spatie: Create 'partner' role + permissions
- [ ] Tests: Basic CRUD tests

#### Week 2:
- [ ] Controllers: PartnerInquiryController, AdminInquiryController
- [ ] Views: partner/inquiries, admin/inquiries management
- [ ] Notifications: Email when new inquiry + when status changes
- [ ] Jobs: SendPartnerNotificationJob (email only, sync queue)
- [ ] UI: Header link + Admin dashboard cards
- [ ] Documentation: README for partners

**✅ MVP Ready**: Partners publish offers → Admin approve → Customers inquire → Partners see inquiries

---

### 🚀 V2 – SEMAINE 3-6 (Advanced features)

#### Week 3-4: WhatsApp + Advanced Notifications
- [ ] WhatsAppService integration (Twilio/official API)
- [ ] SendWhatsAppNotificationJob
- [ ] Notification logs table + dashboard
- [ ] Retry logic for failed messages
- [ ] Partner notification preferences UI

#### Week 5: Admin Coordination
- [ ] Inquiry timeline view (activity log)
- [ ] Admin can add notes/messages to inquiry
- [ ] Automated status workflow
- [ ] Admin notification when partner responds
- [ ] Email templates (responsive Blade)

#### Week 6: Analytics + Polish
- [ ] Partner analytics: offer views, conversion rate
- [ ] Admin dashboard: metrics (pending approvals, response time)
- [ ] Search/filter: offers + inquiries
- [ ] Partner public profile page
- [ ] Unit + Feature tests (PHPUnit)
- [ ] Documentation complete

**✅ V2 Complete**: Full workflow + WhatsApp + Analytics + Admin coordination

---

## ÉTAPE 10 : RISQUES & TESTS

### ⚠️ Risques identifiés

| Risque | Probabilité | Impact | Mitigation |
|--------|------------|--------|-----------|
| Surcharge de `users` table (ajouter `user_type`, `fournisseur_id`) | Faible | Moyen | Bien indexer, migration progressive |
| Queue driver `sync` (pas async) | Moyen | Moyen | Config pour passer à `database` queue si scaling |
| WhatsApp API cost/rate limits | Moyen | Moyen | Implement retry + logging, feature flag |
| Permission conflicts (partner vs customer = same user) | Faible | Haut | Seed proper roles, tests |
| Notification spam (multi-sends) | Faible | Moyen | Check `partner_notification_logs` before sending |
| Storage/images for offers | Faible | Faible | Use existing `storage/` + Disk 'local' |

### ✅ Tests à faire (PHPUnit)

#### Unit Tests
```php
tests/Unit/
├── Models/PartnerOfferTest.php        (scope, relations)
├── Models/InquiryTest.php
├── Services/WhatsAppServiceTest.php
└── Services/PartnerNotificationServiceTest.php
```

#### Feature Tests
```php
tests/Feature/
├── Partner/OfferCRUDTest.php           (create, update, delete)
├── Partner/InquiryResponseTest.php
├── Admin/OfferApprovalTest.php
├── Admin/InquiryManagementTest.php
├── Auth/PartnerAuthTest.php
└── Notifications/NotificationTest.php
```

#### Integration Tests
```php
// Full workflow:
1. Partner registers
2. Creates offer
3. Admin approves
4. Customer views + creates inquiry
5. Partner responds
6. Admin closes
7. Customer notified
```

---

## RÉSUMÉ FINAL

✅ **Architecture**: Étendue cohérente, zero refactoring
✅ **Tables**: 4 nouvelles + 2 existantes modifiées
✅ **Controllers**: 6 nouveaux (partner + admin)
✅ **Routes**: 2 groupes prefixés (partner, admin)
✅ **Permissions**: Spatie prêt, 3 rôles + permissions
✅ **Notifications**: Email + WhatsApp ready
✅ **UI**: Blade simple, réutilise header existant
✅ **Timeline**: MVP 2 sem + V2 4 sem
✅ **Risques**: Identifiés + mitigations

**Prêt à commencer ?** 🚀
