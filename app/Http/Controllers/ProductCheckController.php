<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductCode;
use App\Models\CodeCheckLog;
use Illuminate\Support\Facades\Auth;

class ProductCheckController extends Controller
{
    public function view(){

        return view('frontend.check-product');
    }

    public function checkcode(Request $request){
        
        $validator = Validator::make($request->all(),[
            'product_code' => ['required','max:30'],
            'g-recaptcha-response' => ['required']
        ]);

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

        $findproduct = ProductCode::where('code',$request->product_code)->first();
        if(empty($findproduct)){
            $result = [
                'status' => true,
                'data' => 'notfound'
            ];
            return response()->json($result);
        }
        $checked_on = $findproduct->code_checked_on;

        if(!empty($findproduct) && $checked_on == null){
            $update = ProductCode::where('id' ,$findproduct->id)
                                    ->update(['code_checked_on'=>NOW()]);
       
        }

        $createlog = CodeCheckLog::create([
            'code_id' => $request->product_code,
            'user_id' => (isset($userid)) ? $userid : null
        ]);

        $result = [
            'status' => true,
            'data' => $findproduct,
            'checktime' => ($checked_on == null) ? 'first' : 'second'
        ];

        return response()->json($result);
    }
}
