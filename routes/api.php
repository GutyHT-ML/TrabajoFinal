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
Route::post('led/{num}', 'AdafruitController@LED')->middleware('auth:sanctum')->where(['num'=>'[0-9]+']);
Route::post('sensor/temperatura', 'AdafruitController@temperatura')->middleware('auth:sanctum');
Route::post('sensor/humedad', 'AdafruitController@humedad')->middleware('auth:sanctum');
Route::post('sensor/luz', 'AdafruitController@luz')->middleware('auth:sanctum');
Route::post('sensor/distancia', 'AdafruitController@distancia')->middleware('auth:sanctum');
Route::post('sensor/presencia', 'AdafruitController@presencia')->middleware('auth:sanctum');


