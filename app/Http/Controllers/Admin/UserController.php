<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Country;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.user.index');   
    }
    public function get(Request $request)
    {
        $loginUser = Auth::user();
        if($request->ajax())
        {            
            $data = User::where("id", "!=", Auth::user()->id);
            
            return DataTables::of($data)
                                ->addColumn('action', function ($data) {
                return '<a href="'.route('admin.user.view', 'id='.$data->id).'" class="btn btn-sm btn-primary mr-1"  data-id="'.$data->id.'"><i class="mdi mdi-eye"></i></a><a href="'.route('admin.user.edit', 'id='.$data->id).'" class="btn btn-sm btn-primary mr-1"  data-id="'.$data->id.'"><i class="mdi mdi-pencil"></i></a></a><a href="javascript:void(0);" class="btn btn-sm btn-primary mr-1 delete-user"  data-id="'.$data->id.'"><i class="mdi mdi-delete"></i></a>';
            })

            
            ->editColumn("role", function ($data) {
                    $role_type = "";
                    if ($data->role) {
                        if($data->role == 1)
                        {
                            return "Superadmin";
                        }
                        elseif($data->role == 2)
                        {
                            return "Admin";
                        }
                        else
                        {
                            return "User";
                        }
                    }
                })
            ->rawColumns(['action','role'])
            ->toJson();              
        }
    }
    public function view(Request $request)
    {
        $data = User::where("id", $request->id)->first();

        if ($data) 
        {   
            $country_id=$data->country_id;
            $data->countryname = Country::where('id', $data->country_id)->value('name');
            $userrole=$data->role;
            //user Role 
            if($userrole == 1)
            {
                $data->userrole = "Superadmin";
            }
            elseif($userrole == 2)
            {
                $data->userrole = "Admin";
            }
            else
            {
                $data->userrole = "User";
            }
            //email-verification status
            if($data->email_verified_at != Null )
            {
               $data->email_verification = "Complete" ;
            }
            else
            {
                $data->email_verification = "Pending" ;   
            }
           
            return view("admin.user.view", ['data' => $data]);
        }
        else
        {
            return back();
        }
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        
        /*$messages = $user->messages;
        foreach($messages as $message)
        {
            // $chats = $message->chats->each->delete();
            //$notifications = $message->notifications->each->delete();
            $message->delete();
        }*/
        
        /*
        echo "<pre>";
        print_r($user);*/
        $user->delete();
        $msg = "Records Delete successfully";
        $result = ["status" => true, "message" => $msg];
        return response()->json($result);
    }
    public function edit(Request $request)
    {
        $data = User::where("id", $request->id)->first();

        if ($data) 
        {
            $countries = Country::all();
            $rolesMap = [
                1 => 'superadmin',
                2 => 'admin',
                3 => 'user',
            ];
            $statusMap = [
                1 => 'Active',
                0 => 'Inactive',                
            ];
        
            return view("admin.user.edit", ["data" => $data, "countries" => $countries, "rolesMap" => $rolesMap, "statusMap" => $statusMap]);
        }
        else
        {
            return redirect()->route("admin.user");
        }
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        if(!isset($user->id))
        {
            $result = ['status' => false, 'message' => 'User update fail!', 'data' => []];
        }

        $rules = array(
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required','string','email','max:255','unique:users,email,' . $user->id],
            'phone_number' => ['required', 'unique:users,phone_number,' . $user->id],
            'role' => ['required'],
            'country' => ['required'],
            'userstatus' => ['required'],
        );
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            $result = ['status' => false, 'message' => $validator->errors(), 'data' => []];
        }
        else
        {
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');
            $user->role = $request->input('role');
            $user->is_active = $request->input('userstatus');
            $user->country_id = $request->input('country');
            
            
            if($user->save())
            {
                $result = ['status' => true, 'message' => 'User update successfully.', 'data' => []];
            }
            else
            {
                $result = ['status' => false, 'message' => 'User update fail!', 'data' => []];
            }
        }
        return response()->json($result);
       
    }

    
}
