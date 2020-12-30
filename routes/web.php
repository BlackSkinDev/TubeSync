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

	Route::post('/load','AuthViewController@postLoad')->name('load');
	Route::get('/load/{id}','AuthViewController@getLoad')->name('load');
    Route::get('/dashboard','AuthViewController@getDashboard')->name('dashboard');
    Route::get('/logout','AuthViewController@getLogout')->name('logout');

			
});
