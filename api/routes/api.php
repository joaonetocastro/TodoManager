<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
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

Route::group(['prefix' => 'todos'], function(){
    Route::get('/', 'TodoController@index');
    Route::post('/', 'TodoController@store');
    Route::put('/{todoId}', 'TodoController@update');
    Route::delete('/{todoId}', 'TodoController@destroy');
});