<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Admin')
     ->middleware('is_admin')
     ->as('admin.')
     ->prefix('admin')
     ->group(function () {
          Route::get('/home', 'DashboardController@adminHome')->name('adminHome');

          //code
          Route::get('/file/list', 'ImportFileController@list')->name('file.list');
          Route::post('/file/delete', 'ImportFileController@delete')->name('file.delete');

          //code
          Route::get('/code/list', 'CodeController@codelist')->name('code.list');
          Route::post('/code/import', 'CodeController@codeimport')->name('code.import');
          Route::get('/download/samplefile', 'CodeController@downloadsamplefile')->name('download.samplefile');
          Route::get('/account-activate/{id}', 'AdminController@activateAccount')->name('account-activate');

          //message
          Route::get('/message', 'MessageController@index')->name('message');
          Route::post('/change_status', 'MessageController@change_status')->name('message.change_status');
          Route::get('/view-message', 'ChatController@viewchat')->name('view_chat');
          Route::post('/addchat', 'ChatController@addchat')->name('chat.message');
          Route::get('/fetch-data', 'ChatController@fetchData')->name('chat.fetchData');
          Route::post('/messages/mark-as-read', 'ChatController@markAsRead')->name('messages.mark_as_read');

          //product arts
          Route::group(['prefix' => 'product-arts'], function () {
               Route::get('/index', 'ProductArtController@index')->name('productart');
               Route::get('/get', 'ProductArtController@get')->name('productart.list');
               Route::post('/create', 'ProductArtController@create')->name('productart.create');
               Route::post('/detail', 'ProductArtController@detail')->name('productart.detail');
               Route::post('/delete', 'ProductArtController@delete')->name('productart.delete');
          });

          //product Target
          Route::group(['prefix' => 'product-targets'], function () {
               Route::get('/index', 'ProductTargetController@index')->name('producttarget');
               Route::get('/get', 'ProductTargetController@get')->name('producttarget.list');
               Route::post('/create', 'ProductTargetController@create')->name('producttarget.create');
               Route::post('/detail', 'ProductTargetController@detail')->name('producttarget.detail');
               Route::post('/delete', 'ProductTargetController@delete')->name('producttarget.delete');
          });

          //product Uses
          Route::group(['prefix' => 'product-use'], function () {
               Route::get('/index', 'ProductUseController@index')->name('productuse');
               Route::get('/get', 'ProductUseController@get')->name('productuse.list');
               Route::post('/create', 'ProductUseController@create')->name('productuse.create');
               Route::post('/detail', 'ProductUseController@detail')->name('productuse.detail');
               Route::post('/delete', 'ProductUseController@delete')->name('productuse.delete');
          });

          //product Target
          Route::group(['prefix' => 'product-ingredient'], function () {
               Route::get('/index', 'ProductIngredientController@index')->name('productingredient');
               Route::get('/get', 'ProductIngredientController@get')->name('productingredient.list');
               Route::post('/create', 'ProductIngredientController@create')->name('productingredient.create');
               Route::post('/detail', 'ProductIngredientController@detail')->name('productingredient.detail');
               Route::post('/delete', 'ProductIngredientController@delete')->name('productingredient.delete');
          });

          //product management
          Route::group(['prefix' => 'products'], function () {
               Route::get('/index', 'ProductController@index')->name('product');
               Route::get('/get', 'ProductController@get')->name('product.list');
               Route::post('/create', 'ProductController@create')->name('product.create');
               Route::post('/detail', 'ProductController@detail')->name('product.detail');
               Route::post('/delete', 'ProductController@delete')->name('product.delete');
          });

          //user
          Route::group(['prefix' => 'user'], function () {
               Route::get('/index', 'UserController@index')->name('user');
               Route::get('/get', 'UserController@get')->name('user.list');
               Route::get('/view', 'UserController@view')->name('user.view');
               Route::get('/edit', 'UserController@edit')->name('user.edit');
               Route::post('/delete', 'UserController@delete')->name('user.delete');
               Route::post('update', 'UserController@update')->name('user.update');
          });

          //Subscriber
          Route::group(['prefix' => 'subscriber'], function () {
               Route::get('/index', 'SubscriberController@index')->name('subscriber');
               Route::get('/get', 'SubscriberController@get')->name('subscriber.list');
               Route::post('/delete', 'SubscriberController@delete')->name('subscriber.delete');
          });

          //Contact Us
          Route::group(['prefix' => 'contact-us'], function () {
               Route::get('/index', 'ContactUsController@index')->name('contactus');
               Route::get('/get', 'ContactUsController@get')->name('contactus.list');
               Route::post('/delete', 'ContactUsController@delete')->name('contactus.delete');
          });
     });
