<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductArt;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductArtController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.productart.index');   
    }
    public function get(Request $request)
    {
        
        if($request->ajax())
        {            
            $data = ProductArt::select('id', 'name')->get();
            return DataTables::of($data)
                                ->addColumn('action', function ($data) {
                return '<a href="javascript:void(0);" class="btn btn-sm btn-info mr-1 edit-productart"  data-id="'.$data->id.'" data-toggle="modal" data-target="#addproductart"><i class="mdi mdi-pencil" title="Edit"></i></a></a><a href="javascript:void(0);" class="btn btn-sm btn-danger mr-1 delete-productart"  data-id="'.$data->id.' "title="Delete"><i class="mdi mdi-delete"></i></a>';
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
            'name' => 'required|unique:product_arts,name,' . $request->product_art_id,
        ]);

        if($validator->fails())
        {
            $result = ['status' => false, 'error' => $validator->errors(),'data' => ''];
            return response()->json($result);
        }
        $update_id = (isset($request->product_art_id) && !empty($request->product_art_id)) ? $request->product_art_id : "";

        $insert_data = [];
        $insert_data['name'] = $request->name;
        
        $insert_data['updated_at'] = ($update_id != "") ? NOW() : "";

        if($update_id)
        {
            $update = ProductArt::where('id',$update_id)->update($insert_data);
        }
        else
        {
            $insert = ProductArt::create($insert_data);
        }

        $result = [
            'status' => true,
            'message' => ($update_id == "") ? 'Product art added successfully!' : 'Product art updated successfully',
        ];

        return response()->json($result);
    }
    public function detail(Request $request)
    {
        $data = ProductArt::where('id',$request->id)->first();
        return response()->json($data);
    }
    public function delete(Request $request)
    {
        $productArtId = $request->id;
        
        // Delete the entry from the pivot table
        DB::table('product_product_art')
            ->where('product_art_id', $productArtId)
            ->delete();

        $delete =  ProductArt::where('id',$request->id)->delete();
        $result = ["message" => "Product art deleted successfully!"];
        return response()->json($result);
    }
}
