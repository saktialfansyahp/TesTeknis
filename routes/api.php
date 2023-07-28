<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PenjualanController;

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

Route::post('createMobil', [MobilController::class, 'create']);
Route::delete('deleteMobil/{id}', [MobilController::class, 'delete']);
Route::get('getMobil', [MobilController::class, 'get']);

Route::post('createMotor', [MotorController::class, 'create']);
Route::delete('deleteMotor/{id}', [MotorController::class, 'delete']);
Route::get('getMotor', [MotorController::class, 'get']);

Route::get('stok', [PenjualanController::class, 'stok']);
Route::post('penjualan', [PenjualanController::class, 'create']);
