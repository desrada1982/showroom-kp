<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data motor dari database
        $query = Motor::latest();
        if ($request->query('hanya_tersedia') == '1') {
            $query->where('stok', '>', 0);
        }
        $motors = $query->get();

        // Kembalikan data dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Motor Berhasil Diambil',
            'data'    => $motors
        ], 200);
    }
    // 1. GET DETAIL (Menampilkan 1 data spesifik)
    public function show($id)
    {
        $motor = Motor::find($id);

        if (!$motor) {
            return response()->json([
                'success' => false,
                'message' => 'Data Motor Tidak Ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Motor',
            'data'    => $motor
        ], 200);
    }

    // 2. POST (Menambah data baru dari luar)
    public function store(Request $request)
    {
        // Validasi data sederhana
        $request->validate([
            'nama_motor' => 'required',
            'merek' => 'required',
            'harga' => 'required|numeric'
        ]);

        $motor = Motor::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Motor Berhasil Ditambahkan',
            'data'    => $motor
        ], 201);
    }

    // 3. PUT/PATCH (Mengubah data)
    public function update(Request $request, $id)
    {
        $motor = Motor::find($id);

        if (!$motor) {
            return response()->json(['success' => false, 'message' => 'Data Tidak Ditemukan'], 404);
        }

        $motor->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Motor Berhasil Diubah',
            'data'    => $motor
        ], 200);
    }

    // 4. DELETE (Menghapus data)
    public function destroy($id)
    {
        $motor = Motor::find($id);

        if (!$motor) {
            return response()->json(['success' => false, 'message' => 'Data Tidak Ditemukan'], 404);
        }

        $motor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Motor Berhasil Dihapus'
        ], 200);
    }

    public function storeApi(Request $request)
    {
        // 1. Validasi sesuai struktur database lengkap showroom
        $request->validate([
            'nama_motor'              => 'required|string',
            'merek'                   => 'required|string',
            'harga'                   => 'required|numeric',
            'stok'                    => 'required|integer',
            'tahun'                   => 'nullable|integer',
            'cc'                      => 'nullable|integer',
            'warna'                   => 'nullable|string',
            'transmisi'               => 'nullable|string',
            'kondisi'                 => 'nullable|string',
            'deskripsi'               => 'nullable|string',
            'kilometer'               => 'nullable|numeric',
            'plat_nomor'              => 'nullable|string|max:20',
            'nama_pemilik_sebelumnya' => 'nullable|string|max:100',
            'status_bpkb'             => 'nullable|string',
            'status_stnk'             => 'nullable|string',
            'pajak_berlaku_sampai'    => 'nullable|string|max:100',
            'status_rangka'           => 'nullable|string',
            'ban_depan'               => 'nullable|string',
            'ban_belakang'            => 'nullable|string',
            'tersedia_kredit'         => 'nullable',
            'info_leasing'            => 'nullable|string',
            'foto'                    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'foto_2'                  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'foto_3'                  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);

        try {
            // 2. Simpan foto ke folder public/storage/motor jika diunggah
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('motor', 'public');
            }

            $foto2Path = null;
            if ($request->hasFile('foto_2')) {
                $foto2Path = $request->file('foto_2')->store('motor', 'public');
            }

            $foto3Path = null;
            if ($request->hasFile('foto_3')) {
                $foto3Path = $request->file('foto_3')->store('motor', 'public');
            }

            // 3. Masukkan ke tabel motors
            $motor = new \App\Models\Motor();
            $motor->nama_motor              = $request->nama_motor;
            $motor->merek                   = $request->merek;
            $motor->harga                   = $request->harga;
            $motor->stok                    = $request->stok;
            $motor->tahun                   = $request->tahun;
            $motor->cc                      = $request->cc;
            $motor->warna                   = $request->warna;
            $motor->transmisi               = $request->transmisi;
            $motor->kondisi                 = $request->kondisi ?? 'Bekas';
            $motor->deskripsi               = $request->deskripsi;
            $motor->kilometer               = $request->kilometer;
            $motor->plat_nomor              = $request->plat_nomor;
            $motor->nama_pemilik_sebelumnya = $request->nama_pemilik_sebelumnya;
            $motor->status_bpkb             = $request->status_bpkb;
            $motor->status_stnk             = $request->status_stnk;
            $motor->pajak_berlaku_sampai    = $request->pajak_berlaku_sampai;
            $motor->status_rangka           = $request->status_rangka;
            $motor->ban_depan               = $request->ban_depan;
            $motor->ban_belakang            = $request->ban_belakang;
            $motor->tersedia_kredit         = $request->has('tersedia_kredit') ? (bool)$request->tersedia_kredit : true;
            $motor->info_leasing            = $request->info_leasing;
            $motor->foto                    = $fotoPath;
            $motor->foto_2                  = $foto2Path;
            $motor->foto_3                  = $foto3Path;

            $motor->save();

            return response()->json([
                'success' => true,
                'message' => 'Data motor lengkap berhasil ditambahkan!',
                'data'    => $motor
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyApi($id)
    {
        try {
            $motor = \App\Models\Motor::find($id);

            if (!$motor) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data motor tidak ditemukan!'
                ], 404);
            }

            // Hapus file foto dari folder storage jika fotonya ada
            if ($motor->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($motor->foto)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($motor->foto);
            }
            if ($motor->foto_2 && \Illuminate\Support\Facades\Storage::disk('public')->exists($motor->foto_2)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($motor->foto_2);
            }
            if ($motor->foto_3 && \Illuminate\Support\Facades\Storage::disk('public')->exists($motor->foto_3)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($motor->foto_3);
            }

            // Hapus data dari database
            $motor->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data motor berhasil dihapus!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateApi(Request $request, $id)
    {
        // 1. Validasi input (foto boleh kosong saat edit)
        $request->validate([
            'nama_motor'              => 'required|string',
            'merek'                   => 'required|string',
            'harga'                   => 'required|numeric',
            'stok'                    => 'required|integer',
            'tahun'                   => 'nullable|integer',
            'cc'                      => 'nullable|integer',
            'warna'                   => 'nullable|string',
            'transmisi'               => 'nullable|string',
            'kondisi'                 => 'nullable|string',
            'deskripsi'               => 'nullable|string',
            'kilometer'               => 'nullable|numeric',
            'plat_nomor'              => 'nullable|string|max:20',
            'nama_pemilik_sebelumnya' => 'nullable|string|max:100',
            'status_bpkb'             => 'nullable|string',
            'status_stnk'             => 'nullable|string',
            'pajak_berlaku_sampai'    => 'nullable|string|max:100',
            'status_rangka'           => 'nullable|string',
            'ban_depan'               => 'nullable|string',
            'ban_belakang'            => 'nullable|string',
            'tersedia_kredit'         => 'nullable',
            'info_leasing'            => 'nullable|string',
            'foto'                    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'foto_2'                  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'foto_3'                  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);

        try {
            // Cari motor berdasarkan ID
            $motor = \App\Models\Motor::find($id);
            if (!$motor) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data motor tidak ditemukan!'
                ], 404);
            }

            // 2. Cek apakah ada upload foto baru?
            if ($request->hasFile('foto')) {
                if ($motor->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($motor->foto)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($motor->foto);
                }
                $motor->foto = $request->file('foto')->store('motor', 'public');
            }

            if ($request->hasFile('foto_2')) {
                if ($motor->foto_2 && \Illuminate\Support\Facades\Storage::disk('public')->exists($motor->foto_2)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($motor->foto_2);
                }
                $motor->foto_2 = $request->file('foto_2')->store('motor', 'public');
            }

            if ($request->hasFile('foto_3')) {
                if ($motor->foto_3 && \Illuminate\Support\Facades\Storage::disk('public')->exists($motor->foto_3)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($motor->foto_3);
                }
                $motor->foto_3 = $request->file('foto_3')->store('motor', 'public');
            }

            // 3. Update data teks
            $motor->nama_motor = $request->nama_motor;
            $motor->merek      = $request->merek;
            $motor->harga      = $request->harga;
            $motor->stok       = $request->stok;
            $motor->tahun      = $request->tahun;
            $motor->cc         = $request->cc;
            $motor->warna      = $request->warna;
            $motor->transmisi  = $request->transmisi;
            if ($request->has('kondisi')) {
                $motor->kondisi = $request->kondisi;
            }
            if ($request->has('deskripsi')) {
                $motor->deskripsi = $request->deskripsi;
            }
            if ($request->has('kilometer')) {
                $motor->kilometer = $request->kilometer;
            }
            if ($request->has('plat_nomor')) {
                $motor->plat_nomor = $request->plat_nomor;
            }
            if ($request->has('nama_pemilik_sebelumnya')) {
                $motor->nama_pemilik_sebelumnya = $request->nama_pemilik_sebelumnya;
            }
            if ($request->has('status_bpkb')) {
                $motor->status_bpkb = $request->status_bpkb;
            }
            if ($request->has('status_stnk')) {
                $motor->status_stnk = $request->status_stnk;
            }
            if ($request->has('pajak_berlaku_sampai')) {
                $motor->pajak_berlaku_sampai = $request->pajak_berlaku_sampai;
            }
            if ($request->has('status_rangka')) {
                $motor->status_rangka = $request->status_rangka;
            }
            if ($request->has('ban_depan')) {
                $motor->ban_depan = $request->ban_depan;
            }
            if ($request->has('ban_belakang')) {
                $motor->ban_belakang = $request->ban_belakang;
            }
            if ($request->has('tersedia_kredit')) {
                $motor->tersedia_kredit = (bool)$request->tersedia_kredit;
            }
            if ($request->has('info_leasing')) {
                $motor->info_leasing = $request->info_leasing;
            }

            $motor->save();

            return response()->json([
                'success' => true,
                'message' => 'Data motor berhasil diupdate!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }
}
