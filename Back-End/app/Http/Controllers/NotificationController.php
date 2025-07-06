<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('contact')->get();

        return response()->json([
            'notificationdata' => $notifications
        ]);
    }
    public function show($id)
    {
        $notification = Notification::with('contact')->find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        return response()->json([
            'notification' => $notification
        ]);
    }
    public function destroy($id)
    {
        $notification = Notification::with('contact')->find($id);
        $notification->delete();
        return response()->json(['mesage'=>'delete notification successfull']);
    }
    
}
