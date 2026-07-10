<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Étape 5 : Email envoyé au client avec le devis PDF en pièce jointe.
 */
class QuoteReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public QuoteRequest $quoteRequest)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre devis ' . $this->quoteRequest->quote_number . ' — ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quote_reply',
            with: [
                'quoteRequest' => $this->quoteRequest,
            ],
        );
    }

    public function attachments(): array
    {
        if (empty($this->quoteRequest->client_pdf_path)) {
            return [];
        }

        return [
            Attachment::fromStorageDisk('local', $this->quoteRequest->client_pdf_path)
                ->as($this->quoteRequest->quote_number . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
