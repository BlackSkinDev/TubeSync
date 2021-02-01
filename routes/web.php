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

Route::get('/','AuthViewController@getRegister');

Route::get('/signin','AuthViewController@getLogin')->name('signin');

Route::post('/','AuthViewController@getSignup');

Route::post('/signin','AuthViewController@getPostLogin');


// social login routes
Route::get('/auth/redirect','AuthViewController@redirect')->name('auth/callback');

Route::get('/callback/google','AuthViewController@callback')->name('google.callback');




Route::group(['middleware'=>'auth'],function(){

	Route::post('/parties','AuthViewController@postparties')->name('parties');
	Route::get('/join/{url}','AuthViewController@getparties')->name('parties');
    Route::get('/dashboard','AuthViewController@getDashboard')->name('dashboard');
    Route::get('/logout','AuthViewController@getLogout')->name('logout');
    Route::get('/messages/{session}','AuthViewController@getMessages')->name('getMessages');

    Route::post('/send/{session}','AuthViewController@sendMessage')->name('sendMessage');

   
   
			
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
