<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;

Route::get('/pages', ['middleware' => 'dashboardLogin', function () {
    return view('adminPanel/dashboard');
}])->name('vPages');


Route::get('/adminLogout', 'adminPanel\LoginController@adminLogout')->name('adminLogout');
