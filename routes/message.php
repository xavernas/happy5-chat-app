<?php

use Illuminate\Support\Facades\Route;

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
Route::get( '/warning', function () {
    return "Please login first";
})->name('login');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('view', 'App\Http\Controllers\MessageController@view');
    Route::post('send', 'App\Http\Controllers\MessageController@send');
    Route::get('conversation', 'App\Http\Controllers\MessageController@conversation');
    Route::get('conversation/{id}', 'App\Http\Controllers\MessageController@detail_conversation');
    
});