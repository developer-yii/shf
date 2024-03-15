<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductIngredient;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductIngredientController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.productingredient.index');
    }
    public function get(Request $request)
    {

        if($request->ajax())
        {
            $data = ProductIngredient::select('id', 'ingredient_name')->get();
            return DataTables::of($data)
                                ->addColumn('action', function ($data) {
                return '<a href="javascript:void(0);" class="btn btn-sm btn-info mr-1 edit-productingredient"  data-id="'.$data->id.'" data-toggle="modal" data-target="#addproducingredient"><i class="mdi mdi-pencil" title="Edit"></i></a></a><a href="javascript:void(0);" class="btn btn-sm btn-danger mr-1 delete-productingredient"  data-id="'.$data->id.' "title="Delete"><i class="mdi mdi-delete"></i></a>';
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
            'name' => 'required|unique:product_ingredients,ingredient_name,' . $request->product_ingredient_id,
        ]);

        if($validator->fails())
        {
            $result = ['status' => false, 'error' => $validator->errors(),'data' => ''];
            return response()->json($result);
        }
        $update_id = (isset($request->product_ingredient_id) && !empty($request->product_ingredient_id)) ? $request->product_ingredient_id : "";

        $insert_data = [];
        $insert_data['ingredient_name'] = $request->name;

        $insert_data['updated_at'] = ($update_id != "") ? NOW() : "";

        if($update_id)
        {
            $update = ProductIngredient::where('id',$update_id)->update($insert_data);
        }
        else
        {
            $insert = ProductIngredient::create($insert_data);
        }

        $result = [
            'status' => true,
            'message' => ($update_id == "") ? 'Product ingredient added successfully!' : 'Product ingredient updated successfully',
        ];

        return response()->json($result);

    }
    public function detail(Request $request)
    {
        $data = ProductIngredient::where('id',$request->id)->first();
        return response()->json($data);
    }
    public function delete(Request $request)
    {
        try {
            $productIngredient = ProductIngredient::findOrFail($request->id);
            DB::table('product_product_ingredient')
                ->where('product_ingredient_id', $request->id)
                ->delete();
            $productIngredient->delete();
            return response()->json(["message" => "Product Ingredient deleted successfully!"], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Product Ingredient not found."], 404);
        } catch (Exception $e) {
            return response()->json(["message" => "Failed to delete Product Ingredient."], 500);
        }
    }
}
