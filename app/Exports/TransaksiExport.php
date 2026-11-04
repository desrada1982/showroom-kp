<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// Kita gunakan FromView agar desain Excel-nya menjiplak desain tabel PDF
class TransaksiExport implements FromView, ShouldAutoSize
{
    protected $transaksis;

    // Menangkap data yang dikirim dari Controller
    public function __construct($transaksis)
    {
        $this->transaksis = $transaksis;
    }

    public function view(): View
    {
        // Mendaur ulang file tampilan cetak-pdf.blade.php
        return view('admin.transaksi.cetak-excel', [
            'transaksis' => $this->transaksis
        ]);
    }
}
