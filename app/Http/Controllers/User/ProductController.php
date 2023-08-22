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
        
        //$productArts = ProductArt::all();
        //$productTargets = ProductTarget::all();
        //$productUses = ProductUses::all();
        $products = Product::all();
        $cart = session()->get('cart', []);        
        return view('user.products.index',['products'=>$products, 'cart'=>$cart]);
       
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
