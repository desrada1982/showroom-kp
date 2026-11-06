<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Motor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Siapkan kerangka pencarian data
        $query = Transaksi::with('motor')->latest();

        // 2. Cek apakah ada request filter tanggal dari URL
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tanggal', [$request->tgl_awal, $request->tgl_akhir]);
        }

        // Filter metode pembayaran (Cash / Kredit)
        if ($request->filled('metode_pembayaran')) {
            $query->where('metode_pembayaran', $request->metode_pembayaran);
        }

        // 3. Eksekusi pencarian dan ambil datanya
        $transaksis = $query->get();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        // Hanya mengambil motor yang stoknya masih ada (lebih dari 0)
        $motors = Motor::where('stok', '>', 0)->get();
        return view('admin.transaksi.create', compact('motors'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'motor_id' => 'required|exists:motors,id',
            'nama_pembeli' => 'required|string|max:100',
            'nik_pembeli' => 'nullable|string|max:20',
            'no_telepon_pembeli' => 'nullable|string|max:20',
            'jumlah_beli' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'metode_pembayaran' => 'required|in:Cash,Kredit',
            // Validasi kondisional khusus kredit
            'nama_leasing' => 'required_if:metode_pembayaran,Kredit|nullable|string',
            'uang_dp' => 'required_if:metode_pembayaran,Kredit|nullable|numeric|min:0',
            'tenor' => 'required_if:metode_pembayaran,Kredit|nullable|integer',
            'angsuran_per_bulan' => 'nullable|numeric|min:0',
            'no_kontrak_leasing' => 'nullable|string|max:50',
            'catatan_transaksi' => 'nullable|string',
        ]);

        // 2. Cari data motor yang dipilih
        $motor = Motor::findOrFail($request->motor_id);

        // 3. Cek apakah stoknya cukup (dan tidak boleh 0 atau minus)
        if ($motor->stok <= 0) {
            return back()->with('error', 'Gagal! Motor ini sudah habis terjual (stok 0).');
        }
        if ($request->jumlah_beli > $motor->stok) {
            return back()->with('error', 'Gagal! Stok motor tidak mencukupi. Stok tersedia: ' . $motor->stok . ' unit.');
        }

        // 4. Hitung total harga otomatis
        $total_harga = $request->jumlah_beli * $motor->harga;

        // 5. Simpan data transaksi
        $data = [
            'motor_id' => $request->motor_id,
            'nama_pembeli' => $request->nama_pembeli,
            'nik_pembeli' => $request->nik_pembeli,
            'no_telepon_pembeli' => $request->no_telepon_pembeli,
            'jumlah_beli' => $request->jumlah_beli,
            'total_harga' => $total_harga,
            'tanggal' => $request->tanggal,
            'metode_pembayaran' => $request->metode_pembayaran,
            'catatan_transaksi' => $request->catatan_transaksi,
        ];

        // Jika metode pembayaran Kredit, isi data pembiayaan leasing
        if ($request->metode_pembayaran === 'Kredit') {
            $data['nama_leasing'] = $request->nama_leasing;
            $data['uang_dp'] = $request->uang_dp;
            $data['tenor'] = $request->tenor;
            $data['angsuran_per_bulan'] = $request->angsuran_per_bulan;
            $data['no_kontrak_leasing'] = $request->no_kontrak_leasing;
        } else {
            $data['nama_leasing'] = null;
            $data['uang_dp'] = null;
            $data['tenor'] = null;
            $data['angsuran_per_bulan'] = null;
            $data['no_kontrak_leasing'] = null;
        }

        Transaksi::create($data);

        // 6. KURANGI STOK MOTOR OTOMATIS (tidak boleh minus, minimum 0)
        $stok_baru = max(0, $motor->stok - $request->jumlah_beli);
        $motor->update(['stok' => $stok_baru]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function cetakPDF(Request $request)
    {
        $query = Transaksi::with('motor')->latest();

        // Cek filter tanggal
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tanggal', [$request->tgl_awal, $request->tgl_akhir]);
        }

        // Filter metode pembayaran
        if ($request->filled('metode_pembayaran')) {
            $query->where('metode_pembayaran', $request->metode_pembayaran);
        }

        $transaksis = $query->get();

        $pdf = Pdf::loadView('admin.transaksi.cetak-pdf', compact('transaksis'));
        return $pdf->stream('Laporan-Transaksi.pdf');
    }

    public function cetakExcel(Request $request)
    {
        $query = Transaksi::with('motor')->latest();

        // Cek filter tanggal
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tanggal', [$request->tgl_awal, $request->tgl_akhir]);
        }

        // Filter metode pembayaran
        if ($request->filled('metode_pembayaran')) {
            $query->where('metode_pembayaran', $request->metode_pembayaran);
        }

        $transaksis = $query->get();

        return Excel::download(new TransaksiExport($transaksis), 'Laporan-Transaksi.xlsx');
    }
}
