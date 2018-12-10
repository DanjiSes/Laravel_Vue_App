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

Route::group(['middleware' => 'cors'], function () {

  Route::get('/categories', 'CategoriesController@getTree');
  Route::post('/categories/add', 'CategoriesController@add');
  Route::get('/products', 'ProductsController@get');
  Route::post('/products/add', 'ProductsController@add');
    
});

