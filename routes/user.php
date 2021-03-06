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

Route::post('/login', 'App\Http\Controllers\UserController@login');
Route::get( '/warning', function () {
    return "Please login first";
})->name('login');
Route::middleware('auth:sanctum')->group(function () {
    Route::delete('logout', 'App\Http\Controllers\UserController@logout');
});