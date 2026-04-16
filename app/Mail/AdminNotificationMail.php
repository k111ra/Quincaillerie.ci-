<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $title;
    public string $intro;
    public array $details;
    protected string $subjectLine;

    public function __construct(string $subjectLine, string $title, string $intro, array $details = [])
    {
        $this->subjectLine = $subjectLine;
        $this->title = $title;
        $this->intro = $intro;
        $this->details = $details;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_notification',
            with: [
                'title' => $this->title,
                'intro' => $this->intro,
                'details' => $this->details,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
