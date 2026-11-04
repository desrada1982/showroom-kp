<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_motor'); // Menambahkan kolom nama_motor
            $table->string('merek');      // Menambahkan kolom merek
            $table->integer('harga');     // Menambahkan kolom harga (angka)
            $table->integer('stok');
            $table->string('foto')->nullable();      // Menambahkan kolom stok (angka)
            $table->string('tahun', 4); // Cukup 4 angka (contoh: 2024)
            $table->integer('cc');
            $table->string('warna');
            $table->enum('transmisi', ['Matic', 'Manual', 'Kopling']); // Dropdown pilihan tetap
            $table->enum('kondisi', ['Baru', 'Bekas']); // Dropdown pilihan tetap
            $table->text('deskripsi')->nullable(); // Boleh kosong
            $table->timestamps();
            $table->softDeletes(); // 1. Menambahkan kolom deleted_at untuk SoftDeletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};
