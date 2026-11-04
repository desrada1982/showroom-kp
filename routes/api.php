<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MotorController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Login untuk Mobile App
Route::post('/login', [AuthController::class, 'loginApi']);

// Endpoint CRUD Data Motor untuk Mobile App
Route::get('/motors', [MotorController::class, 'index']);             // Ambil list semua motor
Route::get('/motors/{id}', [MotorController::class, 'show']);         // Ambil detail motor
Route::post('/motors', [MotorController::class, 'storeApi']);         // Tambah data motor baru
Route::post('/motors/{id}', [MotorController::class, 'updateApi']);   // Update data motor
Route::delete('/motors/{id}', [MotorController::class, 'destroyApi']);// Hapus data motor

// Endpoint Laporan Penjualan Motor untuk Owner di Mobile App
Route::get('/laporan-penjualan', [TransaksiController::class, 'index']);
Route::get('/transaksis', [TransaksiController::class, 'index']);
Route::get('/transaksis/{id}', [TransaksiController::class, 'show']);
