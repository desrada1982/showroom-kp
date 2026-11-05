<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table>
    <thead>
        <!-- Baris Judul (Merge 12 Kolom & Rata Tengah) -->
        <tr>
            <th colspan="12" style="text-align: center; font-weight: bold; font-size: 14px;">
                LAPORAN TRANSAKSI PENJUALAN &amp; PEMBIAYAAN MOTOR - KENANGA MOTOR
            </th>
        </tr>
        <tr>
            <th colspan="12"></th>
        </tr>
        <!-- Header Tabel -->
        <tr>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">No</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">Tanggal</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">Nama Pembeli</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">No. HP</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">Motor Dibeli</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">Jml</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">Total Harga</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">Metode Pembayaran</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">Lembaga Leasing</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">Uang Muka (DP)</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">Tenor</th>
            <th style="font-weight: bold; text-align: center; border: 1px solid #000000;">Angsuran/Bln</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transaksis as $index => $trx)
        <tr>
            <td style="text-align: center; border: 1px solid #000000;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #000000;">{{ \Carbon\Carbon::parse($trx->tanggal)->format('d-m-Y') }}</td>
            <td style="border: 1px solid #000000;">{{ $trx->nama_pembeli }}</td>
            <td style="border: 1px solid #000000;">{{ $trx->no_telepon_pembeli ?? '-' }}</td>
            <td style="border: 1px solid #000000;">{{ $trx->motor->nama_motor ?? 'Motor' }}</td>
            <td style="text-align: center; border: 1px solid #000000;">{{ $trx->jumlah_beli }}</td>
            <td style="border: 1px solid #000000;">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
            <td style="border: 1px solid #000000; text-align: center;">{{ $trx->metode_pembayaran }}</td>
            <td style="border: 1px solid #000000;">{{ $trx->nama_leasing ?? '-' }}</td>
            <td style="border: 1px solid #000000;">{{ $trx->uang_dp ? 'Rp ' . number_format($trx->uang_dp, 0, ',', '.') : '-' }}</td>
            <td style="border: 1px solid #000000; text-align: center;">{{ $trx->tenor ? $trx->tenor . ' Bulan' : '-' }}</td>
            <td style="border: 1px solid #000000;">{{ $trx->angsuran_per_bulan ? 'Rp ' . number_format($trx->angsuran_per_bulan, 0, ',', '.') : '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="12" style="text-align: center; border: 1px solid #000000;">Belum ada data transaksi.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>