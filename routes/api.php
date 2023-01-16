<?php

use App\Http\Controllers\Api\V1\ExchangeRateController;
use App\Http\Controllers\Api\V1\TestController;
use App\Http\Controllers\Api\V1\UserController;
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


Route::prefix('user')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login'])->name('user.login');
    //Route::get('test', [UserController::class,'test']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/user/logout', [UserController::class, 'logout']);
    Route::post('/user/activities', [UserController::class, 'activities']);

    Route::get('/exchange', [ExchangeRateController::class, 'index']);
    Route::get('/exchange/convert', [ExchangeRateController::class, 'convert']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user('api');
});
