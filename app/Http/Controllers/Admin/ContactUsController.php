<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.contactus.index');   
    }
    public function get(Request $request)
    {        
        if($request->ajax())
        {            
            $data = Contact::all();            
            return DataTables::of($data)
                                ->addColumn('action', function ($data) {
                return '<a href="javascript:void(0);" class="btn btn-sm btn-danger mr-1 delete-contact"  data-id="'.$data->id.' "title="Delete"><i class="mdi mdi-delete"></i></a>';
            })            
            ->toJson();              
        }
    }
    public function delete(Request $request)
    {
        $subscriber = Contact::find($request->id);
     
        $subscriber->delete();
        $msg = "Records Delete successfully";
        $result = ["status" => true, "message" => $msg];
        return response()->json($result);
    }
}
