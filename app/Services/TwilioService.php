<?php
namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendWhatsAppMessage($to, $message)
    {
        Log::info('Mengirim pesan WhatsApp ke ' . $to);
        try {
            $response = $this->client->messages->create(
                'whatsapp:' . $to,
                [
                    'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_FROM'),
                    'body' => $message
                ]
            );
            Log::info('Pesan WhatsApp berhasil dikirim ke ' . $to . ': ' . json_encode($response));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim pesan WhatsApp: ' . $e->getMessage());
        }
    }
}
