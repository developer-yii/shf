<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $categories = getCategories();
        return view('frontend.home', compact('categories'));
    }

    public function profile(Request $request)
    {
        $user=Auth::user();

        $rolesMap = [
                1 => 'Superdmin',
                2 => 'Admin',
                3 => 'User',
            ];

        $country = Country::where('id', $user->country_id)->first();
        $countryName = $country ? $country->name : null;

        return view('admin.profile', ["user" => $user,"rolesMap" => $rolesMap, "countryName" => $countryName]);
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

            return view("admin.editprofile", ["data" => $data, "countries" => $countries, "rolesMap" => $rolesMap, "statusMap" => $statusMap]);
        }
        else
        {
            return redirect()->route("admin.profile");
        }
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
      /*   echo "<pre>";
        print_r($user); exit;
*/

        if(!isset($user->id))
        {
            $result = ['status' => false, 'message' => 'User update fail!', 'data' => []];
        }

        $rules = array(
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required','string','email','max:255','unique:users,email,' . $user->id],
            'phone_number' => ['required', 'unique:users,phone_number,' . $user->id],
            'country' => ['required'],
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
            $user->country_id = $request->input('country');

            if($user->role == 1 || $user->role == 2)
            {
                $user->role = $request->input('role');
                $user->is_active = $request->input('userstatus');
            }


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

    public function checkproduct()
    {
        return view('forntend.check-product');
    }
}
