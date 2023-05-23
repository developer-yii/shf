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
    return view('welcome');
});
Route::get('logout-user',function(Request $request){
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return $request->wantsJson()
        ? new JsonResponse([], 204)
        : redirect()->route('login')->with('message','You have been successfully logout!');
})->name('logoutuser');

Auth::routes();

include_once 'admin.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
