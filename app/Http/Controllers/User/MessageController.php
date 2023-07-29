<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use App\Models\Chat;
use App\Models\User;
use App\Models\Notification;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChatNotificationEmail;

class MessageController extends Controller
{
    
    public function index(Request $request)
    {
        $auth_id=Auth::user()->id;        
        if($request->ajax())
        {
            $data = Message::select('messages.*','users.first_name as user_name')
                                ->where('messages.user_id', $auth_id)
                                 ->leftjoin('users','messages.user_id','=','users.id');
                                 
        
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
            return '<a href="'.route('user.view_chat', 'id='.$data->id).'" class="btn btn-sm btn-primary mr-1"  data-id="'.$data->id.'"><i class="mdi mdi-eye"></i></a><a href="'.route('user.edit_message', $data->id).'" class="btn btn-sm btn-primary" data-id="'.$data->id.'"><i class="mdi mdi-square-edit-outline"></i></a>';
        })

        ->rawColumns(['action'])
        ->toJson();   

            }            
        return view('user.message');
    }
    
    public function viewChat(Request $request)
    {

        $id=$request->id;
        $role_type = Auth::user()->role;
        $loginUserid = Auth::user()->id;
        
        
        $model = Message::select('messages.*', 'users.first_name as user_name')
            ->where('messages.user_id', $loginUserid)
            ->leftJoin('users', 'messages.user_id', '=', 'users.id')
            ->where('messages.id', $id)
            ->first();

        Notification::query()->where('to_user_id', $loginUserid)
            ->where('message_id', $id)
            ->update(['is_read' => 1]);
       
        if (!$model) 
        {
            return back();
        }

        $chat = Chat::select('chats.*', 'users.first_name as user_name')
            ->leftJoin('users', 'chats.sender_id', '=', 'users.id')
            ->where( 'chats.message_id', '=', $model->id)
            ->get();

        if (!$chat) {
            return back();
        }

        return view("user.view_chat", ['model' => $model, 'chat' => $chat]);              
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
                $chat = Chat::select('chats.*', 'users.first_name as user_name')
                    ->leftJoin('users', 'chats.sender_id', '=', 'users.id')
                    ->where( 'chats.message_id', '=', $request->message_id)
                    ->where([['chats.id','=', $chat->id]])->first();
                                

                $created_at = Carbon::parse($chat->created_at)->format('d-m-Y H:i:s');
                $chat->created_date = $created_at;               
                $chat->image =asset('backend/assets/images/blank.png');

                $result = ['status' => true,'message' => '', 'data'=>$chat];

                $user=User::whereIn('role', [1,2])->get();
                foreach($user as $userDetails)
                {
                    $notification=new Notification;
                    $notification->notification_type=2;
                    $notification->message_id=$request->message_id;
                    $notification->from_user_id=$loginUser->id;
                    $notification->to_user_id=$userDetails->id;
                    $notification->save();

                    $chat->receiver_name=$userDetails->first_name." ".$userDetails->last_name; 
                    Mail::to($userDetails->email)->send(new ChatNotificationEmail($chat));    
                }                

            }
            else
            {
                $result = ['status' => false, 'message' => 'Error in saving data', 'data' => []];
            }
        }
        return response()->json($result);
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

    public function view()
    {
        return view('user.createmessage');
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), 
        [
            'topic' => 'required',
            'title' => 'required',
            'message' => 'required',            
        ]);

   
        if ($validator->fails()) 
        {
            return redirect()->route('user.messageform')
            ->withErrors($validator)
            ->withInput();
        }

        $user_id=Auth::user()->id;
               
        $message = new Message;                        
        $message->user_id = $request->user_id;
        $message->topic = $request->topic;
        $message->title = $request->title;
        $message->message = $request->message;
             
        if($message->save())
        {   
            $savedMessage = Message::find($message->id);
            
            $chat = new Chat;
            $user=User::where('role', '2')->get();
            foreach($user as $userDetails)
            {
                $notification=new Notification;
                $notification->notification_type=1;
                $notification->message_id=$message->id;
                $notification->from_user_id=$user_id;
                $notification->to_user_id=$userDetails->id;
                $notification->save();

                $chat->receiver_name=$userDetails->first_name." ".$userDetails->last_name;
                $chat->chat_message= $savedMessage->title;
                $chat->created_date=Carbon::now()->format('d-m-Y H:i:s');
                Mail::to($userDetails->email)->send(new ChatNotificationEmail($chat));    
            }

            return redirect()->route('user.message')->with('message', 'Message Create successfully.');   
            
        }
        else
        {
           
            return redirect()->route('user.createmessage')->with('error', 'Message not Created.');
           
        }    
    }
    public function editMessage($id)
    {
        $message = Message::findOrFail($id);
        return view('user.createmessage', compact('message'));
   }
   
}