<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use Yajra\DataTables\Facades\DataTables;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.subscriber.index');   
    }
    public function get(Request $request)
    {
        
        if($request->ajax())
        {            
            $data = Subscribe::all();
            
            return DataTables::of($data)
                                ->addColumn('action', function ($data) {
                return '<a href="javascript:void(0);" class="btn btn-sm btn-danger mr-1 delete-subscriber"  data-id="'.$data->id.' "title="Delete"><i class="mdi mdi-delete"></i></a>';
            })
            
            ->toJson();              
        }
    }
    public function delete(Request $request)
    {
        $subscriber = Subscribe::find($request->id);
     
        $subscriber->delete();
        $msg = "Records Delete successfully";
        $result = ["status" => true, "message" => $msg];
        return response()->json($result);
    }
}
