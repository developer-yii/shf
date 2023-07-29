<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*use App\Http\Controllers\Auth\VerificationController;*/

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
Auth::routes();
Route::get('/', function () {
    return view('frontend.home');
})->name('frontend.home');

// for Email verification
Route::get('/verify-account/{token}', 'Auth\RegisterController@verifyAccount')->name('verify-account');

//frontend
Route::middleware(['auth'])->group(function () {
    Route::middleware(['verified_email'])->group(function () 
    {
        Route::get('/home', 'HomeController@index')->name('user.userHome');        
        Route::get('check/product','ProductCheckController@view')->name('view');
        Route::post('check/product','ProductCheckController@checkcode')->name('check.code');           
               
    });
    
    //Notofication
        Route::get('/notification','NotificationController@notification')->name('notification.getNotification');
        Route::get('/clearall', 'NotificationController@readAll')->name('notification.readAll');
});

Route::namespace('User')
->middleware('auth')
->middleware('verified_email')
->as('user.')
->group(function(){    
    Route::get('/index', 'UserController@index')->name('Home');
    Route::get('/index/message', 'MessageController@index')->name('message');
    Route::match(['get', 'post'],'/message/form', 'MessageController@view')->name('messageform');
    Route::post('/message/create', 'MessageController@create')->name('createmessage');
    Route::get('/edit-message/{id}', 'MessageController@editMessage')->name('edit_message');
    Route::get('/view-message', 'MessageController@viewChat')->name('view_chat');
    Route::post('/addchat', 'MessageController@addchat')->name('chat.message');
    Route::get('/fetch-data', 'MessageController@fetchData')->name('chat.fetchData');
    Route::post('/messages/mark-as-read', 'MessageController@markAsRead')->name('messages.mark_as_read');
    
});



Route::get('logout-user',function(Request $request){
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return $request->wantsJson()
        ? new JsonResponse([], 204)
        : redirect()->route('login')->with('message','You have been successfully logout!');
})->name('logoutuser');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

include_once 'admin.php';

