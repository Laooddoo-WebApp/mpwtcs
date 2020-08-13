<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;

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

Route::get('/set-language/{lang}', 'LocalizationController@set')->name('set.language');

Route::get('/admin', function () {
    return redirect()->route('vAdminLogin');
});


Route::get('/clearSession', function () {
    request()->session()->flush();
    return 'done';
});

Route::get('/AllSession', function () {
    return Session::all();
});

Route::get('/getCookies/{tagValue}', function ($tagValue) {
    return request()->cookie($tagValue);
});

Route::get('/test', function () {
    return Lang::get('admin.language');;
});
