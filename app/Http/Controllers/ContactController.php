<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormEmail;
use Illuminate\Support\Facades\Mail;
use App\Rules\ReCaptcha;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }
    public function submit(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha],
        ]);

        if ($validatedData->fails())
        {
            $response = ['status' => false,'errors' => $validatedData->errors()];
            return response()->json($response);
        }

        $contact = new Contact;
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->country = getCountryNameById($request->country);
        $contact->message = $request->message;
        if($contact->save())
        {
           $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'country' => getCountryNameById($request->country),
                'message' => $request->message,
            ];

            Mail::to($request->email)->send(new ContactFormEmail($data));

            $response = ['status' => true,'message' => "Email Send Successfully" ];
        }
        else
        {
            $response = ['status' => false,'message' => "Email Not Sent" ];
        }
        return response()->json($response);
    }

}
