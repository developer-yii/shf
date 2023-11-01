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
use Validator;

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

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('frontend.home');
    }
    public function adminLogin()
    {
        return view('auth.login');
    }

    public function ajaxLogin(Request $request)
    {

        if($request->ajax())
        {
            $rules=[
                'email' => 'required|email',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails())
            {
                $result = ['status' => false, 'errors' => $validator->errors()];
            }
            else
            {
                $get_user = User::where('email', $request->email)->first();
                $credentials['email'] = $request->email;
                $credentials['password'] = $request->password;
                if(isset($get_user) && $get_user != NULL)
                {

                    if(($get_user->role == '1') || ($get_user->role == '2'))
                    {  
                        if(Auth::attempt($credentials))
                        {
                            $route = route('admin.adminHome');
                            if($request->hidden_route)
                            {
                                $route = $request->hidden_route;
                            }
                            $result = ['status' => true, 'message' => 'Login Successfully.', 'route' => $route];
                        }
                        else
                        {
                            $result = ['status' => false, 'message' => 'Provided credential does not match in our records.'];
                        }
                    }
                    if($get_user->role == '3' && $get_user->is_active == '1' && $get_user->email_verified_at != null)
                    {   
                        if(Auth::attempt($credentials))
                        {
                            $route = route('user.Home');
                            if($request->hidden_route)
                            {
                                $route = $request->hidden_route;
                            }
                            $result = ['status' => true, 'message' => 'Login Successfully.', 'route' => $route];
                        }
                        else
                        {
                            $result = ['status' => false, 'message' => 'Provided credential does not match in our records.'];
                        }            
                    }
                    if($get_user->role == '3' && $get_user->email_verified_at == null)
                    {
                        $result = ['status' => false, 'message' => 'Please verify email first.'];
                    }
                    if($get_user->role == '3' && $get_user->email_verified_at != null && $get_user->is_active == '0')
                    {
                        $result = ['status' => false, 'message' => 'Your account is not activated'];
                    }
                }
                else
                {
                    $result = ['status' => false, 'message' => 'Provided credential does not match in our records.'];
                }
            }
        }
        else
        {
            $result = ['status' => false, 'message' => 'Invalid request'];
        }
        return response()->json($result);
        
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
