<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('/todo', TodoController::class);
    // Route::post('/login', ['uses' => 'UserController@login']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');

Route::get('todo', 'App\Http\Controllers\TodoController@index');
Route::post('todo', 'App\Http\Controllers\TodoController@store');
