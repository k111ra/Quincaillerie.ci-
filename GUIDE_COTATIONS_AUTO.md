# Module Cotations Automatiques

Détecte automatiquement les demandes de devis/cotation reçues sur **info@quincaillerie.ci**, identifie les produits demandés, recherche les fournisseurs locaux (Abidjan), génère le devis PDF avec votre marge de **+35 %** (invisible pour le client) et l'envoie au client après votre validation.

## Fonctionnement (les 5 étapes)

| Étape | Action | Notification admin |
|---|---|---|
| 1 | Lecture IMAP de la boîte + détection des demandes de cotation (mots-clés pondérés : devis, cotation, proforma, demande de prix...) | ✉️ « Étape 1 — Demande détectée » |
| 2 | Extraction des produits + quantités (IA Claude si clé API fournie, sinon règles) | ✉️ « Étape 2 — Produits extraits » |
| 3 | Recherche fournisseurs : catalogue interne d'abord, liens de recherche web (Jumia CI, Google Shopping) en complément. Génération du **document interne fournisseurs** (contacts, liens d'achat, prix d'achat, marge) — CONFIDENTIEL | ✉️ « Étape 3 — Fournisseurs recherchés » |
| 4 | Calcul prix de vente = prix d'achat × 1,35 (arrondi aux 5 FCFA) + génération du **devis client PDF** (aucune mention de la marge) | ✉️ « Étape 4 — Devis prêt » |
| 5 | **Validation manuelle** dans l'admin puis envoi de l'email au client avec le PDF en pièce jointe | ✉️ « Étape 5 — Devis envoyé » |

## Installation

### 1. Installer la librairie IMAP

```bash
composer require webklex/php-imap
```

### 2. Lancer les migrations

```bash
php artisan migrate
```

Crée 3 tables : `quote_requests`, `quote_request_items`, `supplier_products`.

### 3. Configurer le fichier `.env`

```env
# --- Connexion à la boîte info@quincaillerie.ci ---
COTATION_IMAP_HOST=mail.quincaillerie.ci
COTATION_IMAP_PORT=993
COTATION_IMAP_ENCRYPTION=ssl
COTATION_IMAP_USERNAME=info@quincaillerie.ci
COTATION_IMAP_PASSWORD=votre_mot_de_passe

# --- Paramètres du module ---
COTATION_MARGIN_PERCENT=35
COTATION_ADMIN_EMAIL=info@quincaillerie.ci
COTATION_AUTO_SEND=false          # true = envoi sans validation (déconseillé)
COTATION_DETECTION_THRESHOLD=30   # score minimum /100

# --- Extraction IA (optionnel mais recommandé) ---
ANTHROPIC_API_KEY=sk-ant-...      # https://console.anthropic.com

# --- Vérifiez aussi que l'envoi SMTP est configuré ---
MAIL_MAILER=smtp
MAIL_HOST=mail.quincaillerie.ci
MAIL_PORT=465
MAIL_USERNAME=info@quincaillerie.ci
MAIL_PASSWORD=votre_mot_de_passe
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=info@quincaillerie.ci
MAIL_FROM_NAME="${APP_NAME}"
```

> Les paramètres IMAP exacts (host/port) dépendent de votre hébergeur email. Sur cPanel : `mail.votredomaine` port 993 SSL.

Puis :

```bash
php artisan config:clear
```

### 4. Activer le traitement automatique

Le module est planifié **toutes les 10 minutes** via le scheduler Laravel.

**En local (Laragon / Windows)** — laissez tourner :
```bash
php artisan schedule:work
```

**En production (Linux/cPanel)** — ajoutez ce cron :
```
* * * * * cd /chemin/du/projet && php artisan schedule:run >> /dev/null 2>&1
```

Test manuel à tout moment :
```bash
php artisan cotations:process
```
ou bouton **« Vérifier les emails maintenant »** dans l'admin.

### 5. Alimenter le catalogue fournisseurs (important)

La table `supplier_products` est la source prioritaire des prix d'achat. Pour chaque produit que vos fournisseurs d'Abidjan proposent, enregistrez : fournisseur, nom du produit, prix d'achat, unité, lien d'achat éventuel.

Exemple d'insertion rapide (Tinker ou seeder) :

```php
\App\Models\SupplierProduct::create([
    'fournisseur_id' => 1,
    'product_name' => 'Ciment 50kg CIM BENIN',
    'purchase_price' => 4500,
    'unit' => 'sac',
    'purchase_link' => 'https://exemple.ci/ciment-50kg',
]);
```

Plus ce catalogue est riche, plus les devis se préparent tout seuls. Les produits introuvables restent à compléter manuellement (des liens de recherche Jumia CI / Google Shopping sont proposés).

## Utilisation

1. Ouvrez **Admin → Cotations par email** (`/admin/cotations`).
2. Chaque demande détectée affiche : l'email d'origine, les produits extraits, les fournisseurs trouvés, les prix.
3. Complétez les prix d'achat manquants → le prix de vente (+35 %) se calcule automatiquement.
4. Téléchargez le **doc fournisseurs (interne)** — contacts, liens, marge — à ne jamais transmettre.
5. Vérifiez le **devis client (PDF)** — seuls les prix de vente y figurent.
6. Cliquez **« Valider et envoyer le devis au client »**.

## Fichiers du module

- `config/cotation.php` — configuration (marge, mots-clés, IMAP, sources web)
- `app/Services/Cotation/` — EmailFetcher, QuoteDetection, ProductExtraction, SupplierMatching, QuotePdf, AdminNotifier, CotationPipeline
- `app/Console/Commands/ProcessQuoteEmails.php` — commande `cotations:process`
- `app/Http/Controllers/QuoteRequestController.php` + `resources/views/admin/cotations/`
- `resources/views/pdf/devis-cotation.blade.php` (client) et `pdf/fournisseurs-doc.blade.php` (interne)
- `app/Mail/QuoteReplyMail.php` + `resources/views/emails/quote_reply.blade.php`
- PDFs générés dans `storage/app/cotations/`

## Sécurité de la marge

La marge (35 %) n'apparaît **que** dans le document interne fournisseurs et l'admin. Le devis client et l'email n'en font jamais mention.
