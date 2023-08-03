<?php

use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProvinsiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/kelolaProvinsi', [ProvinsiController::class, 'index']);
Route::post('/kelolaProvinsi', [ProvinsiController::class, 'store']);
Route::delete('/kelolaProvinsi/{provinsi}', [ProvinsiController::class, 'destroy']);
Route::patch('/kelolaProvinsi/{provinsi}', [ProvinsiController::class, 'update']);

Route::get('/kelolaKabupaten', [KabupatenController::class, 'index']);
Route::post('/kelolaKabupaten', [KabupatenController::class, 'store']);
Route::delete('/kelolaKabupaten/{kabupaten}', [KabupatenController::class, 'destroy']);
Route::patch('/kelolaKabupaten/{kabupaten}', [KabupatenController::class, 'update']);

Route::get('/kelolaPenduduk', [PendudukController::class, 'index']);
Route::get('/filterProvinsi/{id}', [PendudukController::class, 'filterProvinsi']);
Route::get('/filterKabupaten/{id}', [PendudukController::class, 'filterKabupaten']);
Route::post('/laporan', [PendudukController::class, 'laporan']);
Route::post('/getKabupaten', [PendudukController::class, 'kabupaten']);
Route::post('/kelolaPenduduk', [PendudukController::class, 'store']);
Route::delete('/kelolaPenduduk/{penduduk}', [PendudukController::class, 'destroy']);
Route::patch('/kelolaPenduduk/{penduduk}', [PendudukController::class, 'update']);