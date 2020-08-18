<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;

Route::get('/pages', 'adminPanel\PageController@showView')->name('vPages');


Route::get('/adminLogout', 'adminPanel\LoginController@adminLogout')->name('adminLogout');

Route::get('/pages/delete/{pageId}','adminPanel\PageController@deletePage')->name('pageDelete');

Route::post('/pages/add','adminPanel\PageController@addPage')->name('pageAdd');
