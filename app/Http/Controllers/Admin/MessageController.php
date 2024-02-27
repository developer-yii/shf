<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {

            $data = Message::select('messages.*','users.first_name as user_name')
                                     ->leftjoin('users','messages.user_id','=','users.id');

            return DataTables::of($data)
            ->editColumn('status', function($row)
            {
                $selected1 = '';
                $selected2 = '';
                $selected3 = '';

                if ($row->status == 1)
                {
                    $selected1 = 'selected';
                }
                else if ($row->status == 2)
                {
                    $selected2 = 'selected';
                }
                else if ($row->status == 3)
                {
                    $selected3 = 'selected';
                }

                return '<select name="message_status" class="form-control message_status" data-id="'.$row->id.'" data-user="'.$row->user_id.'"><option value="1" '.$selected1.'>Pending</option><option value="2" '.$selected2.'>In Progress</option><option value="3" '.$selected3.'>Resolved</option></select>';
            })

                ->addColumn('action', function ($data) {
                return '<a href="'.route('admin.view_chat', 'id='.$data->id).'" class="btn btn-sm btn-primary"  data-id="'.$data->id.'"><i class="mdi mdi-eye"></i></a>';
            })

            ->rawColumns(['action', 'status'])
            ->toJson();

        }

        return view('admin.message');
    }
    public function change_status(Request $request)
    {
        $model = Message::find($request->id);
        $model->status = $request->status;
        if ($model->save()) {
            $result = ['status' => true, 'message' => 'Status changed successfully'];
        } else {
            $result = ['status' => false, 'message' => 'Something went wrong'];
        }

        return response()->json($result);
    }

    public function notification(Request $request)
    {
        $loginUser = Auth::user();
        //$notifications = Message::where('is_read', 0)->orderBy('created_at', 'desc')->get();

        $notifications = Message::join('users', 'messages.user_id', '=', 'users.id')
        ->where('messages.is_read', 0)
        ->orderBy('messages.created_at', 'desc')
        ->get(['messages.*', 'users.first_name','users.last_name', 'users.email']); // Select the desired columns from both tables

        $notifications_count=count($notifications);
        if($notifications_count > 0)
        {
            // $button_value="View All";
            $button_value="";
            $readlink="Mark all as Read";
        }
        else
        {
            $button_value="No new Notifications";
            $readlink="";
        }
        $notification_html = view('admin.include.notification', compact('notifications'))->render();
        return response()->json(['notification_html' => $notification_html, 'notifications_count' => $notifications_count, 'button_value' =>$button_value, 'readlink' => $readlink], 200);

    }

    public function readAll(Request $request)
    {
        $loginUser = Auth::user();
        if ($loginUser->role == 1 || $loginUser->role == 2)
        {
            Message::query()->update(['is_read' => 1]);
            return redirect()->route('admin.message');
        }

    }

}
