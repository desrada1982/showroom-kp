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
        $table->string('merk');
        $table->string('tipe');
        $table->integer('tahun');
        $table->string('plat_nomor');
        $table->integer('kilometer');
        $table->string('status_surat');
        $table->text('catatan')->nullable(); // Boleh kosong
        $table->bigInteger('harga_beli');
        $table->bigInteger('biaya_rekondisi')->default(0);
        $table->bigInteger('harga_jual');
        $table->string('foto_utama')->nullable(); 
        $table->enum('status', ['Tersedia', 'Terjual'])->default('Tersedia');
        $table->timestamps();
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
