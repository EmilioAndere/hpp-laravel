<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\InstalacionController;
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
    Route::get('/{name}/{version?}', [AppController::class, 'show']);
    Route::post('/', [AppController::class, 'store']);
    Route::put('/{name}/{version}', [AppController::class, 'update']);
    Route::delete('/{name}/{version}', [AppController::class, 'destroy']);
});

Route::prefix('equipos')->group(function(){
    Route::get('/', [DeviceController::class, 'index']);
    Route::get('/{attr}/{search}', [DeviceController::class, 'show']);
    Route::post('/', [DeviceController::class, 'store']);
    Route::put('/{id}', [DeviceController::class, 'update']);
    Route::delete('/{estacion}', [DeviceController::class, 'destroy']);
});

Route::prefix('instalaciones')->group(function(){
    Route::get('/', [InstalacionController::class, 'index']);
    Route::get('/app/{nombre}/{version}', [InstalacionController::class, 'perApplication']);
    Route::get('/equipo/{estacion}', [InstalacionController::class, 'perStation']);
    Route::post('/', [InstalacionController::class, 'store']);
    Route::delete('/{estacion}/{app}/{version}', [InstalacionController::class, 'destroy']);
});

Route::get('/sedes', [SedeController::class, 'index']);
