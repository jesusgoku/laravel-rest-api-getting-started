<?php
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

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');

Route::group([ 'middleware' => 'auth:api' ], function() {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('todos', 'TodoController@index');
    Route::post('todos', 'TodoController@store');
    Route::get('todos/{todo}', 'TodoController@show');
    Route::patch('todos/{todo}', 'TodoController@update');
    Route::delete('todos/{todo}', 'TodoController@delete');
});
