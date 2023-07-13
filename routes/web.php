<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.userHome');

Route::get('check/product','ProductCheckController@view')->name('view');
Route::post('check/product','ProductCheckController@checkcode')->name('check.code');

Route::get('logout-user',function(Request $request){
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return $request->wantsJson()
        ? new JsonResponse([], 204)
        : redirect()->route('login')->with('message','You have been successfully logout!');
})->name('logoutuser');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Auth::routes();


include_once 'admin.php';

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
