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

    public static function formatForWhatsApp(string $content): string
    {
        $replacements = [
            '/<strong[^>]*>(.*?)<\/strong>/is' => '*$1*',
            '/<b[^>]*>(.*?)<\/b>/is' => '*$1*',
            '/<em[^>]*>(.*?)<\/em>/is' => '_$1_',
            '/<i[^>]*>(.*?)<\/i>/is' => '_$1_',
            '/<strike[^>]*>(.*?)<\/strike>/is' => '~$1~',
            '/<s[^>]*>(.*?)<\/s>/is' => '~$1~',
            '/<u[^>]*>(.*?)<\/u>/is' => '$1', // WhatsApp doesn't support underline
            '/<br[^>]*>/i' => "\n",
            '/<\/p>/i' => "\n",
            '/<\/div>/i' => "\n",
            '/<p[^>]*>/i' => '',
            '/<div[^>]*>/i' => '',
        ];

        foreach ($replacements as $pattern => $replacement) {
            $content = preg_replace($pattern, $replacement, $content);
        }

        return trim(strip_tags($content));
    }
}
