<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/auth', [AuthController::class, 'login']);
    Route::get('/users', [AuthController::class, 'allUsers']);
    Route::post('/sign_out', [AuthController::class, 'sign_out']);
});


Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/auth', [AuthController::class, 'login']);
    Route::get('/users', [AuthController::class, 'allUsers']);
    Route::post('/sign_out', [AuthController::class, 'sign_out']);
    Route::get('/restaurants', [AuthController::class, 'allRestaurants']);
    Route::post('/restaurant', [AuthController::class, 'createRestaurant']);
});
