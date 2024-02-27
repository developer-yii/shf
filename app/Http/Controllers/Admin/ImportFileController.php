<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImportFile;
use App\Models\FileCode;
use App\Models\ProductCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class ImportFileController extends Controller
{
    public function list(Request $request)
    {
        if($request->ajax())
        {
            $userRole = Auth::user()->role;

            $data = ImportFile::select('import_files.*', DB::raw('CONCAT(users.first_name, " ", users.last_name) as username'))
            ->leftJoin('users', 'import_files.added_by', '=', 'users.id');

            if ($userRole == 2)
            {
                $data->where('import_files.added_by', 2);
            }
            $data->orderBy('import_files.id', 'desc');
            return DataTables::eloquent($data)
                ->addColumn('file_url', function ($row) {
                    return $row->getFileUrl();
                })
                ->make(true);
        }
        return view('admin.code.filelist');
    }

    public function delete(Request $request)
    {
        $file = ImportFile::find($request->id);
        if($file)
        {
            $codes = FileCode::where('import_file_id', $request->id)->pluck('product_code_id');
            foreach($codes->chunk(100) as $code_chunks)
            {
                $uniquecodes = FileCode::selectRaw('COUNT(product_code_id) AS code_count, product_code_id')
                ->whereIn('product_code_id', $code_chunks)
                ->groupBy('product_code_id')
                ->havingRaw('code_count = 1')
                ->get();

                $uniqueCodeIdsToDelete = $uniquecodes->pluck('product_code_id')->toArray();
                ProductCode::whereIn('id', $uniqueCodeIdsToDelete)->delete();
            }

            $file->filecode()->delete();
            $file->delete();

            $result = ["message" => "File deleted successfully!"];
            return response()->json($result);
        }
        else
        {
            $result = ["error" => "File Not found"];
            return response()->json($result, 404);
        }
    }
}
