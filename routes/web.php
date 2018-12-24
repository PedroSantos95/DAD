<?php

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
Route::get('/','VueController@index');

Route::get('/tictactoe','VueController@tictactoe');

Route::get('/apiItems', 'ItemControllerAPI@getItems');

Route::get('/apiMeals', 'MealControllerAPI@getMeals');

Route::get('/users', 'UserController@index');

Route::get('/apiUsers', 'UserControllerAPI@getUsers');

Route::get('/apiOrders', 'OrderControllerAPI@getOrders');