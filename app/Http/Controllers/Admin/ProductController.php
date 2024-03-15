<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductArt;
use App\Models\ProductIngredient;
use App\Models\ProductTarget;
use App\Models\ProductUses;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productArts = ProductArt::all();
        $productTargets = ProductTarget::all();
        $productUses = ProductUses::all();
        $productIngredients = ProductIngredient::all();

        return view('admin.products.index',['productArts'=>$productArts,'productTargets'=>$productTargets,'productUses'=>$productUses, 'productIngredients' => $productIngredients]);

    }
    public function get(Request $request)
    {
        if($request->ajax())
        {
            //$data = Product::all();
            $data = Product::orderBy('id', 'desc')->get();
            foreach ($data as $item)
            {
                $unitInfo = getUnitByVolumeType($item->volume_type);
                $item->total_volume_formatted = $item->total_volume . ' ' . $unitInfo['unit'];
            }

            return DataTables::of($data)
                                ->addColumn('action', function ($data) {
                return '<a href="javascript:void(0);" class="btn btn-sm btn-info mr-1 edit-product" data-id="'.$data->id.'" data-toggle="modal" data-target="#addproduct"><i class="mdi mdi-pencil" title="Edit"></i></a></a><a href="javascript:void(0);" class="btn btn-sm btn-danger mr-1 delete-product"  data-id="'.$data->id.' "title="Delete"><i class="mdi mdi-delete"></i></a>';
            })
            ->addColumn('image', function ($row) {
                return $row->getImageUrl();
            })
            ->rawColumns(['action','image'])
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
                    'product_image_big' => 'image|mimes:jpeg,png,jpg|max:2048',
                    'product_image_small' => 'image|mimes:jpeg,png,jpg|max:2048',
                    'product_image_banner' => 'image|mimes:jpeg,png,jpg|max:2048',
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
                $product->volume_type = $request->input('volume_type');
                $product->tension = $request->input('tension');
                $product->quantity = $request->input('quantity');
                $product->description = $request->input('description');

                if ($request->hasFile('product_image_big')) {
                    if ($product->big_image) {
                        Storage::delete('public/product_images/'.$product->big_image);
                    }
                    $filename = storeProductImage($request->file("product_image_big"), "product_image_big");
                    $product->big_image = $filename;
                }

                if ($request->hasFile('product_image_small')) {
                    if ($product->image) {
                        Storage::delete('public/product_images/'.$product->image);
                    }
                    $filename = storeProductImage($request->file("product_image_small"), "product_image_small");
                    $product->image = $filename;
                }

                if ($request->hasFile('product_image_banner')) {
                    if ($product->banner_image) {
                        Storage::delete('public/product_images/'.$product->banner_image);
                    }
                    $filename = storeProductImage($request->file("product_image_banner"), "product_image_banner");
                    $product->banner_image = $filename;
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
                $product->ingredients()->sync($request->input('product_ingredient'));

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
                    'quantity' => 'required|integer',
                    'product_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'product_image_big' => 'image|mimes:jpeg,png,jpg|max:2048',
                    'product_image_small' => 'image|mimes:jpeg,png,jpg|max:2048',
                    'product_image_banner' => 'image|mimes:jpeg,png,jpg|max:2048',
                ]);

                if($validator->fails())
                {
                    $result = ['status' => false, 'error' => $validator->errors(),'data' => ''];
                    return response()->json($result);
                }

                $product = new Product();
                $product->name = $request->input('name');
                $product->product_use_id = $request->input('product_use_id');
                $product->price = $request->input('price');
                $product->total_volume = $request->input('volume');
                $product->volume_type = $request->input('volume_type');
                $product->tension = $request->input('tension');
                $product->quantity = $request->input('quantity');
                $product->description = $request->input('description');

                if ($request->hasFile('product_image_big')) {
                    $filename = storeProductImage($request->file("product_image_big"), "product_image_big");
                    $product->big_image = $filename;
                }

                if ($request->hasFile('product_image_small')) {
                    $filename = storeProductImage($request->file("product_image_small"), "product_image_small");
                    $product->image = $filename;
                }

                if ($request->hasFile('product_image_banner')) {
                    $filename = storeProductImage($request->file("product_image_banner"), "product_image_banner");
                    $product->banner_image = $filename;
                }

                $product->save();

                // Attach product arts and targets
                $product->arts()->attach($request->input('product_arts'));
                $product->targets()->attach($request->input('product_target'));
                $product->ingredients()->attach($request->input('product_ingredient'));

                $result = [
                    'status' => true,
                    'message' => 'Product use added successfully!',
                ];
                return response()->json($result);
            }
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
                },
                'ingredients' => function ($query) {
                    $query->select('product_ingredients.id');
                },
            ])
            ->first();
        $data->image = asset('storage/product_images/' . $data->image);
        $data->big_image = asset('storage/product_images/' . $data->big_image);
        $data->banner_image = asset('storage/product_images/' . $data->banner_image);

        return response()->json($data);
    }
    public function delete(Request $request)
    {
        $delete =  Product::where('id',$request->id)->delete();
        $result = ["message" => "Product deleted successfully!"];
        return response()->json($result);
    }
}

