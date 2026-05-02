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

    public function sendMessage(string $phoneNumber, string $message): bool
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (! str_contains($phoneNumber, '@c.us')) {
            $phoneNumber = $phoneNumber.'@c.us';
        }

        try {
            $response = Http::post("{$this->baseUrl}/api/sendText", [
                'session' => $this->session,
                'chatId' => $phoneNumber,
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
