<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\PHPIMAP\ClientManager;

class DiagnoseCotationImap extends Command
{
    protected $signature = 'cotations:diagnose';

    protected $description = 'Diagnostique la connexion IMAP du module cotations (DNS, SSL, identifiants)';

    public function handle(): int
    {
        $config = config('cotation.imap');

        $this->info('=== Diagnostic connexion IMAP ===');
        $this->line('Hôte      : ' . $config['host']);
        $this->line('Port      : ' . $config['port']);
        $this->line('Chiffrage : ' . $config['encryption']);
        $this->line('Compte    : ' . $config['username']);
        $this->line('Mot de passe : ' . (empty($config['password']) ? '⚠ VIDE (vérifiez COTATION_IMAP_PASSWORD dans .env puis php artisan config:clear)' : str_repeat('*', 8) . ' (défini, ' . strlen($config['password']) . ' caractères)'));
        $this->newLine();

        // 1. DNS
        $this->line('1) Résolution DNS...');
        $ip = gethostbyname($config['host']);
        if ($ip === $config['host']) {
            $this->error('   ÉCHEC : impossible de résoudre ' . $config['host'] . '. Vérifiez votre connexion Internet / DNS.');
            return self::FAILURE;
        }
        $this->info('   OK (' . $ip . ')');

        // 2. Socket SSL
        $this->line('2) Connexion SSL au port ' . $config['port'] . '...');
        $errno = 0;
        $errstr = '';
        $socket = @stream_socket_client(
            'ssl://' . $config['host'] . ':' . $config['port'],
            $errno,
            $errstr,
            15,
            STREAM_CLIENT_CONNECT,
            stream_context_create(['ssl' => ['verify_peer' => $config['validate_cert'], 'verify_peer_name' => $config['validate_cert']]])
        );

        if (!$socket) {
            $this->error('   ÉCHEC : ' . $errstr . ' (code ' . $errno . ')');
            $this->warn('   Causes possibles : pare-feu/antivirus bloquant le port 993, ou extension openssl désactivée dans php.ini.');
            $this->line('   Vérifiez openssl : php -m | findstr openssl');
            return self::FAILURE;
        }
        $greeting = fgets($socket, 256);
        fclose($socket);
        $this->info('   OK — réponse serveur : ' . trim((string) $greeting));

        // 3. Authentification IMAP
        $this->line('3) Authentification IMAP...');
        try {
            $cm = new ClientManager();
            $client = $cm->make([
                'host' => $config['host'],
                'port' => $config['port'],
                'encryption' => $config['encryption'],
                'validate_cert' => $config['validate_cert'],
                'username' => $config['username'],
                'password' => $config['password'],
                'protocol' => 'imap',
            ]);
            $client->connect();

            $folder = $client->getFolder($config['folder'] ?? 'INBOX');
            $total = $folder->messages()->all()->count();
            $unseen = $folder->messages()->unseen()->count();

            $this->info('   OK — connecté à la boîte ' . $config['username']);
            $this->info('   INBOX : ' . $total . ' message(s), dont ' . $unseen . ' non lu(s).');

            $client->disconnect();
        } catch (\Throwable $e) {
            $this->error('   ÉCHEC : ' . get_class($e));
            $this->error('   Message : ' . $e->getMessage());
            if ($e->getPrevious()) {
                $this->error('   Détail : ' . $e->getPrevious()->getMessage());
            }
            $this->warn('   Si le serveur répond mais l\'authentification échoue : mot de passe incorrect.');
            $this->warn('   Testez le même mot de passe sur https://mail.hostinger.com (webmail).');
            return self::FAILURE;
        }

        $this->newLine();
        $this->info('=== Tout fonctionne ! Lancez : php artisan cotations:process ===');

        return self::SUCCESS;
    }
}
