<?php

use App\Http\Controllers\MotorController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\Motor;
use App\Models\Transaksi;

use Illuminate\Support\Facades\Route;

// Rute Halaman Depan (Katalog Pelanggan)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail-motor/{id}', [HomeController::class, 'show'])->name('katalog.detail');

// Rute untuk Login & Logout
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang WAJIB LOGIN (Dibungkus dengan middleware auth DAN prevent-back-history)
Route::middleware(['auth', 'prevent-back-history'])->group(function () {

    Route::get('/admin', function () {
        // Menghitung statistik dari database
        $total_motor = Motor::count(); // Menghitung ada berapa jenis motor
        $total_stok = Motor::sum('stok'); // Menjumlahkan semua sisa stok
        $total_pendapatan = Transaksi::sum('total_harga'); // Menjumlahkan semua uang masuk

        $pendapatan_per_bulan = array_fill(0, 12, 0);

        // Ambil transaksi di tahun ini saja
        $transaksi_tahun_ini = Transaksi::whereYear('tanggal', date('Y'))->get();

        // Kelompokkan total harga berdasarkan bulan
        foreach ($transaksi_tahun_ini as $trx) {
            // Ambil angka bulan dari tanggal (1 untuk Jan, 12 untuk Des) lalu kurangi 1 untuk index array (0-11)
            $bulan_index = date('n', strtotime($trx->tanggal)) - 1;
            $pendapatan_per_bulan[$bulan_index] += $trx->total_harga;
        }

        $total_transaksi = Transaksi::count();
        $total_cash = Transaksi::where('metode_pembayaran', 'Cash')->count();
        $total_kredit = Transaksi::where('metode_pembayaran', 'Kredit')->count();

        // Mengirim data ke halaman view dashboard
        return view('admin.dashboard', compact(
            'total_motor',
            'total_stok',
            'total_pendapatan',
            'pendapatan_per_bulan',
            'total_transaksi',
            'total_cash',
            'total_kredit'
        ));
    });

    // Rute Tong Sampah Motor (Letakkan DI ATAS resource motor)
    Route::get('/motor/sampah', [App\Http\Controllers\MotorController::class, 'sampah'])->name('motor.sampah');
    Route::post('/motor/restore/{id}', [App\Http\Controllers\MotorController::class, 'restore'])->name('motor.restore');
    Route::delete('/motor/force-delete/{id}', [App\Http\Controllers\MotorController::class, 'forceDelete'])->name('motor.force_delete');

    // Rute Data Motor
    Route::resource('motor', MotorController::class);

    // Rute Cetak Laporan
    Route::get('/transaksi/cetak-pdf', [App\Http\Controllers\TransaksiController::class, 'cetakPDF'])->name('transaksi.pdf');
    Route::get('/transaksi/cetak-excel', [App\Http\Controllers\TransaksiController::class, 'cetakExcel'])->name('transaksi.excel');

    // Rute Data Transaksi
    Route::resource('transaksi', TransaksiController::class);
});
