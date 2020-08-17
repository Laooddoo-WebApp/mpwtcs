<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;

Route::get('/pages', 'PageController@showView')->name('vPages');


Route::get('/adminLogout', 'adminPanel\LoginController@adminLogout')->name('adminLogout');

Route::get('/pages/delete/{pageId}','PageController@deletePage')->name('pageDelete');