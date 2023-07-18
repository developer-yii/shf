<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm()
    {
        $countries = Country::all();
        return view('auth.register',compact('countries'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'unique:users', 'numeric'],
            'country' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
     
        if(isset($user->id) && $user->id != Null)
        {
            Mail::send('emails.emailVerificationEmail', ['user' => $user], function($message) use($user){
                        $message->to($user->email);
                        $message->subject('Email Verification Mail');
                    });  
           /* return redirect()->route('register')->with('message','Verification link sent! Please check your registered email and verify your email'); */
            Session::flash('verify', 'A verification link has been send to '.$user->email.'.
                            Please check an email and click on the included link to
                            verify your email.');
            return view("messages");
        }        
    }
    protected function create(array $data)
    {
        $token = Str::random(64);
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'country_id' => $data['country'],
            'role' => 3,
            'password' => Hash::make($data['password']),
            'remember_token' => $token,
        ]);           
    }
    public function verifyAccount($token)
    {
        $verifyUser = User::where('remember_token', $token)->first();

        if (!is_null($verifyUser)) 
        {
            if (!$verifyUser->email_verified_at) 
            {
                $verifyUser->email_verified_at = Carbon::now();

                if ($verifyUser->save()) 
                {
                    Mail::send('emails.accountActivationEmail', ['user' => $verifyUser], function($message) use($verifyUser){
                        $message->to('admin@gmail.com');
                        $message->subject('Account Activation Mail');
                    });

                    /*return redirect("register")->with('message','Your e-mail is verified successfully. you will get mail when your account is activated.');*/
                    Session::flash('verify', 'Your e-mail is verified successfully. you will get mail when your account is activated.');
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
                Session::flash('verify', 'Your e-mail is already verified.');
                return view("messages");
            }
        }
        Session::flash('verify', 'Sorry your email cannot be identified.');
        return view("messages");
    }
    
}
