<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductArt;
use App\Models\ProductTarget;
use App\Models\ProductUses;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class CartController extends Controller
{    
    public function cart()
    {
        return view('user.products.cart');
    }
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
          
        $id=$product->id;
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) 
        {
            $cart[$id]['quantity']++;
        }
        else 
        {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        $cartImageUrl = asset('product_images');
        
        $cartHtml = view('include.cart', compact('cart', 'cartImageUrl'))->render();
        
        $response = [
            'message' => 'Product added to cart successfully!',
            'cartHtml' => $cartHtml,
            'cart' => $cart,
        ];

        return response()->json($response);

    }
    
    public function update(Request $request)
    {        
        if($request->id && $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            $cartImageUrl = asset('product_images');
        
            $cartHtml = view('include.cart', compact('cart', 'cartImageUrl'))->render();
            
            $response = [
                'message' => 'Cart updated successfully!',
                'cartHtml' => $cartHtml,
                'cart' => $cart,
            ];            
            return response()->json($response);            
        }
    }

    public function remove(Request $request)
    {
        if($request->id) 
        {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function checkout(Request $request)
    {
        $user = Auth::user();

        $emailRecipients=User::whereIn('role',[1,2])->get();

        $cart = session()->get('cart');
        $totalPrice = 0;
        if ($cart) 
        {
            $order = Order::create([
            'user_id' => $user->id,
            ]);
            
            foreach ($cart as $orderDetail) 
            {
                $orderDetail = OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $orderDetail['id'],
                    'quantity' => $orderDetail['quantity'],
                    'price' => $orderDetail['price'],
                    'image' => $orderDetail['image'],
                ]);

                $totalPrice += $orderDetail['price'] * $orderDetail['quantity'];
            }

            foreach ($emailRecipients as $recipient) 
            {
                $notification=new Notification;
                $notification->notification_type=3;
                $notification->order_id=$order->id;
                $notification->from_user_id=$user->id;
                $notification->to_user_id=$recipient->id;
                $notification->save();

                Mail::send('emails.orderEmail', ['user' => $user, 'order' => $order, 'totalPrice' => $totalPrice], function ($message) use ($recipient) 
                    {
                        $message->to($recipient->email);
                        $message->subject('New Order');
                    }); 

            }

            session()->forget('cart');

            return redirect()->route('user.summary', ['id' => $order->id]);
        }
    }
    public function orderSummary($id)
    {
        $order = Order::findOrFail($id);
        //$orderDetail = OrderDetail::where('order_id', $order->id)->get();
        $orderDetail = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('order_details.*', 'products.name')
            ->where('order_details.order_id', $order->id)
            ->get();

        return view('user.products.checkout', [
            'order' => $order,
            'orderDetail' => $orderDetail,
        ]);
    }
}
