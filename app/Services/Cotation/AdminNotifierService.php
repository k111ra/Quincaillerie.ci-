<?php

namespace App\Services\Cotation;

use App\Mail\AdminNotificationMail;
use App\Models\QuoteRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Notifie l'administrateur à la fin de chaque étape du traitement.
 */
class AdminNotifierService
{
    public function notify(QuoteRequest $request, string $etape, string $intro, array $details = []): void
    {
        $adminEmail = config('cotation.admin_email');

        if (empty($adminEmail)) {
            return;
        }

        $baseDetails = [
            'Demande' => '#' . $request->id . ($request->quote_number ? ' (' . $request->quote_number . ')' : ''),
            'Client' => trim($request->from_name . ' <' . $request->from_email . '>'),
            'Sujet' => (string) $request->subject,
        ];

        try {
            Mail::to($adminEmail)->send(new AdminNotificationMail(
                '[Cotation] ' . $etape . ' — demande #' . $request->id,
                $etape,
                $intro,
                array_merge($baseDetails, $details)
            ));
        } catch (\Throwable $e) {
            Log::error('[Cotation] Notification admin échouée : ' . $e->getMessage());
        }
    }
}
