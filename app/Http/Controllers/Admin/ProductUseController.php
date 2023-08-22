<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductUses;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductUseController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.productuse.index');   
    }
    public function get(Request $request)
    {
        
        if($request->ajax())
        {            
            $data = ProductUses::select('id', 'use')->get();
            return DataTables::of($data)
                                ->addColumn('action', function ($data) {
                return '<a href="javascript:void(0);" class="btn btn-sm btn-info mr-1 edit-productuse"  data-id="'.$data->id.'" data-toggle="modal" data-target="#addproductuse"><i class="mdi mdi-pencil" title="Edit"></i></a></a><a href="javascript:void(0);" class="btn btn-sm btn-danger mr-1 delete-productuse"  data-id="'.$data->id.' "title="Delete"><i class="mdi mdi-delete"></i></a>';
            }) 
             ->addColumn('hidden_value', function ($data) {
                return '<input type="hidden" class="hidden-value" value="'.$data->id.'">';
            })
            ->rawColumns(['action', 'hidden_value'])
            ->toJson();                         
        }
    }
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'use' => 'required|unique:product_uses,use,' . $request->product_use_id,
        ]);

        if($validator->fails())
        {
            $result = ['status' => false, 'error' => $validator->errors(),'data' => ''];
            return response()->json($result);
        }
        $update_id = (isset($request->product_use_id) && !empty($request->product_use_id)) ? $request->product_use_id : "";

        $insert_data = [];
        $insert_data['use'] = $request->use;
        
        $insert_data['updated_at'] = ($update_id != "") ? NOW() : "";

        if($update_id)
        {
            $update = ProductUses::where('id',$update_id)->update($insert_data);
        }
        else
        {
            $insert = ProductUses::create($insert_data);
        }

        $result = [
            'status' => true,
            'message' => ($update_id == "") ? 'Product use added successfully!' : 'Product use updated successfully',
        ];

        return response()->json($result);

        
    }
    public function detail(Request $request)
    {
        $data = ProductUses::where('id',$request->id)->first();
        return response()->json($data);
    }
    public function delete(Request $request)
    {
        $delete =  ProductUses::where('id',$request->id)->delete();
        $result = ["message" => "Product use deleted successfully!"];
        return response()->json($result);
    }
}
