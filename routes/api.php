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

//USERS
Route::get('users', 'UserControllerAPI@index');
Route::post('users', 'UserControllerAPI@add');
Route::get('users/emailavailable', 'UserControllerAPI@emailAvailable');
Route::get('users/{id}', 'UserControllerAPI@show');
Route::post('users', 'UserControllerAPI@store');
Route::put('users/{id}', 'UserControllerAPI@update');
Route::delete('users/{id}', 'UserControllerAPI@destroy');
Route::post('users/block/{id}', 'UserControllerAPI@blockUser');

//SHIFTS
Route::post('shiftStart/{id}', 'ShiftControllerAPI@shiftStart');
Route::post('shiftEnd/{id}', 'ShiftControllerAPI@shiftEnd');

//AUTH
Route::post('login', 'LoginControllerAPI@login')->name('login');
Route::middleware('auth:api')->post('logout', 'LoginControllerAPI@logout');

//ITEMS
Route::get('items', 'ItemControllerAPI@getItems');
Route::post('items', 'ItemControllerAPI@add');
Route::put('items', 'ItemControllerAPI@edit');
Route::delete('items/{id}', 'ItemControllerAPI@destroy');

//MEALS
Route::get('meals', 'MealControllerAPI@getMeals');
Route::post('meals', 'MealControllerAPI@add');
Route::get('meals/{id}', 'MealControllerAPI@showMeal');
//----
Route::get('meals/waiter', 'MealControllerAPI@getDailyMealsWaiter');

//ORDERS
Route::get('orders', 'OrderControllerAPI@getOrders');
Route::delete('orders/{id}', 'OrderControllerAPI@delete');
Route::post('orders/{id}', 'OrderControllerAPI@orderState');
Route::post('orders/{id}', 'OrderControllerAPI@confirmOrder');
Route::post('orders', 'OrderControllerAPI@add');

//INVOICES
Route::get('invoices', 'InvoiceControllerAPI@getInvoices');
Route::get('invoices/{id}', 'InvoiceControllerAPI@showInvoice');

//STATS ---> PROF
Route::get('/statistics/orders/{user}', 'OrderControllerAPI@getDailyOrders');
Route::get('/statistics/meals/{user}', 'MealControllerAPI@getDailyMeals');




/*

Caso prefiram usar Resource Routes para o user, podem implementar antes as rotas:
NOTA: neste caso, o parâmetro a receber nos métodos do controlador é user e não id

Route::apiResource('users','UserControllerAPI');
Route::get('users/emailavailable', 'UserControllerAPI@emailAvailable');
*/
