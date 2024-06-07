<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function sendWhatsAppNotification(Request $request)
{
    $request->validate([
        'to' => 'required',
        'message' => 'required',
    ]);

    $to = $request->input('to');
    $message = $request->input('message');

    try {
        $this->twilioService->sendWhatsAppMessage($to, $message);
        Log::info('WhatsApp notification sent to ' . $to);
        return response()->json(['message' => 'Message sent successfully']);
    } catch (\Exception $e) {
        Log::error('Failed to send WhatsApp notification: ' . $e->getMessage());
        return response()->json(['message' => 'Failed to send message'], 500);
    }
}
}