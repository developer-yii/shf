<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Admin')
->middleware('is_admin')
->as('admin.')
->prefix('admin')
->group(function(){
    Route::get('/home','DashboardController@adminHome')->name('adminHome');    
    Route::get('/code/list','CodeController@codelist')->name('code.list');
    Route::post('/code/create','CodeController@codecreate')->name('code.create');
    Route::post('/code/detail','CodeController@codedetail')->name('code.detail');
    Route::post('/code/delete','CodeController@codedelete')->name('code.delete');
    Route::post('/code/import','CodeController@codeimport')->name('code.import');
    Route::get('/download/samplefile','CodeController@downloadsamplefile')->name('download.samplefile');
   Route::get('/account-activate/{id}', 'AdminController@activateAccount')->name('account-activate'); 

   //message
   Route::get('/message','MessageController@index')->name('message');   
   Route::post('/change_status', 'MessageController@change_status')->name('message.change_status');
   Route::get('/view-message', 'ChatController@viewchat')->name('view_chat');
   Route::post('/addchat', 'ChatController@addchat')->name('chat.message');
   Route::get('/fetch-data', 'ChatController@fetchData')->name('chat.fetchData');
   Route::post('/messages/mark-as-read', 'ChatController@markAsRead')->name('messages.mark_as_read');

   //user
   Route::group(['prefix' => 'user'], function () {
        Route::get('/index','UserController@index')->name('user');
        Route::get('/get','UserController@get')->name('user.list');
        Route::get('/view','UserController@view')->name('user.view');
        Route::get('/edit','UserController@edit')->name('user.edit');
        Route::post('/delete','UserController@delete')->name('user.delete');
        Route::post('update', 'UserController@update')->name('user.update');

        // Route::get('/get', 'EmployeeController@get')->name('employee.list');     
        // Route::get('/create', 'EmployeeController@viewemp')->name('employee.viewemp');
        // Route::post('/add', 'EmployeeController@add')->name('employee.add');
        // Route::get('/edit', 'EmployeeController@edit')->name('employee.edit');
        // Route::get('/view', 'EmployeeController@view')->name('employee.view');
        // Route::post('update', 'EmployeeController@update')->name('employee.update');
        // Route::post('/delete', 'EmployeeController@delete')->name('employee.delete');
    });
      
});