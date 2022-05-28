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

Route::get('/websites/{id?}','\App\Http\Controllers\WebsiteController@index')->where('id','[0-9]+');

Route::post('/subscribe','\App\Http\Controllers\SubscribeController@create');
Route::post('/subscribe/notify','\App\Http\Controllers\SubscribeController@notify');
Route::post('/post/create','\App\Http\Controllers\PostController@create');
