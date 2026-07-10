<?php

namespace App\Services\Cotation;

/**
 * Étape 1b : Détection des demandes de cotation / devis / achat
 * par analyse de mots-clés pondérés (sujet + corps).
 */
class QuoteDetectionService
{
    /**
     * Calcule un score de 0 à 100.
     * Le sujet compte double : un mot-clé trouvé dans le sujet vaut 1,5x son poids.
     */
    public function score(string $subject, string $body): int
    {
        $keywords = config('cotation.keywords', []);
        $subjectNorm = $this->normalize($subject);
        $bodyNorm = $this->normalize($body);

        $score = 0;

        foreach ($keywords as $keyword => $weight) {
            $keywordNorm = $this->normalize($keyword);

            if (mb_strpos($subjectNorm, $keywordNorm) !== false) {
                $score += (int) round($weight * 1.5);
            } elseif (mb_strpos($bodyNorm, $keywordNorm) !== false) {
                $score += $weight;
            }
        }

        return min(100, $score);
    }

    public function isQuoteRequest(string $subject, string $body): bool
    {
        return $this->score($subject, $body) >= (int) config('cotation.detection_threshold', 30);
    }

    public function shouldIgnoreSender(string $email): bool
    {
        $email = strtolower($email);

        foreach (config('cotation.ignored_senders', []) as $pattern) {
            if (str_contains($email, strtolower($pattern))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Minuscules + suppression des accents pour une comparaison robuste.
     */
    private function normalize(string $text): string
    {
        $text = mb_strtolower($text);

        $replacements = [
            'à' => 'a', 'â' => 'a', 'ä' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'î' => 'i', 'ï' => 'i',
            'ô' => 'o', 'ö' => 'o',
            'ù' => 'u', 'û' => 'u', 'ü' => 'u',
            'ç' => 'c',
            '’' => "'",
        ];

        return strtr($text, $replacements);
    }
}
