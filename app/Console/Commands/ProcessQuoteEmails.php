<?php

namespace App\Console\Commands;

use App\Services\Cotation\CotationPipelineService;
use Illuminate\Console\Command;

class ProcessQuoteEmails extends Command
{
    protected $signature = 'cotations:process';

    protected $description = 'Lit la boîte info@quincaillerie.ci, détecte les demandes de cotation et prépare les devis automatiquement';

    public function handle(CotationPipelineService $pipeline): int
    {
        $this->info('Lecture de la boîte email...');

        try {
            $stats = $pipeline->run();
        } catch (\Throwable $e) {
            $this->error('Erreur : ' . $e->getMessage());
            return self::FAILURE;
        }

        $this->info(sprintf(
            '%d email(s) lu(s), %d demande(s) de cotation détectée(s), %d traitée(s).',
            $stats['fetched'],
            $stats['detected'],
            $stats['processed']
        ));

        return self::SUCCESS;
    }
}
