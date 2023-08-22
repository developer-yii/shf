<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductArt;
use App\Models\ProductTarget;
use App\Models\ProductUses;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productArts = ProductArt::all();
        $productTargets = ProductTarget::all();
        $productUses = ProductUses::all();


       return view('admin.products.index',['productArts'=>$productArts,'productTargets'=>$productTargets,'productUses'=>$productUses]);
       
    }
    public function get(Request $request)
    {
        if($request->ajax())
        {            
            $data = Product::all();
            return DataTables::of($data)
                                ->addColumn('action', function ($data) {
                return '<a href="javascript:void(0);" class="btn btn-sm btn-info mr-1 edit-product"  data-id="'.$data->id.'" data-toggle="modal" data-target="#addproduct"><i class="mdi mdi-pencil" title="Edit"></i></a></a><a href="javascript:void(0);" class="btn btn-sm btn-danger mr-1 delete-product"  data-id="'.$data->id.' "title="Delete"><i class="mdi mdi-delete"></i></a>';
            })
            ->addColumn('image_full_path', function ($row) {
                return $row->getImageUrl();
            }) 
             ->addColumn('hidden_value', function ($data) {
                return '<input type="hidden" class="hidden-value" value="'.$data->id.'">';
            })
            ->rawColumns(['action', 'hidden_value','image_full_path'])
            ->toJson();
        }
    }
    public function create(Request $request)
    {
        if($request->ajax()) 
        {
            if($request->product_id)
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255|unique:products,name,' . $request->product_id,
                    'price' => 'required|numeric',
                    'product_arts' => 'required|array',
                    'product_arts.*' => 'exists:product_arts,id',
                    'product_target' => 'required|array',
                    'product_target.*' => 'exists:product_targets,id',
                    'product_use_id' => 'required',                    
                    'quantity' => 'required|integer',
                    'product_image' => 'image|mimes:jpeg,png,jpg|max:2048',
                ]);

                if($validator->fails())
                {
                    $result = ['status' => false, 'error' => $validator->errors(),'data' => ''];
                    return response()->json($result);
                }

                $product = Product::find($request->product_id);

                $product->name = $request->input('name');
                $product->product_use_id = $request->input('product_use_id');        
                $product->price = $request->input('price');
                $product->total_volume = $request->input('volume');
                $product->tension = $request->input('tension');
                $product->quantity = $request->input('quantity');
                
                // if(request()->hasfile('product_image'))
                // {

                //     $image_path = public_path("product_images/".$product->image);
                //     if (file_exists($image_path))
                //     {
                //        unlink($image_path);
                //     }              
                //     $product->image = time().'.'.request()->product_image->getClientOriginalExtension();
                //     request()->product_image->move(public_path('product_images'), $product->image);
                // }

                if ($request->hasFile('product_image') && $request->product_image)
                {
                    //delete old file
                     \Storage::delete('public/product_images/'.$request->hidden_image);

                    //insert new file
                    $dir = "public/product_images/";
                    $extension = $request->file("product_image")->getClientOriginalExtension();
                    $filename = "product_image".uniqid() . "_" . time() . "." . $extension;
                    \Storage::disk("local")->put($dir . $filename,\File::get($request->file("product_image")));
                    $product->image = $filename;
                }

                if($product->save())
                {
                    $result = ['status' => true, 'message' => 'Product update successfully.', 'data' => []];
                }
                else
                {
                    $result = ['status' => false, 'message' => 'Product update fail!', 'data' => []];
                }
                
                $product->arts()->sync($request->input('product_arts'));
                $product->targets()->sync($request->input('product_target'));

                return response()->json($result);
            }
            else
            {               
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255|unique:products,name',
                    'price' => 'required|numeric',
                    'product_arts' => 'required|array',
                    'product_arts.*' => 'exists:product_arts,id',
                    'product_target' => 'required|array',
                    'product_target.*' => 'exists:product_targets,id',
                    'product_use_id' => 'required|exists:product_targets,id',
                    'volume' => 'required|string|max:255',
                    'tension' => 'required|string|max:255',
                    'quantity' => 'required|integer',
                    'product_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);

                if($validator->fails())
                {
                    $result = ['status' => false, 'error' => $validator->errors(),'data' => ''];
                    return response()->json($result);
                }

                /*if(request()->hasfile('product_image'))
                {
                    $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
                    request()->product_image->move(public_path('product_images'), $imageName);
                }*/

                if ($request->hasFile('product_image') && $request->product_image)
                {
                    //insert new file
                    $dir = "public/product_images/";
                    $extension = $request->file("product_image")->getClientOriginalExtension();
                    $filename = "product_image".uniqid() . "_" . time() . "." . $extension;
                    \Storage::disk("local")->put($dir . $filename,\File::get($request->file("product_image")));
                    $product->image = $filename;
                }
                
                $product = new Product();
                $product->name = $request->input('name');
                $product->product_use_id = $request->input('product_use_id');        
                $product->price = $request->input('price');
                $product->total_volume = $request->input('volume');
                $product->tension = $request->input('tension');
                $product->quantity = $request->input('quantity');        
                $product->image = $imageName;
                $product->save();

                // Attach product arts and targets
                $product->arts()->attach($request->input('product_arts'));
                $product->targets()->attach($request->input('product_target'));

                $result = [
                    'status' => true,
                    'message' => 'Product use added successfully!',
                ];
            }
            return response()->json($result);
        }
        $result = ['status' => 404, 'message' => 'Something Went Wrong.', 'data' => []];
        return response()->json($result);
    }
    public function detail(Request $request)
    {
        $data = Product::where('id', $request->id)
            ->with([
                'arts' => function ($query) {
                    $query->select('product_arts.id');
                },
                'targets' => function ($query) {
                    $query->select('product_targets.id');
                }
            ])
            ->first();

       
        return response()->json($data);
    }
    public function delete(Request $request)
    {
        $delete =  Product::where('id',$request->id)->delete();
        $result = ["message" => "Product deleted successfully!"];
        return response()->json($result);
    }
}

