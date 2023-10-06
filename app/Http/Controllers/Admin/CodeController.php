<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductCode;
use App\Models\ImportFile;
use App\Models\FileCode;
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
        if($request->ajax())
        {
            $data = ProductCode::query()->with('filecode');            
            return DataTables::eloquent($data)
                ->addColumn('code_checked_on', function ($productCode) {
                    return $productCode->filecode ? $productCode->filecode->code_checked_on : '';
                })
                ->toJson();
            
        }            
        return view('admin.code.list');
    }   

    public function codeimport(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'excelfile' => ['required','file','mimes:xls,xlsx']
        ]);

        if($validator->fails())
        {
            $result = [
                'status' => false,
                'error' => $validator->errors(),
                'data' => ''
            ];

            return response()->json($result);
        }

        if ($request->hasFile('excelfile')) 
        {
            $file = $request->file('excelfile');

            $uploaded_file_name = $file->getClientOriginalName();           

            //insert new file
            $dir = "public/imported_code_files/";           
            
            $extension = $request->file("excelfile")->getClientOriginalExtension();
            $filename = uniqid() . "_" . time() . "." . $extension;

            $filePath = $dir.$filename;
            \Storage::disk("local")->put($filePath,\File::get($request->file("excelfile")));
            
            ini_set('max_execution_time', 180);
            $userid = Auth::user()->id;
            $import = new ProductCodeImport();
            $rows = Excel::toArray($import, $filePath);

            $successfulRows = 0;
            $duplicateRows = 0;
            $totalCodesInFile = 0;
            
            $insertArray = [];
            $duplicateArray = [];
            $index = 0;
            $date = date('Y-m-d H:i:s');
            
            $allProductCode = ProductCode::pluck('id', 'code')->toArray();
            
            $chunkImportedCodes = [];
            foreach ($rows[0] as $row) 
            {                
                if(isset($row[0]) && !empty($row[0]) && $row[0] && strtolower($row[0]) != "code")
                {
                    $totalCodesInFile++;
                    $productCode = $row[0];                   
                    if (array_key_exists($productCode, $allProductCode) || in_array($productCode, $chunkImportedCodes)) {
                        if (isset($allProductCode[$productCode])) 
                        {
                            $duplicateArray[$productCode] = $allProductCode[$productCode];
                        }
                        $duplicateRows++;
                    }
                    else 
                    {
                        $insertArray[$index][] = ['code' => $productCode, 'created_at' => $date, 'updated_at' => $date];
                        $chunkImportedCodes[] = $productCode;
                        $successfulRows++;
                        if (count($insertArray[$index]) == 1000) 
                        {              
                            $index++;
                        }
                    }
                }
            }

            if($totalCodesInFile > 0)
            {
                $import_file = new ImportFile();
                $import_file->name = $filename;
                $import_file->uploaded_file_name = $uploaded_file_name;
                $import_file->added_by = Auth::user()->id;
                $import_file->codes_imported = $totalCodesInFile;            
                $import_file->save();
                
                foreach ($duplicateArray as $list2)
                {
                    $duplicate_code = new FileCode();
                    $duplicate_code->import_file_id = $import_file->id;
                    $duplicate_code->product_code_id = $list2;
                    $duplicate_code->save();
                }           
                
                foreach ($insertArray as $list)
                {   
                    //ProductCode::insert($list); 
                    foreach ($list as $codeData) 
                    {
                        $productCode = new ProductCode();
                        $productCode->code = $codeData['code'];
                        $productCode->save();
                        
                        $new_code = new FileCode();
                        $new_code->import_file_id = $import_file->id;
                        $new_code->product_code_id = $productCode->id;
                        $new_code->save();                    
                    }           
                }

                $result = [
                    'status' => true,
                    'message' => 'Product code imported successfully',
                ];
                return response()->json($result);
            }
            else
            {
                \Storage::disk("local")->delete($filePath);
                $result = ["error" => "Your file is Empty"];
                return response()->json($result, 404);
            }

            
        }

        return redirect()->back()->with('error','No file uploaded!');
        

    }

}
