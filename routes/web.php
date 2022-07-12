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

Route::prefix('api/vehicles')->group(function () {
    Route::get('/', [\App\Http\Controllers\VehicleController::class, 'getVehicles']);
    Route::get('/{id}/inventory', [\App\Http\Controllers\VehicleController::class, 'getVehicle']);
    Route::post('/{id}/inventory', [\App\Http\Controllers\VehicleController::class, 'store']);
    Route::put('/{id}/inventory', [\App\Http\Controllers\VehicleController::class, 'update']);
    Route::put('/{id}/inventory/increment', [\App\Http\Controllers\VehicleController::class, 'increment']);
    Route::put('/{id}/inventory/decrement', [\App\Http\Controllers\VehicleController::class, 'decrement']);
});

Route::prefix('api/starships')->group(function () {
    Route::get('/', [\App\Http\Controllers\StarshipController::class, 'getStarships']);
    Route::get('/{id}/inventory', [\App\Http\Controllers\StarshipController::class, 'getStarship']);
    Route::post('/{id}/inventory', [\App\Http\Controllers\StarshipController::class, 'store']);
    Route::put('/{id}/inventory', [\App\Http\Controllers\StarshipController::class, 'update']);
    Route::put('/{id}/inventory/increment', [\App\Http\Controllers\StarshipController::class, 'increment']);
    Route::put('/{id}/inventory/decrement', [\App\Http\Controllers\StarshipController::class, 'decrement']);
});