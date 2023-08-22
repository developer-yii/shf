<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductArt;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderStatusChanged;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::select('orders.id as order_id', 'users.first_name', 'users.last_name', 'order_details.product_id', 'order_details.quantity', 'order_details.price')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->get();
        return view('admin.orders.index',['orders'=>$orders]);
    }

    public function get(Request $request)
    {
        if($request->ajax())
        {          
            $user = Auth::user();  
            $prepare_data = Order::selectRaw('orders.id as order_id, CONCAT(users.first_name, " ", users.last_name) as username, DATE_FORMAT(orders.created_at, "%d-%m-%Y") as order_created_date, SUM(order_details.quantity * order_details.price) as total_amount, orders.status')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id');
            if (isAdmin($user))
            {
                $data = $prepare_data->groupBy('order_id', 'users.first_name', 'users.last_name')
                ->orderBy('order_id', 'desc')
                ->get();
            } 
            else 
            {
                $data = $prepare_data->where('orders.user_id', $user->id)
                ->groupBy('order_id', 'users.first_name', 'users.last_name')
                ->orderBy('order_id', 'desc')
                ->get();
            }

            return Datatables()::of($data)

            ->editColumn('status_label', function($row) use($user) {

                $selected1 = '';
                $selected2 = '';
                $selected3 = '';
                $selected4 = '';

                if ($row->status == "Pending") {
                    $selected1 = 'selected';
                } else if ($row->status == "Processing") {
                    $selected2 = 'selected';
                } else if ($row->status == "Completed") {
                    $selected3 = 'selected';
                } else if ($row->status == "Cancelled") {
                    $selected4 = 'selected';
                }
                if(isAdmin($user))
                    return '<select name="order_status" class="form-control order_status" data-id="'.$row->order_id.'"><option value="Pending" '.$selected1.'>Pending</option><option value="Processing" '.$selected2.'>Processing</option><option value="Completed" '.$selected3.'>Completed</option><option value="Cancelled" '.$selected4.'>Cancelled</option></select>';

                if ($row->status == "Pending") {
                    return 'Pending';
                } else if ($row->status == "Processing") {
                    return 'Processing';
                } else if ($row->status == "Completed") {
                    return 'Completed';
                } else {
                    return 'Cancelled';
                }
                
            })
            ->rawColumns(['Actions','status_label'])
            ->make(true);
        }        
        return DataTables::eloquent($data)->toJson();
    }
    public function change_status(Request $request)
    {
        $order = Order::find($request->id);

        if($order) 
        {
            $user_id = $order->user_id;
            $order->status = $request->status;
            if($order->save()) 
            {
                $user = User::find($order->user_id);
                if($user)
                {
                    $notification=new Notification;
                    $notification->notification_type=3;
                    $notification->order_id=$order->id;
                    $notification->from_user_id=Auth::user()->id;
                    $notification->to_user_id=$user->id;
                    $notification->save();

                    $email = $user->email;
                    Mail::to($email)->send(new OrderStatusChanged($order, $user));                   
                }
                $result = ['status' => true, 'message' => 'Status changed successfully'];
            }

            else
            {
                $result = ['status' => false, 'message' => 'Failed to change status'];
            }
        } 
        else 
        {
            $result = ['status' => false, 'message' => 'Something went wrong'];
        }

        return response()->json($result);
    }
    public function detail(Request $request)
    {
        $order = Order::find($request->id); 
        $loginUserid = Auth::user()->id;

        Notification::query()->where('to_user_id', $loginUserid)
            ->where('order_id', $request->id)
            ->update(['is_read' => 1]);


        if($order)
        {            
            $orderDetail = OrderDetail::join('products', 'order_details.product_id', '=', 'products.id')
                ->select('order_details.*', 'products.name', 'products.image')
                ->where('order_details.order_id', $order->id)
                ->get(); 

            $user = User::join('countries', 'users.country_id', '=', 'countries.id')
                ->where('users.id', $order->user_id)
                ->select('users.*', 'countries.name as country_name')
                ->first();

                return view('admin.orders.details', [
                'order' => $order,
                'orderDetail' => $orderDetail,
                'user' => $user,
            ]);
        }
        else
        {
            return back();
        }
    }
}
