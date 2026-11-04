<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Motor;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Mengambil seluruh data transaksi / laporan penjualan motor untuk Owner
     */
    public function index(Request $request)
    {
        try {
            $query = Transaksi::with('motor')->latest();

            // Filter berdasarkan tanggal awal dan akhir
            if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
                $query->whereBetween('tanggal', [$request->tgl_awal, $request->tgl_akhir]);
            }

            // Filter metode pembayaran (Cash / Kredit)
            if ($request->filled('metode_pembayaran') && $request->metode_pembayaran !== 'Semua') {
                $query->where('metode_pembayaran', $request->metode_pembayaran);
            }

            $transaksis = $query->get();

            // Hitung ringkasan statistik penjualan untuk dashboard owner
            $total_pendapatan = (int) Transaksi::sum('total_harga');
            $total_transaksi = (int) Transaksi::count();
            $total_unit_terjual = (int) Transaksi::sum('jumlah_beli');
            $total_cash = (int) Transaksi::where('metode_pembayaran', 'Cash')->count();
            $total_kredit = (int) Transaksi::where('metode_pembayaran', 'Kredit')->count();

            return response()->json([
                'success' => true,
                'message' => 'Laporan penjualan motor berhasil diambil',
                'ringkasan' => [
                    'total_pendapatan'   => $total_pendapatan,
                    'total_transaksi'    => $total_transaksi,
                    'total_unit_terjual' => $total_unit_terjual,
                    'total_cash'         => $total_cash,
                    'total_kredit'       => $total_kredit,
                ],
                'data' => $transaksis
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil laporan penjualan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mengambil detail spesifik 1 transaksi penjualan
     */
    public function show($id)
    {
        try {
            $transaksi = Transaksi::with('motor')->find($id);

            if (!$transaksi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data transaksi penjualan tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail transaksi penjualan',
                'data'    => $transaksi
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail transaksi: ' . $e->getMessage()
            ], 500);
        }
    }
}

