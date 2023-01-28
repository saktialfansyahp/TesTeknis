<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/getKelas', [KelasController::class, 'index']);
Route::get('/detailKelas', [KelasController::class, 'getDetailClass']);
Route::post('/createKelas', [KelasController::class, 'create']);
Route::post('/updateKelas/{id}', [KelasController::class, 'update']);
Route::get('/getSiswa', [SiswaController::class, 'index']);
Route::get('/detailSiswa', [SiswaController::class, 'getSiswa']);
Route::post('/createSiswa', [SiswaController::class, 'create']);
Route::post('/createMapel', [MapelController::class, 'create']);
Route::post('/createNilai', [NilaiController::class, 'create']);
Route::get('/nilai', [NilaiController::class, 'getNilai']);
Route::get('/getNilai', [NilaiController::class, 'index']);
