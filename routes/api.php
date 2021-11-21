<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SedeController;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('app')->group(function(){
    Route::get('/', [AppController::class, 'index']);
    Route::get('/{name}', [AppController::class, 'show']);
    Route::post('/', [AppController::class, 'store']);
    Route::put('/{id}', [AppController::class, 'update']);
    Route::delete('/{name}', [AppController::class, 'destroy']);
});

Route::prefix('equipos')->group(function(){
    Route::get('/', [DeviceController::class, 'index']);
    Route::get('/{attr}/{search}', [DeviceController::class, 'show']);
    Route::post('/', [DeviceController::class, 'store']);
    Route::put('/{estacion}', [DeviceController::class, 'update']);
    Route::delete('/{estacion}', [DeviceController::class, 'destroy']);
});

Route::get('/sedes', [SedeController::class, 'index']);
