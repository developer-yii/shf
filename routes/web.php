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
Route::get('/resend/verification/{email}', 'Auth\LoginController@resendVerification')->name('resend.verification');
Route::get('/send/verification/{email}', 'Auth\LoginController@varificationsend')->name('send.verification');

Route::get('check/product','ProductCheckController@view')->name('view');
Route::post('check/product','ProductCheckController@checkcode')->name('check.code');       

//frontend
Route::middleware(['auth'])->group(function () {
    Route::middleware(['verified_email'])->group(function () 
    {
        Route::get('/home', 'HomeController@index')->name('user.userHome');    
        Route::get('/profile', 'HomeController@profile')->name('profile');               
        Route::get('/profile/edit/{id}', 'HomeController@edit')->name('profile.edit');
        Route::post('/profile/update','HomeController@update')->name('profile.update');
               
    });
    
    //Notofication
        Route::get('/notification','NotificationController@notification')->name('notification.getNotification');
        Route::get('/clearall', 'NotificationController@readAll')->name('notification.readAll');

    //order management
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/index','OrderController@index')->name('order');  
        Route::get('/get','OrderController@get')->name('order.list');
        Route::post('/change_status', 'OrderController@change_status')->name('order.change_status');
        Route::get('/detail', 'OrderController@detail')->name('order.detail');
     
    }); 
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

     Route::prefix('user')->group(function () {
            Route::group(['prefix' => 'product'], function () {
                Route::get('/index', 'ProductController@index')->name('product');  
                Route::get('/detail/{id}', 'ProductController@detail')->name('product.detail');

                //Order Module
                Route::get('/cart', 'CartController@cart')->name('cart');
                Route::get('/add-to-cart', 'CartController@addToCart')->name('add.to.cart');
                Route::patch('/update-cart', 'CartController@update')->name('update.cart');
                Route::delete('/remove-from-cart', 'CartController@remove')->name('remove.from.cart');
                Route::get('/checkout', 'CartController@checkout')->name('checkout');
                Route::get('/order/{id}', 'CartController@orderSummary')->name('summary');
            });            
        });
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

