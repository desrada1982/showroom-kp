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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            // Menyambungkan transaksi dengan motor yang dibeli
            $table->foreignId('motor_id')->constrained('motors')->onDelete('cascade');
            $table->string('nama_pembeli');
            $table->integer('jumlah_beli');
            $table->bigInteger('total_harga'); // Pakai bigInteger karena harga motor bisa puluhan juta
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
