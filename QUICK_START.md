# ⚡ QUICK START - MODULE PARTENAIRES

## 🚀 5 Minutes Pour Commencer

### Option 1: Setup Automatisé (Recommandé)

**Windows**:
```cmd
cd c:\laragon\www\quincaillerie
setup_partners_module.bat
```

**Linux/Mac**:
```bash
cd /chemin/vers/quincaillerie
bash setup_partners_module.sh
```

### Option 2: Setup Manuel

```bash
php artisan migrate
php artisan db:seed --class=PartnerRolesAndPermissionsSeeder
php artisan route:clear
```

---

## 📍 ACCÈS RAPIDE

| URL | Usage |
|-----|-------|
| `http://localhost/partner/register` | Formulaire inscription partenaire |
| `http://localhost/admin/dashboard` | Dashboard admin (Phase 2) |
| `http://localhost/partner/dashboard` | Dashboard partenaire (Phase 2) |

---

## 📝 EXEMPLE D'INSCRIPTION

**Email**: `partenaire@example.com`  
**Mot de passe**: `password123`  
**Entreprise**: `Mon Entreprise SARL`  
**Téléphone**: `+225 01 02 03 04`

→ Cliquer "Créer mon compte partenaire"

---

## 🔍 VÉRIFICATION RAPIDE

```bash
# Voir les rôles créés
php artisan tinker
>>> Role::all()

# Vérifier un partenaire
>>> User::where('user_type', 'partner')->first()
>>> User::find(1)->partner

# Tester le formulaire
>>> view('partner.register')
```

---

## 📊 BASE DE DONNÉES

**Tables modifiées**:
- `users` → +3 colonnes
- `fournisseurs` → +11 colonnes

**Tables créées**:
- `model_has_roles` (Spatie) - rôles utilisateurs

---

## 🔐 RÔLES CRÉÉS

- **partner** → Partenaires/fournisseurs
- **admin** → Administrateurs
- **customer** → Clients (défaut)

---

## 📚 DOCUMENTATION

| Fichier | Pour |
|---------|------|
| `README_PARTNERS.md` | Vue d'ensemble complète |
| `PARTNER_GUIDE.md` | Guide utilisateur partenaire |
| `DEPLOY_GUIDE_PARTNERS_MVP.md` | Déploiement détaillé |
| `ARCHITECTURE_DIAGRAM.md` | Diagrammes système |

---

## ⚠️ TROUBLESHOOTING RAPIDE

| Problème | Solution |
|----------|----------|
| Route not found | `php artisan route:clear` |
| Table not exist | `php artisan migrate` |
| Permission denied | `php artisan cache:clear` |
| View not found | Vérifier `resources/views/partner/` |

---

## 🎯 STATUS

✅ **Prêt à la production** (MVP Phase 1)

**Fonctionnalités**:
- ✅ Inscription partenaire
- ✅ Validation formulaire
- ✅ Création user + fournisseur
- ✅ Assignation rôle
- ⏳ Dashboard partenaire (Phase 2)
- ⏳ Gestion offres (Phase 2)
- ⏳ Demandes clients (Phase 3)
- ⏳ Notifications WhatsApp (Phase 4)

---

## 🚀 NEXT STEP

**Tester l'inscription**: 
→ http://localhost/partner/register

**Valider en base**:
```php
php artisan tinker
>>> User::where('user_type', 'partner')->first()
```

**Commencer Phase 2**:
→ Lire `README_PARTNERS.md`

---

**Créé**: 4 février 2026  
**Durée de setup**: ~5 minutes  
**Statut**: ✅ Opérationnel
