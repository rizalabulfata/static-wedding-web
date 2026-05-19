<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    protected $fillable = ['key', 'content'];

    public static function getTemplate(string $key): string
    {
        return static::where('key', $key)->first()?->content ?? '';
    }

    /**
     * Convert Filament RichEditor HTML to WhatsApp-formatted plain text.
     *
     * WhatsApp markdown:
     *   *bold*   _italic_   ~strikethrough~   ```monospace```
     *
     * Handles: strong/b, em/i, s/strike/del, code/pre, h1-h6,
     *          p, div, br, ul/ol/li, blockquote, a, and arbitrary nesting.
     */
    public static function formatForWhatsApp(string $html): string
    {
        if (blank($html)) {
            return '';
        }

        // ── 1. Normalise line endings ────────────────────────────────────────
        $html = str_replace(["\r\n", "\r"], "\n", $html);

        // ── 2. Block-level → newlines (before stripping tags) ────────────────
        // Headings → bold + newline
        $html = preg_replace_callback(
            '/<h[1-6][^>]*>(.*?)<\/h[1-6]>/is',
            fn($m) => "\n*" . trim(strip_tags($m[1])) . "*\n",
            $html
        );

        // Blockquotes → indented with ›
        $html = preg_replace_callback(
            '/<blockquote[^>]*>(.*?)<\/blockquote>/is',
            fn($m) => "\n› " . trim(strip_tags($m[1])) . "\n",
            $html
        );

        // Ordered lists → numbered items
        $html = preg_replace_callback(
            '/<ol[^>]*>(.*?)<\/ol>/is',
            function ($m) {
                $items = [];
                preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $m[1], $liMatches);
                foreach ($liMatches[1] as $i => $li) {
                    $items[] = ($i + 1) . '. ' . trim(strip_tags($li));
                }
                return "\n" . implode("\n", $items) . "\n";
            },
            $html
        );

        // Unordered lists → bullet items
        $html = preg_replace_callback(
            '/<ul[^>]*>(.*?)<\/ul>/is',
            function ($m) {
                $items = [];
                preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $m[1], $liMatches);
                foreach ($liMatches[1] as $li) {
                    $items[] = '• ' . trim(strip_tags($li));
                }
                return "\n" . implode("\n", $items) . "\n";
            },
            $html
        );

        // ── 3. Inline formatting (deepest-first via iterative pass) ──────────
        // We loop until no more replacements occur so nested tags are resolved.
        $inlinePatterns = [
            // code / pre → monospace
            '/<(?:pre|code)[^>]*>(.*?)<\/(?:pre|code)>/is' => '```$1```',
            // bold
            '/<(?:strong|b)[^>]*>(.*?)<\/(?:strong|b)>/is' => '*$1*',
            // italic
            '/<(?:em|i)[^>]*>(.*?)<\/(?:em|i)>/is'         => '_$1_',
            // strikethrough
            '/<(?:s|strike|del)[^>]*>(.*?)<\/(?:s|strike|del)>/is' => '~$1~',
            // underline — WhatsApp has no underline; just unwrap
            '/<u[^>]*>(.*?)<\/u>/is'                        => '$1',
            // links → "text (url)"
            '/<a[^>]+href=["\']([^"\']*)["\'][^>]*>(.*?)<\/a>/is' => '$2 ($1)',
        ];

        $maxPasses = 10;
        for ($pass = 0; $pass < $maxPasses; $pass++) {
            $previous = $html;
            foreach ($inlinePatterns as $pattern => $replacement) {
                $html = preg_replace($pattern, $replacement, $html);
            }
            if ($html === $previous) {
                break; // nothing changed; all nesting resolved
            }
        }

        // ── 4. Remaining block tags → newlines ───────────────────────────────
        $html = preg_replace('/<br[^>]*>/i',  "\n",   $html);
        $html = preg_replace('/<\/p>/i',       "\n",   $html);
        $html = preg_replace('/<\/div>/i',     "\n",   $html);
        $html = preg_replace('/<p[^>]*>/i',    '',     $html);
        $html = preg_replace('/<div[^>]*>/i',  '',     $html);

        // ── 5. Strip any remaining tags ───────────────────────────────────────
        $html = strip_tags($html);

        // ── 6. Decode HTML entities ───────────────────────────────────────────
        $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // ── 7. Clean up whitespace ────────────────────────────────────────────
        // Trim each line
        $lines = array_map('rtrim', explode("\n", $html));

        // Collapse runs of 3+ blank lines to a maximum of 2
        $output  = [];
        $blanks  = 0;
        foreach ($lines as $line) {
            if (trim($line) === '') {
                $blanks++;
                if ($blanks <= 2) {
                    $output[] = '';
                }
            } else {
                $blanks = 0;
                $output[] = $line;
            }
        }

        return trim(implode("\n", $output));
    }
}
