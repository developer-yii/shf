<?php

namespace App\Http\Controllers;

use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductCode;
use App\Models\FileCode;
use App\Models\CodeCheckLog;
use Illuminate\Support\Facades\Auth;

class ProductCheckController extends Controller
{
    public function view(){

        return view('frontend.check-product');
    }

    public function checkcode(Request $request){

        $message = [
            'g-recaptcha-response.required' => 'please select captcha code',
            'product_code.required' => 'product code is required'
        ];   

        $validator = Validator::make($request->all(),[
            'product_code' => ['required','max:30'],
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ], $message);

        if($validator->fails()){
            $result = [
                'status' => false,
                'error' => $validator->errors(),
            ];
            return response()->json($result);
        }
        
        if(Auth::user()){
            $userid = Auth::user()->id;
        }

        $code_id = ProductCode::where('code',$request->product_code)->first();
        if(empty($code_id))
        {
            $result = [
                'status' => true,
                'data' => 'notfound'
            ];
            return response()->json($result);
        }

        $findproducts = FileCode::where('product_code_id', $code_id->id)
                        ->where('code_checked_on', null)->get();

        if(!empty($findproducts) && $findproducts->count() > 0)
        {    
            foreach($findproducts as $findproduct)
            {
                $checked_on = $findproduct->code_checked_on;
               $update = FileCode::where('id' ,$findproduct->id)
                    ->update(['code_checked_on'=>NOW()]);

                $createlog = CodeCheckLog::create([
                    'code_id' => $request->product_code,
                    'user_id' => (isset($userid)) ? $userid : null
                ]);      

                $result = [
                    'status' => true,
                    'data' => $findproduct,
                    'checktime' => 'first'                    
                ];
                
                return response()->json($result);                
                break;
            }
        }
        else
        {
            $findproducts = FileCode::where('product_code_id', $code_id->id)
                        ->first();

            $createlog = CodeCheckLog::create([
                    'code_id' => $request->product_code,
                    'user_id' => (isset($userid)) ? $userid : null
                ]);

            $result = [
                'status' => true,
                'data' => $findproducts,
                'checktime' => 'second'
            ];

            return response()->json($result); 
        }
    }
}
