<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('signin', 'UserController@signIn');
Route::post('login', 'UserController@logIn');
Route::post('led/{num}', 'AdafruitController@LED')->where(['num'=>'[0-9]+']);
Route::get('user/profile', 'UserController@showUser')->middleware('auth:sanctum');
Route::delete('logout', 'UserController@logOut')->middleware('auth:sanctum');
Route::get('sensor/temperatura', 'AdafruitController@temperatura');
Route::get('sensor/humedad', 'AdafruitController@humedad');
Route::get('sensor/luz', 'AdafruitController@luz');
Route::get('sensor/distancia', 'AdafruitController@distancia');
Route::get('sensor/presencia', 'AdafruitController@presencia');


