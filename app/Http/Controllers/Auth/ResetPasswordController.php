<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
        
    }
    protected function sendResetResponse(Request $request, $response)
    {
        $result = ['status' => true, 'message' => trans($response)];
        return response()->json($result, 200);
    }
    protected function sendResetFailedResponse(Request $request, $response)
    {
        $result = ['status' => false, 'messages' => trans($response)];
        return response()->json($result, 422);
    }

    protected function redirectTo()
    {
        
        // Retrieve the authenticated user
         $user = $this->guard()->user();
         
        // Check the user's role and return the appropriate redirect URL
        if(($user->role == '1') || ($user->role == '2'))
        {
            $result = ['status' => true, 'message' => 'Login Successfully.'];
            return response()->json($result);
        }
        else
        {
            $result = ['status' => true, 'message' => 'Login Successfully.'];
            return response()->json($result);
        }

    }
}
