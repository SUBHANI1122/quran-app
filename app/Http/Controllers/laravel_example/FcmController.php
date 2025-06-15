<?php

namespace App\Http\Controllers\laravel_example;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\FirebaseService;

class FcmController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function sendToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $user = User::find($request->user_id);

        if (!$user->fcm_token) {
            return response()->json(['error' => 'FCM token not available for this user.'], 422);
        }

        $this->firebase->sendNotification(
            $user->fcm_token,
            $request->title,
            $request->body,
            ['custom_data' => 'example']
        );

        return response()->json(['message' => 'Notification sent successfully.']);
    }
}
