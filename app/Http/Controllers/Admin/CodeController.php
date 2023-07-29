<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductCode;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Jobs\ExcelImportCode;
use App\Imports\ProductCodeImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class CodeController extends Controller
{
    public function codelist(Request $request)
    {
        if($request->ajax()){
            $data = ProductCode::select('product_codes.*','users.first_name as user_name')
                                 ->leftjoin('users','product_codes.added_by','=','users.id');
            return DataTables::eloquent($data)
                                ->make(true);                                                     
            }
            
        return view('admin.code.list');
    }

    public function codecreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['required','unique:product_codes,code' ,'max:30']
        ]);

        if($validator->fails()){
            $result = [
                'status' => false,
                'error' => $validator->errors(),
                'data' => ''
            ];

            return response()->json($result);
        }

        $userid = Auth::user()->id;
        $update_id = (isset($request->code_id) && !empty($request->code_id)) ? $request->code_id : "";

        $insert_data = [];
        $insert_data['code'] = $request->code;
        $insert_data['added_by'] = $userid;
        $insert_data['updated_at'] = ($update_id != "") ? NOW() : "";

        if($update_id){
            $update = ProductCode::where('id',$update_id)->update($insert_data);
        }else{
            $insert = ProductCode::create($insert_data);
        }

        $result = [
            'status' => true,
            'message' => ($update_id == "") ? 'Code added successfully!' : 'Code updated successfully',
        ];

        return response()->json($result);
    }

    public function codedetail(Request $request){
        $data = ProductCode::where('id',$request->id)->first();

        return response()->json($data);
    }

    public function codedelete(Request $request)
    {
        $delete =  ProductCode::where('id',$request->id)->delete();

        $result = ["message" => "Product code deleted successfully!"];

        return response()->json($result);
    }

    public function codeimport(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'excelfile' => ['required','file','mimes:xls,xlsx']
        ]);

        if($validator->fails()){
            $result = [
                'status' => false,
                'error' => $validator->errors(),
                'data' => ''
            ];

            return response()->json($result);
        }

        if ($request->hasFile('excelfile')) {
            $file = $request->file('excelfile');
            $filePath = $file->store('temp');

            // ExcelImportCode::dispatch(storage_path('app/' . $filePath))->onQueue('imports');

            ini_set('max_execution_time', 180);
            $userid = Auth::user()->id;
            $import = new ProductCodeImport();
            $rows = Excel::toArray($import, $filePath);
            $successfulRows = 0;
            $duplicateRows = 0;
            
            $insertArray = [];
            $index = 0;
            $date = date('Y-m-d H:i:s');

            $allProductCode = ProductCode::select('code')->pluck('code')->toArray();        
            $chunkImportedCodes = [];
            foreach ($rows[0] as $row) {
                if(isset($row[0]) && !empty($row[0]) && $row[0] && strtolower($row[0]) != "code"){
                    $productCode = $row[0];
                    if (in_array($productCode, $allProductCode) || in_array($productCode, $chunkImportedCodes)) {
                        $duplicateRows++;
                    } else {
                        $insertArray[$index][] = ['code' => $productCode, 'added_by' => $userid, 'created_at' => $date, 'updated_at' => $date];
                        $chunkImportedCodes[] = $productCode;
                        $successfulRows++;
                        if (count($insertArray[$index]) == 1000) {                        
                            $index++;
                        }
                    }
                }
            }
            foreach ($insertArray as $list)
            {            
                ProductCode::insert($list);            
            }
            // Delete the temporary file
            Storage::disk("local")->delete($filePath);
                $result = [
                    'status' => true,
                    'message' => ($duplicateRows == 0) ? $successfulRows.' Product code imported successfully' : $successfulRows.' Product code imported successfully! and '.$duplicateRows.' Product code found duplicate',
                ];
        
                return response()->json($result);
            }

       return redirect()->back()->with('error','No file uploaded!');
        

    }

}
