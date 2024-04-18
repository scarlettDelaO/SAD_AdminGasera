<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VendedorController;
use App\Http\Controllers\AuthController;

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

Route::get('/vendedores/{id}', 'App\Http\Controllers\UserController@show');
Route::get('/vendedores','App\Http\Controllers\UserController@index');
Route::post('/vendedores','App\Http\Controllers\UserController@store');
Route::put('/vendedores/{id}','App\Http\Controllers\UserController@update');
Route::delete('/vendedores/{id}','App\Http\Controllers\UserController@destroy');
//Route::get('/users', 'App\Http\Controllers\UserController@perfil');

Route::get('/clientes','App\Http\Controllers\CustomerController@index');
Route::post('/clientes','App\Http\Controllers\CustomerController@store');
Route::put('/clientes/{id}','App\Http\Controllers\CustomerController@update');
Route::delete('/clientes/{id}','App\Http\Controllers\CustomerController@destroy');


Route::get('/pedidos/{id}', 'App\Http\Controllers\OrderController@show');
Route::get('/pedidos','App\Http\Controllers\OrderController@index');
Route::post('/pedidos', 'App\Http\Controllers\OrderController@store');
Route::put('/pedidos/{id}', 'App\Http\Controllers\OrderController@update');
Route::delete('/pedidos/{id}', 'App\Http\Controllers\OrderController@destroy');


Route::get('/detalles/{id}','App\Http\Controllers\PriceDetailController@show');
Route::get('/detalles','App\Http\Controllers\PriceDetailController@index');
Route::post('/detalles','App\Http\Controllers\PriceDetailController@store');
Route::put('/detalles/{id}','App\Http\Controllers\PriceDetailController@update');
Route::delete('/detalles/{id}','App\Http\Controllers\PriceDetailController@destroy');

Route::get('/ventas/{id}','App\Http\Controllers\SaleController@show');
Route::get('/ventas','App\Http\Controllers\SaleController@index');
Route::post('/ventas','App\Http\Controllers\SaleController@store');
Route::put('/ventas/{id}','App\Http\Controllers\SaleController@update');
Route::delete('/ventas/{id}','App\Http\Controllers\SaleController@destroy');


Route::get('/precios','App\Http\Controllers\PriceController@index');
Route::post('/precios','App\Http\Controllers\PriceController@store');



Route::get('/data', 'App\Http\Controllers\VendedorController@index');

Route::get('/pipas/{id}', 'App\Http\Controllers\PipeController@show');
Route::get('/pipas','App\Http\Controllers\PipeController@index');
Route::post('/pipas', 'App\Http\Controllers\PipeController@store');
Route::put('/pipas/{id}', 'App\Http\Controllers\PipeController@update');
Route::delete('/pipas/{id}', 'App\Http\Controllers\PipeController@destroy');

Route::get('/data2', 'App\Http\Controllers\VendedorController@index2');

//Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::post('/login', 'App\Http\Controllers\AuthController@login');

//Route::post('/login', [AuthController::class, 'login']);
