<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom detail kendaraan bekas dan informasi leasing ke tabel motors.
     */
    public function up(): void
    {
        Schema::table('motors', function (Blueprint $table) {
            // --- Kolom Data Kendaraan Bekas ---
            $table->integer('kilometer')->nullable()->after('kondisi');            // Odometer (km)
            $table->string('plat_nomor')->nullable()->after('kilometer');          // Plat nomor kendaraan
            $table->string('nama_pemilik_sebelumnya')->nullable()->after('plat_nomor'); // Nama pemilik sebelumnya
            $table->enum('status_bpkb', ['Ada', 'Tidak Ada', 'Proses Balik Nama'])->nullable()->after('nama_pemilik_sebelumnya');
            $table->enum('status_stnk', ['Hidup', 'Mati', 'Proses Perpanjangan'])->nullable()->after('status_bpkb');
            $table->string('pajak_berlaku_sampai')->nullable()->after('status_stnk'); // Contoh: "Oktober 2025"
            $table->enum('status_rangka', ['Mulus', 'Pernah Servis Ringan', 'Bekas Tabrak'])->nullable()->after('pajak_berlaku_sampai');
            $table->enum('ban_depan', ['Bagus', 'Cukup', 'Perlu Ganti'])->nullable()->after('status_rangka');
            $table->enum('ban_belakang', ['Bagus', 'Cukup', 'Perlu Ganti'])->nullable()->after('ban_depan');

            // --- Kolom Info Leasing (boleh dikosongkan jika tidak menawarkan kredit) ---
            $table->boolean('tersedia_kredit')->default(true)->after('ban_belakang'); // Apakah bisa kredit?
            $table->text('info_leasing')->nullable()->after('tersedia_kredit');      // Catatan bebas soal leasing
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motors', function (Blueprint $table) {
            $table->dropColumn([
                'kilometer',
                'plat_nomor',
                'nama_pemilik_sebelumnya',
                'status_bpkb',
                'status_stnk',
                'pajak_berlaku_sampai',
                'status_rangka',
                'ban_depan',
                'ban_belakang',
                'tersedia_kredit',
                'info_leasing',
            ]);
        });
    }
};
