<?php

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('stok', [PenjualanController::class, 'stok']);
    Route::post('penjualan', [PenjualanController::class, 'create']);
    Route::get('penjualan', [PenjualanController::class, 'get']);
    Route::get('penjualan/{kendaraan}', [PenjualanController::class, 'getBy']);

    Route::post('createMobil', [MobilController::class, 'create']);
    Route::delete('deleteMobil/{id}', [MobilController::class, 'delete']);
    Route::get('getMobil', [MobilController::class, 'get']);

    Route::post('createMotor', [MotorController::class, 'create']);
    Route::delete('deleteMotor/{id}', [MotorController::class, 'delete']);
    Route::get('getMotor', [MotorController::class, 'get']);

    Route::get('getKendaraan/{id}', [KendaraanController::class, 'byId']);
    Route::get('getKendaraan', [KendaraanController::class, 'get']);
});
