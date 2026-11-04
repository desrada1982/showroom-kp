<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;
use Illuminate\Support\Facades\Storage;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data motor dari database, diurutkan dari yang terbaru
        $motors = Motor::latest()->get();

        // Mengirim data tersebut ke file tampilan (view) bernama index.blade.php
        return view('admin.motor.index', compact('motors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.motor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_motor' => 'required',
            'merek' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'foto_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'foto_3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            // --- VALIDASI SPESIFIKASI UMUM ---
            'tahun' => 'required|numeric',
            'cc' => 'required|numeric',
            'warna' => 'required|string',
            'transmisi' => 'required|in:Matic,Manual,Kopling',
            'kondisi' => 'required|in:Baru,Bekas',
            'deskripsi' => 'nullable|string',
            // --- VALIDASI KHUSUS MOTOR BEKAS & LEASING ---
            'kilometer' => 'nullable|numeric',
            'plat_nomor' => 'nullable|string|max:20',
            'nama_pemilik_sebelumnya' => 'nullable|string|max:100',
            'status_bpkb' => 'nullable|in:Ada,Tidak Ada,Proses Balik Nama',
            'status_stnk' => 'nullable|in:Hidup,Mati,Proses Perpanjangan',
            'pajak_berlaku_sampai' => 'nullable|string|max:100',
            'status_rangka' => 'nullable|in:Mulus,Pernah Servis Ringan,Bekas Tabrak',
            'ban_depan' => 'nullable|in:Bagus,Cukup,Perlu Ganti',
            'ban_belakang' => 'nullable|in:Bagus,Cukup,Perlu Ganti',
            'tersedia_kredit' => 'nullable|boolean',
            'info_leasing' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['tersedia_kredit'] = $request->has('tersedia_kredit') ? 1 : 0;

        // Simpan file foto (utama, samping, belakang) jika diunggah
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('motor', 'public');
        }
        if ($request->hasFile('foto_2')) {
            $data['foto_2'] = $request->file('foto_2')->store('motor', 'public');
        }
        if ($request->hasFile('foto_3')) {
            $data['foto_3'] = $request->file('foto_3')->store('motor', 'public');
        }

        Motor::create($data);
        return redirect()->route('motor.index')->with('success', 'Data motor berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motor $motor)
    {
        // Menampilkan form edit dan mengirimkan data motor yang dipilih
        return view('admin.motor.edit', compact('motor'));
    }

    public function update(Request $request, Motor $motor)
    {
        $request->validate([
            'nama_motor' => 'required',
            'merek' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'foto_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'foto_3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            // --- VALIDASI SPESIFIKASI UMUM ---
            'tahun' => 'required|numeric',
            'cc' => 'required|numeric',
            'warna' => 'required|string',
            'transmisi' => 'required|in:Matic,Manual,Kopling',
            'kondisi' => 'required|in:Baru,Bekas',
            'deskripsi' => 'nullable|string',
            // --- VALIDASI KHUSUS MOTOR BEKAS & LEASING ---
            'kilometer' => 'nullable|numeric',
            'plat_nomor' => 'nullable|string|max:20',
            'nama_pemilik_sebelumnya' => 'nullable|string|max:100',
            'status_bpkb' => 'nullable|in:Ada,Tidak Ada,Proses Balik Nama',
            'status_stnk' => 'nullable|in:Hidup,Mati,Proses Perpanjangan',
            'pajak_berlaku_sampai' => 'nullable|string|max:100',
            'status_rangka' => 'nullable|in:Mulus,Pernah Servis Ringan,Bekas Tabrak',
            'ban_depan' => 'nullable|in:Bagus,Cukup,Perlu Ganti',
            'ban_belakang' => 'nullable|in:Bagus,Cukup,Perlu Ganti',
            'tersedia_kredit' => 'nullable|boolean',
            'info_leasing' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['tersedia_kredit'] = $request->has('tersedia_kredit') ? 1 : 0;

        // Foto Utama
        if ($request->hasFile('foto')) {
            if ($motor->foto) {
                Storage::disk('public')->delete($motor->foto);
            }
            $data['foto'] = $request->file('foto')->store('motor', 'public');
        }

        // Foto Samping (Foto 2)
        if ($request->hasFile('foto_2')) {
            if ($motor->foto_2) {
                Storage::disk('public')->delete($motor->foto_2);
            }
            $data['foto_2'] = $request->file('foto_2')->store('motor', 'public');
        }

        // Foto Belakang/Detail (Foto 3)
        if ($request->hasFile('foto_3')) {
            if ($motor->foto_3) {
                Storage::disk('public')->delete($motor->foto_3);
            }
            $data['foto_3'] = $request->file('foto_3')->store('motor', 'public');
        }

        $motor->update($data);
        return redirect()->route('motor.index')->with('success', 'Data motor berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $motor = Motor::findOrFail($id);
        $motor->delete();

        return redirect()->route('motor.index')->with('success', 'Data motor berhasil dipindah ke Tong Sampah!');
    }
    // Menampilkan halaman tong sampah
    public function sampah()
    {
        // onlyTrashed() berfungsi memanggil data yang sudah dihapus (masuk tong sampah)
        $motors = Motor::onlyTrashed()->get();
        return view('admin.motor.sampah', compact('motors'));
    }

    // Mengembalikan data ke tabel utama
    public function restore($id)
    {
        $motor = Motor::onlyTrashed()->findOrFail($id);
        $motor->restore(); // Kembalikan data

        return redirect()->back()->with('success', 'Data motor berhasil dipulihkan!');
    }

    // Menghapus data secara permanen beserta fotonya
    public function forceDelete($id)
    {
        $motor = Motor::onlyTrashed()->findOrFail($id);

        // Hapus file foto fisik dari folder storage jika ada
        if ($motor->foto) {
            Storage::disk('public')->delete($motor->foto);
        }
        if ($motor->foto_2) {
            Storage::disk('public')->delete($motor->foto_2);
        }
        if ($motor->foto_3) {
            Storage::disk('public')->delete($motor->foto_3);
        }

        $motor->forceDelete(); // Hancurkan data permanen dari database

        return redirect()->back()->with('success', 'Data motor dihapus permanen!');
    }
}
