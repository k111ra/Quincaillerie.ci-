<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1f2937;">
    <div style="max-width: 700px; margin: 0 auto; padding: 24px; border: 1px solid #e5e7eb; border-radius: 8px;">
        <h2 style="margin-top: 0; color: #111827;">{{ $title }}</h2>

        <p>{{ $intro }}</p>

        @if (!empty($details))
            <table style="width: 100%; border-collapse: collapse; margin-top: 16px;">
                <tbody>
                    @foreach ($details as $label => $value)
                        <tr>
                            <td style="padding: 8px; border: 1px solid #e5e7eb; background: #f9fafb; width: 35%;">
                                <strong>{{ $label }}</strong>
                            </td>
                            <td style="padding: 8px; border: 1px solid #e5e7eb;">
                                {{ $value }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <p style="margin-top: 20px;">Merci.</p>
    </div>
</body>

</html>
