<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::where('email', $request->email)->where('is_active', 1)->first();
        if (!$user) 
        {            
            return response()->json(['status' => false, 'message' => 'Password reset link not sent. User is inactive or email not found.']);
        }
        $response = Password::broker()->sendResetLink($request->only('email'));

        $result = ['status' => true, 'message' => trans($response)];
        return response()->json($result, 200);

    
        switch ($response) 
        {
            case Password::RESET_LINK_SENT:                
                return response()->json(['status' => true, 'message' => 'Password reset link sent to your email address.']);
            case Password::INVALID_USER:
                return response()->json(['status' => true, 'message' => trans($response)]);
        }        
        
    }
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);        
    }
    protected function credentials(Request $request)
    {
        return $request->only('email');
    }
    
    public function broker()
    {
        return Password::broker();
    }    
    
}
