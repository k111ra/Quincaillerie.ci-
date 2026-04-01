# Guide d'utilisation - Import et Gestion des Produits

## 📋 Vue d'ensemble

Le nouveau système de gestion des produits offre :
- **Import en masse** via fichier CSV
- **Export des produits** au format CSV  
- **Filtrage avancé** par catégorie, fournisseur, et terme de recherche
- **Tri personnalisable** (prix, nom, date)
- **Interface reorganisée** plus intuitive et efficace

## 🚀 Accès aux fonctionnalités

Toutes les fonctionnalités sont accessibles depuis la page **Admin > Gestion des produits** :
- URL : `/admin/products`

## 📤 Importer des produits

### Accéder au formulaire d'import
1. Allez à : **Admin > Gestion des produits**
2. Cliquez sur le bouton **"Importer"** (bleu)
3. Ou accédez directement à : `/admin/products/import/form`

### Format du fichier CSV

Le fichier CSV doit contenir les colonnes suivantes :

| Colonne | Type | Obligatoire | Description |
|---------|------|---------|-------------|
| `nom` | Texte | ✓ | Nom du produit (max 255 caractères) |
| `prix` | Nombre | ✓ | Prix en euros (format: 19.99) |
| `description` | Texte | ✗ | Description du produit |
| `quantite` | Nombre | ✗ | Quantité en stock (défaut: 0) |

### Exemple de fichier CSV

```csv
nom,prix,description,quantite
Peinture acrylique blanc,12.99,Peinture acrylique haute qualité blanc pur 1L,50
Pinceau synthétique rond 8,3.50,Pinceau synthétique idéal pour détails,200
Vernis transparent mat,15.99,Vernis transparent mat protection UV,60
Toile coton 40x50,8.99,Toile pré-tendue coton 100% 40x50cm,120
```

### Télécharger un fichier exemple

Un fichier exemple est disponible pour télécharger :
- URL : `/exemple_produits.csv`
- Accessible depuis le formulaire d'import

### Étapes d'import

1. **Sélectionnez une catégorie** - Tous les produits importés seront assignés à cette catégorie
2. **Sélectionnez un fournisseur** - Tous les produits importés seront liés à ce fournisseur
3. **Choisissez le fichier CSV** - Format: .csv ou .txt (max 5 MB)
4. **Cliquez sur "Importer"**

### Messages de confirmation

- **Succès** : "X produit(s) importé(s) avec succès."
- **Erreurs** : Les erreurs détectées seront listées avec le numéro de ligne

### Points importants

⚠️ **Attention :**
- Seuls les champs `nom` et `prix` sont obligatoires
- Les doublons ne sont pas vérifiés (les produits avec le même nom seront créés à nouveau)
- Les images ne peuvent pas être importées via CSV
- Le slug (URL) est généré automatiquement à partir du nom

## 📥 Exporter les produits

### Accéder à l'export

1. **Depuis la page de gestion** : Cliquez sur le bouton **"Exporter CSV"** (orange)
2. **Depuis le formulaire d'import** : Cliquez sur **"Exporter en CSV"** dans le panneau de droite
3. **Via URL directe** : `/admin/products/export/csv`

### Fichier généré

- **Format** : CSV
- **Nom du fichier** : `produits_YYYY-MM-DD_HH-MM-SS.csv`
- **Colonnes** : nom, description, prix, quantite, categorie, fournisseur
- **Encodage** : UTF-8

## 🔍 Filtrage et Recherche

### Recherche par nom

1. Entrez un terme de recherche dans le champ **"Rechercher un produit"**
2. Cliquez sur **"Rechercher"** ou la recherche s'effectue instantanément

### Filtrer par catégorie

1. Sélectionnez une catégorie dans le dropdown **"Filtrer par catégorie"**
2. Le formulaire se soumet automatiquement

### Filtrer par fournisseur

1. Sélectionnez un fournisseur dans le dropdown **"Filtrer par fournisseur"**
2. Le formulaire se soumet automatiquement

### Tri des résultats

Sélectionnez une option dans le dropdown **"Trier par"** :
- **Plus récents** (défaut)
- **Plus anciens**
- **Nom (A-Z)**
- **Nom (Z-A)**
- **Prix croissant**
- **Prix décroissant**

### Réinitialiser les filtres

Cliquez sur le bouton **"Réinitialiser"** pour revenir à la liste complète

## 📊 Affichage du tableau

### Colonnes du tableau

| Colonne | Contenu |
|---------|---------|
| **#** | Numéro d'ordre (basé sur la pagination) |
| **Image** | Première image du produit (50x50px) |
| **Nom** | Nom du produit (lien vers le produit public) |
| **Prix** | Prix en euros |
| **Quantité** | Stock disponible (rouge si 0) |
| **Catégorie** | Catégorie associée |
| **Fournisseur** | Fournisseur assigné |
| **Actions** | Menu déroulant (Modifier, Voir, Supprimer) |

### Informations affichées

- **Pagination** : 15 produits par page
- **Compteur** : Affichage du nombre total et de la plage actuelle
- **Status stock** : 
  - 🔵 Bleu = stock disponible
  - 🔴 Rouge = rupture de stock

## ⚙️ Actions sur les produits

### Depuis le tableau

1. Cliquez sur les **trois points** (⋮) à droite du produit
2. Choisissez une action :
   - **Modifier** : Éditer les détails du produit
   - **Voir** : Consulter le produit sur le site public
   - **Supprimer** : Supprimer le produit (confirmation requise)

## 🎯 Cas d'usage courants

### Ajouter 20 nouveaux produits rapidement

1. Préparez un fichier Excel
2. Exportez en CSV
3. Importez via **Admin > Gestion des produits > Importer**
4. Temps estimé : 2-3 minutes ✓

### Déplacer des produits entre fournisseurs

1. Exportez les produits (`/admin/products/export/csv`)
2. Modifiez la colonne `fournisseur` 
3. Supprimez les produits actuels
4. Importez les produits modifiés

### Sauvegarder l'inventaire

1. Exportez régulièrement via `/admin/products/export/csv`
2. Stockez les fichiers CSV pour la sauvegarde

## 📝 Notes techniques

- **Fichier limite** : 5 MB maximum
- **Formats acceptés** : .csv, .txt
- **Encodage** : UTF-8 recommandé
- **Base de données** : Les slugs sont générés automatiquement
- **Relations** : Catégorie et fournisseur doivent exister avant l'import

## 🆘 Dépannage

### "Le fichier CSV est vide"
- Vérifiez que le fichier contient des données
- Assurez-vous que ce n'est pas juste l'en-tête

### "Le nom du produit est requis"
- Vérifiez que la colonne `nom` existe et n'est pas vide
- Vérifiez le formatage du CSV

### "Le prix est requis"
- Vérifiez que la colonne `prix` existe
- Assurez-vous que le prix est un nombre valide (ex: 19.99)

### Les produits ne s'importent pas
- Vérifiez que la catégorie et le fournisseur sont sélectionnés
- Vérifiez que ces éléments existent dans le système
- Consultez les messages d'erreur détaillés

---

**Version** : 1.0  
**Date de création** : 2026-03-25  
**Dernière mise à jour** : 2026-03-25
