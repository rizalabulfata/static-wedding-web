<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected string $baseUrl;

    protected string $session;

    public function __construct()
    {
        $this->baseUrl = config('services.waha.base_url');
        $this->session = config('services.waha.session');
    }

    public function formatPhoneNumber(string $phoneNumber): string
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (str_starts_with($phoneNumber, '0')) {
            $phoneNumber = '62'.substr($phoneNumber, 1);
        }

        return $phoneNumber;
    }

    public function getWhatsAppUrl(string $phoneNumber, string $message): string
    {
        $formattedNumber = $this->formatPhoneNumber($phoneNumber);

        return "https://wa.me/{$formattedNumber}?text=".urlencode($message);
    }

    public function sendMessage(string $phoneNumber, string $message): bool
    {
        $formattedNumber = $this->formatPhoneNumber($phoneNumber);

        if (! str_contains($formattedNumber, '@c.us')) {
            $formattedNumber = $formattedNumber.'@c.us';
        }

        try {
            $response = Http::post("{$this->baseUrl}/api/sendText", [
                'session' => $this->session,
                'chatId' => $formattedNumber,
                'text' => $message,
            ]);

            if ($response->successful()) {
                return true;
            }

            Log::error('WAHA Error: '.$response->body());

            return false;
        } catch (\Exception $e) {
            Log::error('WAHA Exception: '.$e->getMessage());

            return false;
        }
    }
}
