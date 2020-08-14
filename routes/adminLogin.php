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


Route::get('/forgetPassword/{emailID}/{adminPID}', ['middleware' => 'sessionCheck', function ($emailID, $adminPID) {
    return view('adminPanel/forgetPassword', compact('adminPID', 'emailID'));
}])->name('vForgetPassword');

// Admin Logic View routes : START
Route::post('/adminLogin', 'adminPanel\LoginController@adminLogin')->name('adminLogin');

Route::any('/forgetPassword', 'adminPanel\LoginController@forgetPassword')->name('forgetPassword');

Route::post('/resetPassword', 'adminPanel\LoginController@resetPassword')->name('resetPassword');
// Admin Logic View routes : END
