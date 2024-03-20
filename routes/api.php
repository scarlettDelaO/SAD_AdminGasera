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



//Route::get('/vendedores','App\Http\Controllers\VendedorController@index');
//Route::post('/vendedores','App\Http\Controllers\VendedorController@store');
//Route::put('/vendedores/{id}','App\Http\Controllers\VendedorController@update');
//Route::delete('/vendedores/{id}','App\Http\Controllers\VendedorController@destroy');

Route::get('/vendedores','App\Http\Controllers\UserController@index');
Route::post('/vendedores','App\Http\Controllers\UserController@store');
Route::put('/vendedores/{id}','App\Http\Controllers\UserController@update');
Route::delete('/vendedores/{id}','App\Http\Controllers\UserController@destroy');
