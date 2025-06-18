<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Support\Facades\Log;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/quran-bin-aunwan-firebase-adminsdk-fbsvc-e8648398f9.json'));

        $this->messaging = $factory->createMessaging();
    }

   public function sendToTopic($topic, $title, $body, $data = [])
{
    $notification = Notification::create($title, $body);

    $message = CloudMessage::withTarget('topic', $topic)
        ->withNotification($notification)
        ->withData($data);

    try {
        $result = $this->messaging->send($message);

        // Log success
        Log::info("✅ Notification sent to topic '{$topic}': {$title}");
        return $result;
    } catch (MessagingException | FirebaseException $e) {
        // Log error
        Log::error("❌ Failed to send notification to topic '{$topic}': " . $e->getMessage());

        return false;
    }
}
}
