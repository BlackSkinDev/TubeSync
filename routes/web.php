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

Route::get('/login','AuthViewController@getLogin')->name('signin');

Route::post('/','AuthViewController@getSignup');

Route::post('/login','AuthViewController@getPostLogin');


Route::group(['middleware'=>'auth'],function(){

	Route::post('/parties','AuthViewController@postparties')->name('parties');
	Route::get('/parties/{url}','AuthViewController@getparties')->name('parties');
    Route::get('/dashboard','AuthViewController@getDashboard')->name('dashboard');
    Route::get('/logout','AuthViewController@getLogout')->name('logout');

			
});
