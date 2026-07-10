<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: #444; font-size: 14px; line-height: 1.6;">
    <div style="max-width: 600px; margin: auto; padding: 20px;">
        {!! nl2br(e($quoteRequest->client_message)) !!}

        <p style="margin-top: 30px; font-size: 12px; color: #999; border-top: 1px solid #eee; padding-top: 10px;">
            {{ config('app.name') }} — Abidjan, Côte d'Ivoire<br>
            Cet email fait suite à votre demande « {{ $quoteRequest->subject }} ».
        </p>
    </div>
</body>

</html>
