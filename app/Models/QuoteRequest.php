<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    public const STATUS_NOUVEAU = 'nouveau';
    public const STATUS_DETECTE = 'detecte';
    public const STATUS_ANALYSE = 'analyse';
    public const STATUS_PRET = 'pret';
    public const STATUS_ENVOYE = 'envoye';
    public const STATUS_REJETE = 'rejete';
    public const STATUS_ERREUR = 'erreur';

    protected $fillable = [
        'message_id',
        'from_email',
        'from_name',
        'subject',
        'body',
        'received_at',
        'status',
        'detection_score',
        'extraction_method',
        'client_message',
        'quote_number',
        'client_pdf_path',
        'supplier_doc_path',
        'sent_at',
        'error_message',
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(QuoteRequestItem::class);
    }

    public function isReadyToSend(): bool
    {
        return $this->status === self::STATUS_PRET
            && $this->items()->whereNotNull('selling_price')->count() === $this->items()->count()
            && $this->items()->count() > 0;
    }

    public function total(): float
    {
        return (float) $this->items->sum(function ($item) {
            return (float) $item->selling_price * (float) $item->quantity;
        });
    }

    public static function statusLabels(): array
    {
        return [
            self::STATUS_NOUVEAU => 'Nouveau',
            self::STATUS_DETECTE => 'Détecté',
            self::STATUS_ANALYSE => 'Analysé',
            self::STATUS_PRET => 'Prêt à envoyer',
            self::STATUS_ENVOYE => 'Envoyé',
            self::STATUS_REJETE => 'Rejeté',
            self::STATUS_ERREUR => 'Erreur',
        ];
    }
}
