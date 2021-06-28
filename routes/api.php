<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\KelasController;

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

Route::middleware(['auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/siswa/register', [SiswaController::class,'store']);
Route::post('/login', [AuthController::class,'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/siswa', [SiswaController::class,'index']);
    Route::get('/siswa/{id}', [SiswaController::class,'show']);
    Route::put('/siswa/{id}', [SiswaController::class,'update']);
    Route::delete('/siswa/{id}', [SiswaController::class,'destroy']);

    Route::post('/absen',[AbsenController::class,'store']);
    Route::get('/absen',[AbsenController::class,'index']);

    Route::post('/kelas',[KelasController::class,'store']);
    Route::get('/kelas', [KelasController::class,'index']);
    Route::get('/kelas/{id}',[KelasController::class,'show']);
    Route::put('/kelas/{id}',[KelasController::class,'update']);
    Route::post('/kelas/join',[SiswaController::class,'joinkelas']);
    Route::post('/logout',[AuthController::class,'logout']);
});
