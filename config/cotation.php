<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module Cotations Automatiques
    |--------------------------------------------------------------------------
    */

    // Marge appliquée sur le prix d'achat (35% par défaut).
    // NE JAMAIS afficher cette valeur sur les documents client.
    'margin_percent' => (float) env('COTATION_MARGIN_PERCENT', 35),

    // Email de l'administrateur qui reçoit les notifications à chaque étape.
    'admin_email' => env('COTATION_ADMIN_EMAIL', 'info@quincaillerie.ci'),

    // Envoi automatique du devis au client (false = validation manuelle requise).
    'auto_send' => (bool) env('COTATION_AUTO_SEND', false),

    // Score minimum (sur 100) pour considérer un email comme demande de cotation.
    'detection_threshold' => (int) env('COTATION_DETECTION_THRESHOLD', 30),

    /*
    |--------------------------------------------------------------------------
    | Connexion IMAP (boîte info@quincaillerie.ci)
    |--------------------------------------------------------------------------
    */
    'imap' => [
        'host' => env('COTATION_IMAP_HOST', 'mail.quincaillerie.ci'),
        'port' => (int) env('COTATION_IMAP_PORT', 993),
        'encryption' => env('COTATION_IMAP_ENCRYPTION', 'ssl'),
        'validate_cert' => (bool) env('COTATION_IMAP_VALIDATE_CERT', true),
        'username' => env('COTATION_IMAP_USERNAME', 'info@quincaillerie.ci'),
        'password' => env('COTATION_IMAP_PASSWORD', ''),
        'folder' => env('COTATION_IMAP_FOLDER', 'INBOX'),
        // Ne traiter que les emails non lus
        'unseen_only' => (bool) env('COTATION_IMAP_UNSEEN_ONLY', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Extraction des produits par IA (optionnel)
    |--------------------------------------------------------------------------
    | Si une clé API Anthropic est fournie, l'extraction des produits se fait
    | par IA (bien plus fiable). Sinon, extraction par règles.
    */
    'anthropic' => [
        'api_key' => env('ANTHROPIC_API_KEY', ''),
        'model' => env('ANTHROPIC_MODEL', 'claude-haiku-4-5-20251001'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Mots-clés de détection (français, contexte Côte d'Ivoire)
    |--------------------------------------------------------------------------
    | Chaque mot-clé a un poids. Le score total est plafonné à 100.
    */
    'keywords' => [
        // Très forts
        'demande de cotation' => 60,
        'demande de devis' => 60,
        'demande de prix' => 50,
        "demande d'achat" => 50,
        'facture proforma' => 50,
        'proforma' => 45,
        'cotation' => 40,
        'devis' => 40,
        // Moyens
        'bon de commande' => 30,
        'appel d\'offre' => 30,
        'meilleur prix' => 25,
        'vos prix' => 25,
        'prix unitaire' => 25,
        'quantité' => 15,
        'disponibilité' => 15,
        'délai de livraison' => 15,
        // Faibles
        'commande' => 10,
        'acheter' => 10,
        'fourniture' => 10,
        'prix' => 5,
    ],

    // Expéditeurs à ignorer (newsletters, no-reply...)
    'ignored_senders' => [
        'no-reply@',
        'noreply@',
        'newsletter@',
        'notification@',
        'mailer-daemon@',
        'postmaster@',
    ],

    /*
    |--------------------------------------------------------------------------
    | Recherche web complémentaire
    |--------------------------------------------------------------------------
    | Sites e-commerce ivoiriens utilisés pour générer des liens de recherche
    | pour les produits sans fournisseur dans le catalogue interne.
    */
    'web_sources' => [
        'Jumia CI' => 'https://www.jumia.ci/catalog/?q=',
        'Afrimarket / Google Shopping' => 'https://www.google.com/search?tbm=shop&gl=ci&q=',
        'Google (fournisseurs Abidjan)' => 'https://www.google.com/search?q=',
    ],
];
