<?php

namespace App\Console\Commands;

use App\Models\Fournisseur;
use App\Models\Product;
use App\Models\SupplierProduct;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Importe le catalogue fournisseurs (table supplier_products) depuis un fichier CSV.
 *
 * Le fichier doit avoir une ligne d'en-tête. Les colonnes sont reconnues par leur
 * nom (français ou anglais), quel que soit l'ordre. Séparateur , ou ; auto-détecté.
 *
 * Colonnes reconnues (alias) :
 *   fournisseur*   : fournisseur, supplier, nom_fournisseur, vendeur
 *   produit*       : produit, product, product_name, designation, article, nom_produit
 *   prix_achat*    : prix, prix_achat, purchase_price, price, cout, montant
 *   telephone      : telephone, tel, phone, contact, numero, whatsapp
 *   email          : email, mail, e-mail
 *   adresse        : adresse, address, localisation, zone
 *   unite          : unite, unit, unite_vente
 *   lien           : lien, lien_achat, purchase_link, url, link
 *   notes          : notes, remarque, commentaire, observation
 * (* = obligatoire)
 *
 * Exemples :
 *   php artisan cotations:import-suppliers resources/templates/import_fournisseurs_exemple.csv --dry-run
 *   php artisan cotations:import-suppliers storage/app/fournisseurs.csv
 */
