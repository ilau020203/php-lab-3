<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Api\v1\DrivingEntries\Controllers\DrivingEntryController;
use App\Http\Api\v1\Drivers\Controllers\DriverController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/v1/driving-entries/", [DrivingEntryController::class, 'getList']);
Route::post("/v1/driving-entries/", [DrivingEntryController::class, 'post']);
Route::get("/v1/driving-entries/{id}", [DrivingEntryController::class, 'get']);
Route::put("/v1/driving-entries/{id}", [DrivingEntryController::class, 'put']);
Route::patch("/v1/driving-entries/{id}", [DrivingEntryController::class, 'patch']);
Route::delete("/v1/driving-entries/{id}", [DrivingEntryController::class, 'delete']);

Route::get("/v1/drivers", [DriverController::class, 'getList']);
Route::post("/v1/drivers", [DriverController::class, 'post']);
Route::get("/v1/drivers/{id}", [DriverController::class, 'get']);
Route::put("/v1/drivers/{id}", [DriverController::class, 'put']);
Route::patch("/v1/drivers/{id}", [DriverController::class, 'patch']);
Route::delete("/v1/drivers/{id}", [DriverController::class, 'delete']);