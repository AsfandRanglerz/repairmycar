<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\webNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    // notification
    public function notification(Request $request)
    {

        $unread = webNotification::where([['customer_id', auth()->user()->id], ['seen', 0]])->count('seen');

        $notification = webNotification::where([['customer_id', auth()->user()->id], ['seen', 0]])->orderBy('id', 'DESC')->get();
        $notification = view('user.notification.index')->with(['notification' => $notification])->render();

        return response()->json([
            'success' => 'Status updated successfully',
            'unread' => $unread,
            'notification' => $notification,
        ]);

    }



    //change status of unseen notification
    public function status(Request $request)
    {
        $notification = webNotification::find($request->id);
        $notification->delete();

        $unread = webNotification::where([['customer_id', auth()->user()->id], ['seen', 0]])->count('seen');

        $notification = webNotification::where([['customer_id', auth()->user()->id], ['seen', 0]])->orderBy('id', 'DESC')->get();
        $notification = view('user.notification.index')->with(['notification' => $notification])->render();

        return response()->json([
            'success' => 'Status updated successfully',
            'unread' => $unread,
            'notification' => $notification,
        ]);

    }
}
