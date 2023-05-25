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
});