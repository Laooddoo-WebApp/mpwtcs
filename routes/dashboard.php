<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', ['middleware' => 'dashboardLogin', function () {
    return view('adminPanel/dashboard');
}])->name('vDashboard');