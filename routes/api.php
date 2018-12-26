<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'UserControllerAPI@index');
Route::post('users', 'UserControllerAPI@add');
Route::get('users/emailavailable', 'UserControllerAPI@emailAvailable');
Route::get('users/{id}', 'UserControllerAPI@show');
Route::post('users', 'UserControllerAPI@store');
Route::put('users/{id}', 'UserControllerAPI@update');
Route::delete('users/{id}', 'UserControllerAPI@destroy');

Route::post('shiftStart/{id}', 'ShiftControllerAPI@shiftStart');
Route::post('shiftEnd/{id}', 'ShiftControllerAPI@shiftEnd');

Route::post('login', 'LoginControllerAPI@login')->name('login');
Route::middleware('auth:api')->post('logout', 'LoginControllerAPI@logout');

Route::get('items', 'ItemControllerAPI@getItems');
Route::put('items/{id}', 'ItemControllerAPI@edit');
Route::post('items', 'ItemControllerAPI@add');
Route::delete('items/{id}', 'ItemControllerAPI@destroy');

Route::get('meals', 'MealControllerAPI@getMeals');

Route::get('orders', 'OrderControllerAPI@getOrders');

Route::get('invoices', 'InvoiceControllerAPI@getInvoices');
Route::get('invoices/{id}', 'InvoiceControllerAPI@showInvoice');

/*

Caso prefiram usar Resource Routes para o user, podem implementar antes as rotas:
NOTA: neste caso, o parâmetro a receber nos métodos do controlador é user e não id

Route::apiResource('users','UserControllerAPI');
Route::get('users/emailavailable', 'UserControllerAPI@emailAvailable');
*/
