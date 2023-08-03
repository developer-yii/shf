<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = User::where('email', $request->email)->first();
        $password = $request->input('password');
        if($user && Hash::check($password, $user->password))
        {
            
            if(($user->role == '1') || ($user->role == '2'))
            {  
                $user = Auth::login($user);
                return redirect()->route('admin.adminHome');
            }
            if($user->role == '3' && $user->is_active == '1' && $user->email_verified_at != null)
            {   
                $user = Auth::login($user);                                       
                return redirect()->route('user.Home');               
            }
            if($user->role == '3' && $user->email_verified_at == null)
            {
                $email=$user->email;
                $verificationLink = route('resend.verification', ['email' => $email]);
                $errorMsg = 'Please Verify your email <a href="'.$verificationLink.'" style="color:white; text-decoration:underline;font-weight:bold;">Verify Email</a>'; 
                return redirect('login')->withInput()->with('error', $errorMsg);
            }
            else
            {
                return redirect('login')->withInput()->with('error','Your account is not activated');
            }
        }
        else 
        {  
            return redirect('login')->withInput()->with('error','The password is wrong.');
        }
    }
    public function resendVerification(Request $request)
    {             
        $user = User::where('email', $request->email)->first(); 
        
        if(isset($user->id) && $user->id != Null)
        {
            $email=$user->email;
            Mail::send('emails.emailVerificationEmail', ['user' => $user], function($message) use($user){
                        $message->to($user->email);
                        $message->subject('Email Verification Mail');
                    });          
           
            return redirect()->route('send.verification', $email);            
        }
        else
        {
            return redirect('login')->withInput()->with('error','Invalid Email');
        }        
    }

    public function varificationsend(Request $request)
    {
        $email=$request->email;
        $user = User::where('email', $request->email)->first(); 
        if($user)
        {
            Session::flash('verify', 'A verification link has been send to '.$email.'.
                                Please check an email and click on the included link to
                                verify your email.');
            return view("messages", compact('email'));
        }
        else
        {
            Session::flash('verify', 'Invalid Email');
            return view("messages");
        }
    }

    public function logout(Request $request) 
    {
      Auth::logout();
      return redirect('/home')->with('message','You have been successfully logout!');
    }
}
