<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Providers\MailProvider;

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

Route::get('/wp-admin', function () {
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

Route::get('/testMail', function () {
    $MailProviderRef = new MailProvider(null);
    return $MailProviderRef->sendEMail('forgetPassword', 'raj', 'ShubhamJobanputra@gmail.com', ['OTP' => 1245]);
});

Route::any('/admin/pages/{id}/build', 'PageBuilderController@build')->name('pagebuilder.build');
Route::any('/admin/pages/build', 'PageBuilderController@build');

Route::any('/{uri}', [
    'uses' => 'WebsiteController@uri',
    'as' => 'page',
])->where('uri', '^((?!wp-admin|wp-admin|clearSession|AllSession|getCookies|testMail|set-language).)*$');
