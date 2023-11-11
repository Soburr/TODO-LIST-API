<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

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

// Route::group(['prefix' => 'auth'], function () {
//     Route::post('register', 'AuthController@register');
//     Route::post('login', 'AuthController@login');
// });


// Route::middleware('auth:api')->prefix('auth')->group(function() {
//      Route::post('/register', 'API\UserController@register');
//      Route::post('/login', '\API\UserController@login');

// });

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\API', 'middleware' => 'auth:api'], function() {
    Route::post('/register', ['uses' => 'UserController@register']);
    Route::post('/login', ['uses' => 'UserController@login']);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
