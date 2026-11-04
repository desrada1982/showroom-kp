<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom metode pembayaran (Cash/Kredit) dan detail pembiayaan leasing ke tabel transaksis.
     */
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->enum('metode_pembayaran', ['Cash', 'Kredit'])->default('Cash')->after('total_harga');
            $table->string('nik_pembeli', 20)->nullable()->after('nama_pembeli');
            $table->string('no_telepon_pembeli', 20)->nullable()->after('nik_pembeli');
            
            // Kolom khusus pembelian via Kredit / Leasing
            $table->string('nama_leasing', 50)->nullable()->after('metode_pembayaran'); // Adira, FIFGROUP, BAF, dll
            $table->bigInteger('uang_dp')->nullable()->after('nama_leasing');            // Uang muka (DP)
            $table->integer('tenor')->nullable()->after('uang_dp');                       // Jangka waktu cicilan (bulan)
            $table->bigInteger('angsuran_per_bulan')->nullable()->after('tenor');         // Cicilan per bulan
            $table->string('no_kontrak_leasing', 50)->nullable()->after('angsuran_per_bulan'); // No. Kontrak/Aplikasi
            $table->text('catatan_transaksi')->nullable()->after('no_kontrak_leasing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn([
                'metode_pembayaran',
                'nik_pembeli',
                'no_telepon_pembeli',
                'nama_leasing',
                'uang_dp',
                'tenor',
                'angsuran_per_bulan',
                'no_kontrak_leasing',
                'catatan_transaksi',
            ]);
        });
    }
};
