<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscribe;
use Validator;
use App\Mail\SubscribeFormEmail;
use Illuminate\Support\Facades\Mail;

class SubscribeController extends Controller
{
    public function add(Request $request)
    {           
       $rules=[
            'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribes'],
        ];

        $customMessages = [
            'email.unique' => 'The email has already been subscribed.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if($validator->fails())
        {

            $result = ['status' => false, 'errors' => $validator->errors()];
        }
        else
        {
            $email = $request->input('email');            
            $subscription = new Subscribe();
            $subscription->email = $email;
            if($subscription->save())
            {   
               
                Mail::to($request->email)->send(new SubscribeFormEmail($email));

                $result = ['status' => true, 'message' => "Your email have been successfully save for subscribed."];
            }
        }
        return response()->json($result);
    }
}
