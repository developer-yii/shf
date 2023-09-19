<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductArt;
use App\Models\ProductTarget;
use App\Models\ProductUses;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class ProductController extends Controller
{
    public function index(Request $request)
    { 
        $productArts = ProductArt::with(['products.targets', 'products.productUse'])->get();

        $groupedProducts = [];
            
        foreach ($productArts as $productArt) 
        {
            $groupedProducts[$productArt->id]['productArt'] = $productArt;

            if ($productArt->name == 'Inject' || $productArt->name == 'Peptides') 
            {
                $artIcon = asset('frontend/img/inject.svg');
            } 
            elseif ($productArt->name == 'Capsules'|| $productArt->name == 'Sarms') 
            {
                $artIcon = asset('frontend/img/capsules.svg');
            }
            elseif ($productArt->name == 'Tablets') 
            {
                $artIcon = asset('frontend/img/tablets.svg');
            }
            elseif ($productArt->name == 'Liquids') 
            {
                $artIcon = asset('frontend/img/liquid.svg');
            }
            else 
            {
                $artIcon = asset('frontend/img/spec-icon.svg');; // Default icon path or handle other cases here
            }

            $groupedProducts[$productArt->id]['products'] = $productArt->products->take(4)
            ->map(function ($product) use ($artIcon)
            {                
                $product->unit = getUnitByVolumeType($product->volume_type);
                $product->artIcon = $artIcon;
                return $product;
            });
           
        }        
        return view('products', compact('groupedProducts'));
       
    }
    

    public function category(Request $request)
    {         
        $productArt = ProductArt::with(['products.targets', 'products.productUse'])
                    ->where('id', $request->id)
                    ->first();

        // pre(count($productArt->count());

        if (!$productArt) 
        {
            abort(404); // Handle the case when the productArt is not found
        }
        
        
        $artIcon = ''; 
            
        
        // $groupedProducts[$productArt->id]['productArt'] = $productArt;
        $groupedProducts = $productArt->products()->paginate(3);
        // return view('product-category', compact('groupedProducts'));        
           
            // $count = count($productArt->products);
            
    
            
            // $currentPage = Paginator::resolveCurrentPage('page');
            // $productsPerPage = 2; // You can change this value to your preferred number of products per page

            // $paginatedProducts = new LengthAwarePaginator(
            //     $groupedProducts[$productArt->id]['products']->forPage($currentPage, $productsPerPage),
            //     $count,
            //     $productsPerPage,
            //     $currentPage
            // );

             // pre(count($paginatedProducts));

            return view('product-category', compact('groupedProducts', 'productArt'));
            
    }

    public function detail(Request $request)
    { 
        $product = Product::getProductDetail($request->id);

        if($product)
        {
            $cart = session()->get('cart', []);
            $productUse = $product->productUse->use;
            return view('product-detail',['product'=>$product, 'cart'=>$cart,'productUse' => $productUse]);
        }
        else
        {            
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $productArts = ProductArt::with(['products.targets', 'products.productUse'])->get();

        // Initialize an empty array to store filtered products
        $filteredProducts = [];

        foreach ($productArts as $productArt) 
        {
            // Filter products by product art and keyword
            $filteredProducts[$productArt->name] = $productArt->products()
                ->where('name', 'LIKE', '%' . $request->keyword . '%')
                ->take(5) // Limit to 5 products per art
                ->get();
        }

        return response()->json([
            'filteredProducts' => $filteredProducts,
        ]);
    }
}
