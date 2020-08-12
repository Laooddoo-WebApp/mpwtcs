<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin', function () {
    return view('adminPanel/admin');
})->name('vAdmin');


// Admin Logic View routes : START
Route::post('/userLogin', 'adminPanel\LoginController@adminLogin')->name('userLogin');

Route::get('/userLogout', 'adminPanel\LoginController@adminLogout')->name('userLogout');

Route::get('/resendOTP', 'adminPanel\LoginController@resendOTP')->name('resendOTP');

Route::post('/resetPassword', 'adminPanel\LoginController@resetPassword')->name('resetPassword');
// Admin Logic View routes : END
