<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductArt;
use App\Models\ProductTarget;
use App\Models\ProductUses;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {   
        $cart = session()->get('cart', []);        
        $productArtId = $request->input('id');
        $productArtName = null; // Initialize the productArtName variable

        $query = Product::query();

        if ($productArtId) {
            $query = Product::whereHas('arts', function ($query) use ($productArtId) {
                $query->where('product_art_id', $productArtId);
            });            
            
            $productArt = ProductArt::find($productArtId);
            if ($productArt) {
                $productArtName = $productArt->name;
            }
        }
        
        $products = $query->paginate(5); 
        $products->appends($request->all());

        return view('user.products.index',['products'=>$products, 'cart'=>$cart, 'productArtName' => $productArtName,]);
       
    }
    public function detail(Request $request)
    { 
        $product = Product::getProductDetail($request->id);

        if($product)
        {
            $cart = session()->get('cart', []);        
            return view('user.products.detail',['product'=>$product, 'cart'=>$cart]);       
        }
        else
        {            
            return redirect()->back();
        }
    }
    
}