class ImportSuppliers extends Command
{
    protected $signature = 'cotations:import-suppliers
        {file : Chemin du fichier CSV à importer}
        {--dry-run : Analyse le fichier sans rien écrire en base}
        {--truncate : Vide la table supplier_products avant l\'import}';

    protected $description = 'Importe le catalogue fournisseurs (supplier_products) depuis un CSV';

    /** Alias de colonnes → champ canonique. */
    private array $aliases = [
        'fournisseur' => ['fournisseur', 'supplier', 'nom_fournisseur', 'nomfournisseur', 'vendeur', 'nom du fournisseur'],
        'product_name' => ['produit', 'product', 'product_name', 'productname', 'designation', 'article', 'nom_produit', 'nomproduit', 'nom du produit'],
        'purchase_price' => ['prix', 'prix_achat', 'prixachat', 'purchase_price', 'purchaseprice', 'price', 'cout', 'montant', 'prix d\'achat'],
        'telephone' => ['telephone', 'tel', 'phone', 'contact', 'numero', 'whatsapp', 'tel1', 'telephone1'],
        'email' => ['email', 'mail', 'e-mail', 'courriel'],
        'adresse' => ['adresse', 'address', 'localisation', 'zone', 'ville'],
        'unit' => ['unite', 'unit', 'unite_vente', 'unitevente', 'conditionnement'],
        'purchase_link' => ['lien', 'lien_achat', 'lienachat', 'purchase_link', 'purchaselink', 'url', 'link'],
        'notes' => ['notes', 'remarque', 'remarques', 'commentaire', 'observation', 'observations'],
    ];

    public function handle(): int
    {
        $file = $this->argument('file');

        if (!is_file($file)) {
            $this->error("Fichier introuvable : $file");
            return self::FAILURE;
        }

        $rows = $this->readCsv($file);
        if ($rows === null) {
            return self::FAILURE;
        }

        [$header, $dataRows] = [$rows['header'], $rows['data']];
        $map = $this->mapColumns($header);

        foreach (['fournisseur', 'product_name', 'purchase_price'] as $required) {
            if (!isset($map[$required])) {
                $this->error("Colonne obligatoire manquante : « $required ». En-têtes trouvés : " . implode(', ', $header));
                return self::FAILURE;
            }
        }

        $dryRun = (bool) $this->option('dry-run');

        if ($this->option('truncate') && !$dryRun) {
            if ($this->confirm('Vider toute la table supplier_products avant l\'import ?', false)) {
                SupplierProduct::query()->delete();
                $this->warn('Table supplier_products vidée.');
            }
        }

        $created = 0;
        $suppliersTouched = [];
        $skipped = 0;
        $lineNo = 1; // ligne d'en-tête = 1

        foreach ($dataRows as $row) {
            $lineNo++;
            $get = fn (string $field) => isset($map[$field]) ? trim((string) ($row[$map[$field]] ?? '')) : '';

            $supplierName = $get('fournisseur');
            $productName = $get('product_name');
            $priceRaw = $get('purchase_price');

            if ($supplierName === '' && $productName === '' && $priceRaw === '') {
                continue; // ligne vide
            }

            $price = $this->parsePrice($priceRaw);

            if ($supplierName === '' || $productName === '' || $price === null) {
                $this->warn("  Ligne $lineNo ignorée (fournisseur/produit/prix manquant ou invalide) : «$supplierName | $productName | $priceRaw»");
                $skipped++;
                continue;
            }

            if ($dryRun) {
                $this->line("  Ligne $lineNo : [$supplierName] $productName = " . number_format($price, 0, ',', ' ') . " FCFA");
                $suppliersTouched[Str::lower($supplierName)] = true;
                $created++;
                continue;
            }

            $fournisseur = $this->resolveFournisseur($supplierName, $get('telephone'), $get('email'), $get('adresse'));
            $suppliersTouched[$fournisseur->id] = true;

            SupplierProduct::create([
                'fournisseur_id' => $fournisseur->id,
                'product_id' => $this->matchProductId($productName),
                'product_name' => $productName,
                'purchase_price' => $price,
                'unit' => $get('unit') !== '' ? $get('unit') : 'unité',
                'purchase_link' => $get('purchase_link') !== '' ? $get('purchase_link') : null,
                'notes' => $get('notes') !== '' ? $get('notes') : null,
                'price_updated_at' => now(),
            ]);
            $created++;
        }

        $this->newLine();
        if ($dryRun) {
            $this->info("DRY-RUN : $created produit(s) valides, " . count($suppliersTouched) . " fournisseur(s) distinct(s), $skipped ligne(s) ignorée(s). Rien n'a été écrit.");
        } else {
            $this->info("Import terminé : $created produit(s) ajouté(s) chez " . count($suppliersTouched) . " fournisseur(s), $skipped ligne(s) ignorée(s).");
        }

        return self::SUCCESS;
    }

    /**
     * Lit le CSV en auto-détectant le séparateur (, ou ;) et l'encodage BOM.
     *
     * @return array{header: string[], data: array<int, string[]>}|null
     */
    private function readCsv(string $file): ?array
    {
        $handle = fopen($file, 'r');
        if ($handle === false) {
            $this->error("Impossible d'ouvrir : $file");
            return null;
        }

        $firstLine = fgets($handle);
        if ($firstLine === false) {
            $this->error('Fichier vide.');
            fclose($handle);
            return null;
        }
        // Retirer un éventuel BOM UTF-8
        $firstLine = preg_replace('/^\xEF\xBB\xBF/', '', $firstLine);
        $delimiter = substr_count($firstLine, ';') > substr_count($firstLine, ',') ? ';' : ',';

        rewind($handle);
        $header = fgetcsv($handle, 0, $delimiter);
        if ($header === false) {
            $this->error('En-tête illisible.');
            fclose($handle);
            return null;
        }
        $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
        $header = array_map(fn ($h) => trim((string) $h), $header);

        $data = [];
        while (($line = fgetcsv($handle, 0, $delimiter)) !== false) {
            $data[] = $line;
        }
        fclose($handle);

        $this->info('Fichier lu : ' . count($data) . ' ligne(s) de données (séparateur « ' . $delimiter . ' »).');

        return ['header' => $header, 'data' => $data];
    }

    /**
     * Associe chaque champ canonique à l'index de colonne correspondant.
     *
     * @param string[] $header
     * @return array<string, int>
     */
    private function mapColumns(array $header): array
    {
        $normalized = array_map(fn ($h) => $this->normalize($h), $header);
        $map = [];

        foreach ($this->aliases as $field => $names) {
            foreach ($names as $name) {
                $idx = array_search($this->normalize($name), $normalized, true);
                if ($idx !== false) {
                    $map[$field] = $idx;
                    break;
                }
            }
        }

        return $map;
    }

    /** Minuscule + sans accents + trim, pour comparer les en-têtes. */
    private function normalize(string $value): string
    {
        $value = mb_strtolower(trim($value));
        $value = strtr($value, [
            'à' => 'a', 'â' => 'a', 'ä' => 'a', 'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'î' => 'i', 'ï' => 'i', 'ô' => 'o', 'ö' => 'o', 'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'ç' => 'c',
        ]);

        return $value;
    }

    /** Convertit « 4 500 FCFA », « 4.500,00 », « 4500 » en float. Retourne null si invalide. */
    private function parsePrice(string $raw): ?float
    {
        if ($raw === '') {
            return null;
        }
        // Retirer tout sauf chiffres, séparateurs et signe
        $clean = preg_replace('/[^\d,.\-]/', '', $raw);
        if ($clean === '' || $clean === '-') {
            return null;
        }
        // Si virgule ET point présents : le dernier est le séparateur décimal
        if (str_contains($clean, ',') && str_contains($clean, '.')) {
            if (strrpos($clean, ',') > strrpos($clean, '.')) {
                $clean = str_replace('.', '', $clean);      // point = milliers
                $clean = str_replace(',', '.', $clean);      // virgule = décimale
            } else {
                $clean = str_replace(',', '', $clean);       // virgule = milliers
            }
        } elseif (str_contains($clean, ',')) {
            // Virgule seule : décimale si 1-2 chiffres après, sinon milliers
            $parts = explode(',', $clean);
            $clean = (strlen(end($parts)) <= 2 && count($parts) === 2)
                ? str_replace(',', '.', $clean)
                : str_replace(',', '', $clean);
        }

        if (!is_numeric($clean)) {
            return null;
        }
        $val = (float) $clean;

        return $val > 0 ? $val : null;
    }

    /** findOrCreate d'un fournisseur par nom (insensible à la casse), complète les contacts vides. */
    private function resolveFournisseur(string $nom, string $tel, string $email, string $adresse): Fournisseur
    {
        $fournisseur = Fournisseur::whereRaw('LOWER(nom) = ?', [Str::lower($nom)])->first();

        if (!$fournisseur) {
            $fournisseur = new Fournisseur();
            $fournisseur->nom = $nom;
            if (in_array('status', (new Fournisseur())->getFillable(), true)) {
                $fournisseur->status = 'active';
            }
        }

        // Ne pas écraser une valeur existante
        if ($tel !== '' && empty($fournisseur->telephone)) {
            $fournisseur->telephone = $tel;
        }
        if ($email !== '' && empty($fournisseur->email)) {
            $fournisseur->email = $email;
        }
        if ($adresse !== '' && empty($fournisseur->adresse)) {
            $fournisseur->adresse = $adresse;
        }
        $fournisseur->save();

        return $fournisseur;
    }

    /** Tente de relier le produit fournisseur à un produit du site (facultatif). */
    private function matchProductId(string $productName): ?int
    {
        $product = Product::where('nom', 'LIKE', $productName)
            ->orWhere('nom', 'LIKE', '%' . $productName . '%')
            ->first();

        return $product?->id;
    }
}
