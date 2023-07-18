<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function activateAccount($id)
    {       
        $authUser=Auth::user();
       
        $verifyUser = User::find($id);           
        if (!is_null($verifyUser)) 
        {
            if($verifyUser->email_verified_at) 
            {
                /*echo "<pre>";
                print_r($verifyUser); exit;*/
                if($verifyUser->is_active==0)
                {
                    $verifyUser->is_active = 1;
                    if ($verifyUser->save()) 
                    {
                        Mail::send('emails.accountActivateEmail', ['user' => $verifyUser], function($message) use($verifyUser){
                            $message->to($verifyUser->email);
                            $message->subject('Account Activation Mail');
                        });  
                        Session::flash('verify', 'Account Activated successfully.');
                        return view("messages");
                    }
                    else 
                    {
                        Session::flash('verify', 'Something went wrong.');
                        return view("messages");                        
                    }
                } 
                else
                {
                    Session::flash('verify', 'Account already Activated');
                    return view("messages");
                }                           
            }
            else 
            {
                Session::flash('verify', 'Email is not verified.');
                return view("messages");
            }
        }       
        Session::flash('verify', 'Sorry Email cannot be identified.');
        return view("messages");              
    }
}
