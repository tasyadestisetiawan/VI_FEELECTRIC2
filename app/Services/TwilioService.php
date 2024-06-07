<?php
namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendWhatsAppMessage($to, $message)
    {
        try {
            $this->client->messages->create(
                'whatsapp:' . $to,
                [
                    'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_FROM'),
                    'body' => $message
                ]
            );
            Log::info('WhatsApp message sent to ' . $to);
        } catch (\Exception $e) {
            Log::error('Failed to send WhatsApp message: ' . $e->getMessage());
        }
    }
}
