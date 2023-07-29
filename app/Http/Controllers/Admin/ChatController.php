<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Chat;
use App\Models\User;
use App\Models\Notification;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChatNotificationEmail;

class ChatController extends Controller
{
    public function viewchat(Request $request)
    {
        $id=$request->id;
        $role_type = Auth::user()->role;
        $loginUserid = Auth::user()->id;

        Notification::query()->where('to_user_id', $loginUserid)
            ->where('message_id', $id)
            ->update(['is_read' => 1]);

        if ($role_type == 1 || $role_type == 2) 
        {
            $model = Message::select('messages.*', 'users.first_name as user_name')
                ->leftJoin('users', 'messages.user_id', '=', 'users.id')
                ->where('messages.id', $id)
                ->first();              
        }
        if (!$model) 
        {
            return back();
        }

        $chat = Chat::select('chats.*', 'users.first_name as user_name')
                ->leftJoin('users', 'chats.sender_id', '=', 'users.id')
                ->where( 'chats.message_id', '=', $model->id)
                ->get();

        if($model->is_read==0)
        {
            $model->is_read = "1";
            $model->save();
        }   

        if (!$chat) {
            return back();
        }
        
        return view("admin.view_chat", ['model' => $model, 'chat' => $chat]);        
    }
    public function markAsRead(Request $request)
    {
        $loginUserid=Auth::user()->id;

        if($request->msgid!="")
        { 
            Notification::query()->where('to_user_id', $loginUserid)
                ->where('message_id', $request->msgid)
                ->update(['is_read' => 1]);
        }


        $chatIds = $request->id;

        if($chatIds!="")
        {
            $message = Chat::whereIn('id', $chatIds)->update(['is_read' => 1]);
        }

        
        return response()->json(['success' => true]);
    }
    public function fetchData(Request $request)
    {
        

        $model = Message::select('messages.*', 'users.first_name as user_name')
                ->leftJoin('users', 'messages.user_id', '=', 'users.id')
                ->where('messages.id', $request->id)
                ->first();            
         
        if($model)
        {  
            $chat = Chat::select('chats.*', 'users.first_name as user_name')
                        ->leftJoin('users', 'chats.sender_id', '=', 'users.id')
                        ->where( 'chats.message_id', '=', $model->id);

            $model->auth_id=Auth::user()->id;
            if ($request->lastid) 
            {
                $chat=$chat->where([['chats.id','>', $request->lastid]]);
            }
            $chat = $chat->get();                   

            foreach ($chat as $key => $value) 
            {
                $created_at = Carbon::parse($value->created_at)->format('d-m-Y H:i:s');
                $value->created_date = $created_at;            
                $value->image =asset('backend/assets/images/blank.png');
            }
            if ($chat->count()) 
            {
                $result = ['status' => true, 'data'=>$chat ,'modal'=>$model ];
            }
            else
            {
                $result = ['status' => true, 'data'=>'' ,'modal'=>$model ];
            }
        }
        else
        {
            $result = ['status' => false, 'data'=>''];
        }
        return response()->json($result);
        
    }
    public function addchat(Request $request)
    {
        $role_type = Auth::user()->role;
        $loginUser = Auth::user();
        
        $rules = array(
            'message' => ['required'],
        );
        
        $customMessages = [
            'message.required' => "Message filed is Required",
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) 
        {
            $result = ['status' => false, 'message' => $validator->errors(), 'data' => []];
        }
        else 
        {
            $chat = new Chat;
            $chat->message_id = $request->message_id;
            $chat->sender_id = $loginUser->id;
            $chat->chat_message = $request->message;
           
            if ($chat->save()) 
            {
                $chat = Chat::select('chats.*', 'users.first_name as user_name', 'users.email as user_email')
                    ->leftJoin('users', 'chats.sender_id', '=', 'users.id')
                    ->where( 'chats.message_id', '=', $request->message_id)
                    ->where([['chats.id','=', $chat->id]])->first();
                    

                $message = Message::with('user')->find($request->message_id);
                if ($message) 
                {
                    $userDetails = $message->user;

                    $notification=new Notification;
                    $notification->notification_type=2;
                    $notification->message_id=$request->message_id;
                    $notification->from_user_id=$loginUser->id;
                    $notification->to_user_id=$userDetails->id;
                    $notification->save();

                    $chat->receiver_name=$userDetails->first_name." ".$userDetails->last_name; 
                }

                $created_at = Carbon::parse($chat->created_at)->format('d-m-Y H:i:s');
                $chat->created_date = $created_at;               
                $chat->image =asset('backend/assets/images/blank.png');

                $result = ['status' => true,'message' => '', 'data'=>$chat];

                //Mail::to($userDetails->email)->send(new ChatNotificationEmail($chat));
            }
            else 
            {
                $result = ['status' => false, 'message' => 'Error in saving data', 'data' => []];
            }
        }
        return response()->json($result);
    }
}


