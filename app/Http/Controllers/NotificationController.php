<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notification(Request $request)
    {
        $loginUser = Auth::user();
        $userrole=$loginUser->role;

        $notifications_count="";

        $notifications = Notification::join('users', 'notifications.from_user_id', '=', 'users.id')
                    ->where('is_read', 0)->orderBy('notifications.created_at', 'desc')
                    ->where('notifications.to_user_id',$loginUser->id)
                    ->get(['notifications.*','users.first_name','users.last_name']);

        $notifications_count=count($notifications);

        if($notifications_count > 0)
        {
            // $button_value="View all";
            $button_value="";
            $readlink="Mark all as read";
        }
        else
        {
            $button_value="No new notifications";
            $readlink="";
        }

        foreach ($notifications as $notification)
        {
            if ($notification->order_id > 0)
            {
                $order = Order::find($notification->order_id);
                $notification->order_status = $order ? $order->status : '';
            }
            else
            {
                $notification->order_status = "";
            }
        }
        $notification_html = view('admin.include.notification', compact('notifications', 'userrole'))->render();

        return response()->json(['notification_html' => $notification_html, 'notifications_count' => $notifications_count, 'button_value' =>$button_value, 'readlink' => $readlink], 200);

    }
    public function readAll(Request $request)
    {
        $loginUser = Auth::user();
        Notification::query()->where('to_user_id', $loginUser->id)->update(['is_read' => 1]);
        return back();
    }

}
