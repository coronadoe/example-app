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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', "Products@index");
Route::post('/store', "Products@store");
Route::get('/show/{$id}', "Products@show");
Route::put('/update/{$id}', "Products@update");
Route::delete('/destroy/{$id}', "Products@destroy");