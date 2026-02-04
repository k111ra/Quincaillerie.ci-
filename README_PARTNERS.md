# 🎉 MODULE PARTENAIRES - QUINCAILLERIE.CI

**Status**: ✅ MVP Phase 1 Déployé  
**Date**: 4 février 2026  
**Version**: 1.0.0

---

## 📖 TABLE DES MATIÈRES

1. [Vue d'ensemble](#vue-densemble)
2. [Installation](#installation)
3. [Utilisation](#utilisation)
4. [Documentation](#documentation)
5. [Architecture](#architecture)
6. [Roadmap](#roadmap)

---

## 👁️ Vue d'ensemble

Le module Partenaires permet aux fournisseurs, fabricants et prestataires de:
- ✅ **Créer un compte** en tant que partenaire
- ⏳ **Attendre l'approbation** de leur profil par l'admin
- 📝 **Publier des offres** (Phase 2)
- 💬 **Recevoir des demandes** de clients (Phase 2)
- 📊 **Gérer et répondre** aux demandes (Phase 3)
- 📱 **Recevoir des notifications** par Email + WhatsApp (Phase 4)

---

## 🚀 Installation

### Prérequis
- Laravel 9.x
- PHP 8.0+
- Base de données MySQL/MariaDB
- Spatie/laravel-permission installé

### Déploiement Automatisé (Windows)

```bash
# Ouvrir PowerShell/CMD dans le dossier du projet
cd c:\laragon\www\quincaillerie

# Exécuter le script de setup
.\setup_partners_module.bat
```

### Déploiement Automatisé (Linux/Mac)

```bash
cd /chemin/vers/quincaillerie
bash setup_partners_module.sh
```

### Déploiement Manuel

```bash
# 1. Lancer les migrations
php artisan migrate

# 2. Exécuter le seeder
php artisan db:seed --class=PartnerRolesAndPermissionsSeeder

# 3. Vider le cache
php artisan route:clear
php artisan config:clear
```

---

## 📝 Utilisation

### Pour les Partenaires

1. **S'inscrire**
   - Cliquer sur "Devenez Partenaire" dans le header
   - URL: `/partner/register`
   - Remplir le formulaire avec vos informations

2. **Attendre l'approbation**
   - Status: `pending_approval`
   - Email de confirmation quand approuvé

3. **Accéder au tableau de bord** (quand approuvé)
   - Publier des offres
   - Gérer les demandes reçues

### Pour les Admins

1. **Approuver les profils partenaires**
   - Panel admin (à venir en Phase 2)

2. **Gérer les offres**
   - Approuver/rejeter offres partenaires

3. **Gérer les demandes**
   - Coordination client + partenaire

---

## 📚 Documentation

### Guides de Déploiement
| Document | Contenu |
|----------|---------|
| [AUDIT_PARTNERS_MODULE.md](AUDIT_PARTNERS_MODULE.md) | Analyse complète structure projet (50+ pages) |
| [DEPLOY_GUIDE_PARTNERS_MVP.md](DEPLOY_GUIDE_PARTNERS_MVP.md) | Guide de déploiement avec checklist |
| [DEPLOY_SUMMARY.md](DEPLOY_SUMMARY.md) | Résumé d'exécution et statuts |

### Guides Utilisateur
| Document | Contenu |
|----------|---------|
| [PARTNER_GUIDE.md](PARTNER_GUIDE.md) | Guide pour les partenaires (inscription, FAQ) |
| [ARCHITECTURE_DIAGRAM.md](ARCHITECTURE_DIAGRAM.md) | Diagrammes et architecture système |

### Scripts et Tests
| Fichier | Usage |
|---------|-------|
| [setup_partners_module.bat](setup_partners_module.bat) | Setup automatisé (Windows) |
| [setup_partners_module.sh](setup_partners_module.sh) | Setup automatisé (Linux/Mac) |
| [TEST_PARTNERS_MVP.php](TEST_PARTNERS_MVP.php) | Commandes de test dans tinker |

---

## 🏗️ Architecture

### Composants Créés

**Controllers** (1):
- `PartnerController` - Inscription partenaires

**Models** (2 modifiés):
- `User` - Relations partenaire
- `Fournisseur` - Relations utilisateur + offres + demandes

**Migrations** (2):
- `add_partner_fields_to_users_table` - Colonnes user_type, fournisseur_id
- `modify_fournisseurs_table` - Colonnes complètes partenaire

**Views** (1):
- `partner/register.blade.php` - Formulaire d'inscription design

**Routes** (2):
- `GET /partner/register` → Formulaire
- `POST /partner/register` → Traitement

**Seeders** (1):
- `PartnerRolesAndPermissionsSeeder` - Rôles + permissions

**Header** (modifié):
- Bloc "Devenez Partenaire" → lien cliquable

### Stack Technologique
```
Frontend:
  └─ Blade templates
  └─ Bootstrap 5
  └─ Font Awesome 6

Backend:
  └─ Laravel 9
  └─ Spatie/laravel-permission
  └─ MySQL/MariaDB

Patterns:
  └─ MVC classique
  └─ Role-Based Access Control (RBAC)
  └─ Repository pattern (prêt pour Phase 2)
```

---

## 📊 Structure Base de Données

### Modifications Effectuées

**Table `users`** (ajouté):
```sql
user_type VARCHAR(50) DEFAULT 'customer'  -- customer|partner|admin
fournisseur_id BIGINT UNIQUE              -- FK à fournisseurs
is_verified BOOLEAN DEFAULT false
```

**Table `fournisseurs`** (enrichie):
```sql
user_id BIGINT UNIQUE              -- FK à users
status ENUM(...)                   -- pending_approval|active|inactive
phone_primary, phone_secondary     -- Téléphones
email_primary, email_secondary     -- Emails
whatsapp_number                    -- Pour notifications
website, description               -- Infos entreprise
approved_at, approved_by           -- Historique approbation
notification_preferences JSON      -- Préférences notifications
deleted_at TIMESTAMP               -- Soft delete
```

---

## 🔐 Rôles et Permissions

### Rôles Créés
- **partner** - Partenaire/fournisseur
- **admin** - Administrateur
- **customer** - Client (par défaut)

### Permissions Partenaire (6)
```
publish.offers              - Publier une offre
edit.own.offers            - Modifier ses offres
view.own.inquiries         - Voir ses demandes
respond.to.inquiries       - Répondre à une demande
view.own.profile           - Voir son profil
edit.own.profile           - Modifier son profil
```

### Permissions Admin (8)
```
manage.offers              - Gérer toutes offres
approve.offers             - Approuver offres
reject.offers              - Rejeter offres
manage.inquiries           - Gérer demandes
manage.partners            - Gérer partenaires
approve.partners           - Approuver partenaires
view.notification.logs     - Voir logs notifications
view.analytics             - Voir analytiques
```

---

## 🔄 Workflow d'Inscription

```
1. Partenaire visite /partner/register
2. Remplir formulaire (infos perso + entreprise)
3. Soumettre (POST /partner/register)
4. Validation serveur
5. Créer:
   - User (user_type = 'partner')
   - Fournisseur (status = 'pending_approval')
   - Assignation rôle 'partner'
6. Redirection accueil avec message "Inscription réussie"
7. Admin examine et approuve (Phase 2)
8. Partenaire accède au dashboard (Phase 2)
```

---

## 📋 Checklist de Déploiement

- [x] Routes créées et testées
- [x] Controller créé et validé
- [x] Views créées avec design moderne
- [x] Models étendus avec relations
- [x] Migrations lancées (2/2)
- [x] Seeder exécuté (rôles + permissions)
- [x] Header modifié (lien cliquable)
- [x] Documentation complète
- [x] Scripts setup fournis
- [x] Tests prêts à exécuter

---

## 🚦 Roadmap

### ✅ Phase 1: Inscription (Fait)
- [x] Formulaire d'enregistrement partenaire
- [x] Validation données
- [x] Création user + fournisseur
- [x] Assignation rôle 'partner'
- [x] Redirect + message succès

### 🔄 Phase 2: Offres (Prochaine - Semaine 3-4)
- [ ] Model `PartnerOffer`
- [ ] CRUD offres (Create, Read, Update, Delete)
- [ ] Approval workflow admin
- [ ] Views partner dashboard
- [ ] Admin approval dashboard

### 📋 Phase 3: Demandes (Semaine 5-6)
- [ ] Model `Inquiry`
- [ ] Model `InquiryMessage`
- [ ] Partner inquiry management
- [ ] Timeline + activity log
- [ ] Status workflow

### 📱 Phase 4: Notifications + Analytics (Semaine 7-8)
- [ ] WhatsAppService
- [ ] SendPartnerNotificationJob
- [ ] Email templates
- [ ] Notification logs
- [ ] Partner analytics
- [ ] Admin analytics dashboard

### 🎁 Phase 5: Améliorations (Semaine 9+)
- [ ] API REST partenaires
- [ ] Mobile app integrations
- [ ] Advanced filters/search
- [ ] Reporting
- [ ] Webhook events

---

## 🛠️ Commandes Utiles

```bash
# Voir les routes partenaires
php artisan route:list | grep partner

# Tester dans tinker
php artisan tinker

# Vérifier rôles
>>> Role::all()

# Vérifier permissions
>>> Permission::all()

# Vérifier utilisateur partenaire
>>> User::where('user_type', 'partner')->first()

# Lancer les tests (quand prêts)
php artisan test

# Clear cache
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

---

## 🐛 Troubleshooting

### Erreur: Route [partner.register] not defined
**Solution**: 
```bash
php artisan route:clear
php artisan route:cache
```

### Erreur: Table doesn't exist
**Solution**:
```bash
php artisan migrate
```

### Erreur: Class PartnerRolesAndPermissionsSeeder not found
**Solution**:
```bash
php artisan db:seed --class=PartnerRolesAndPermissionsSeeder
```

### Formulaire ne s'affiche pas
**Solution**:
- Vérifier: `resources/views/partner/register.blade.php` existe
- Vérifier logs: `storage/logs/laravel.log`
- Tester: `php artisan tinker` → `view('partner.register')`

---

## 📞 Support

Pour toute question ou problème:
- 📧 Email: dev@quincaillerie.ci
- 📖 Docs: Voir fichiers documentation
- 🐛 Issues: Rapporter dans le projet
- 💬 Chat: Contacter l'équipe

---

## 📜 Licence

Copyright © 2026 Quincaillerie.ci  
Tous droits réservés.

---

## 🙏 Remerciements

Merci aux partenaires et clients qui font la richesse de Quincaillerie.ci!

---

**Prêt à commencer? 🚀**

1. Exécutez le setup: `.\setup_partners_module.bat` (Windows)
2. Allez à: http://localhost/partner/register
3. Inscrivez-vous comme partenaire
4. Vérifiez les données en base

Bienvenue au réseau Quincaillerie.ci! 🎉

---

**Dernière mise à jour**: 4 février 2026  
**Status**: ✅ Production Ready (MVP Phase 1)
