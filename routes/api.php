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

Route::prefix('v1')->group(function () {
    Route::get('/users', 'UserController@index')->middleware('admin');
    Route::get('/users/{id}', 'UserController@getUser')->middleware('admin');
    Route::post('/users', 'UserController@create')->middleware('admin');
    Route::put('/users/{id}', 'UserController@update')->middleware('admin');
    Route::delete('/users/{id}', 'UserController@delete')->middleware('admin');

    Route::get('/data', 'DataController@index')->middleware('user');
    Route::get('/data/{id}', 'DataController@getData')->middleware('user');
    Route::post('/data', 'DataController@create')->middleware('user');
    Route::put('/data/{id}', 'DataController@update')->middleware('user');
    Route::delete('/data/{id}', 'DataController@delete')->middleware('user');
});
