<?php

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



Route::prefix('mercury')->group(function () {
    Route::apiResource('user', 'UserController')->only(['store']);

    Route::middleware('jwt.auth')->group(function () {
        Route::apiResource('house', 'HouseController');
        Route::apiResource('allocation', 'AllocationController');
    });

    Route::middleware('jwt.auth')->group(function () {
        Route::apiResource('user', 'UserController')->except(['store']);
    });

    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('me', 'AuthController@me');
        Route::post('refresh', 'AuthController@refresh');
    });
});
