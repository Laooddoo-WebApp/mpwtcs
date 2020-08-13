<?php

/*
|--------------------------------------------------------------------------
| Admin Login Routes
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;

Route::get('/login', ['middleware' => 'sessionCheck', function () {
    return view('adminPanel/admin');
}])->name('vAdminLogin');


// Admin Logic View routes : START
Route::post('/adminLogin', 'adminPanel\LoginController@adminLogin')->name('adminLogin');

Route::get('/resendOTP', 'adminPanel\LoginController@resendOTP')->name('resendOTP');

Route::post('/resetPassword', 'adminPanel\LoginController@resetPassword')->name('resetPassword');
// Admin Logic View routes : END
