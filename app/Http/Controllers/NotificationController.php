<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TwilioService;

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

        $this->twilioService->sendWhatsAppMessage($to, $message);

        return response()->json(['message' => 'Message sent successfully']);
    }
}
