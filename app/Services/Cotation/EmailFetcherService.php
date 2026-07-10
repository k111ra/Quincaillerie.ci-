<?php

namespace App\Services\Cotation;

use Illuminate\Support\Facades\Log;
use Webklex\PHPIMAP\ClientManager;

/**
 * Étape 1a : Connexion IMAP à la boîte info@quincaillerie.ci
 * et récupération des nouveaux emails.
 *
 * Nécessite : composer require webklex/php-imap
 */
class EmailFetcherService
{
    /**
     * Récupère les nouveaux emails de la boîte.
     *
     * @return array<int, array{message_id: string, from_email: string, from_name: string, subject: string, body: string, received_at: \DateTimeInterface|null}>
     */
    public function fetchNewEmails(int $limit = 25): array
    {
        $config = config('cotation.imap');

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
        $query = $folder->query();

        if (!empty($config['unseen_only'])) {
            $query->unseen();
        } else {
            $query->all();
        }

        $messages = $query->setFetchOrderDesc()->limit($limit)->get();

        $emails = [];

        foreach ($messages as $message) {
            try {
                $from = $message->getFrom();
                $fromFirst = (is_object($from) && method_exists($from, 'first')) ? $from->first() : (is_array($from) ? ($from[0] ?? null) : null);

                $body = (string) $message->getTextBody();
                if (trim($body) === '') {
                    // Fallback : corps HTML converti en texte
                    $body = trim(strip_tags((string) $message->getHTMLBody()));
                }

                $messageId = trim((string) $message->getMessageId());
                if ($messageId === '') {
                    // Certains emails n'ont pas de Message-ID : on en fabrique un stable
                    $messageId = 'generated-' . md5(
                        ($fromFirst->mail ?? '') . '|' . (string) $message->getSubject() . '|' . (string) $message->getDate()
                    );
                }

                $date = $message->getDate();
                $receivedAt = null;
                if ($date) {
                    $carbon = method_exists($date, 'toDate') ? $date->toDate() : $date;
                    $receivedAt = $carbon instanceof \DateTimeInterface ? $carbon : null;
                }

                $emails[] = [
                    'message_id' => $messageId,
                    'from_email' => strtolower(trim($fromFirst->mail ?? '')),
                    'from_name' => trim($fromFirst->personal ?? ''),
                    'subject' => trim((string) $message->getSubject()),
                    'body' => $body,
                    'received_at' => $receivedAt,
                ];

                // Marquer comme lu pour ne pas retraiter
                $message->setFlag('Seen');
            } catch (\Throwable $e) {
                Log::warning('[Cotation] Email illisible ignoré : ' . $e->getMessage());
            }
        }

        $client->disconnect();

        return $emails;
    }
}
