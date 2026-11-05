<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Kenanga Motor</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #333333; }
        th, td { padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .header { text-align: center; margin-bottom: 10px; }
        .header h2 { margin: 0; font-size: 16px; }
        .header p { margin: 3px 0; font-size: 11px; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <h2>KENANGA MOTOR PURWAKARTA</h2>
        <p>Laporan Transaksi Penjualan &amp; Pembiayaan Motor</p>
        <hr>
    </div>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 18%;">Pembeli</th>
                <th style="width: 18%;">Motor Dibeli</th>
                <th class="text-center" style="width: 6%;">Jml</th>
                <th class="text-right" style="width: 16%;">Total Harga</th>
                <th class="text-center" style="width: 10%;">Metode</th>
                <th style="width: 15%;">Info Leasing / DP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $index => $trx)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d-m-Y') }}</td>
                <td>
                    <strong>{{ $trx->nama_pembeli }}</strong>
                    @if($trx->no_telepon_pembeli)<br><small>{{ $trx->no_telepon_pembeli }}</small>@endif
                </td>
                <td>{{ $trx->motor->nama_motor ?? 'Motor' }}</td>
                <td class="text-center">{{ $trx->jumlah_beli }}</td>
                <td class="text-right">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                <td class="text-center">{{ $trx->metode_pembayaran }}</td>
                <td>
                    @if($trx->metode_pembayaran == 'Kredit')
                        <strong>{{ $trx->nama_leasing }}</strong><br>
                        DP: Rp {{ number_format($trx->uang_dp ?? 0, 0, ',', '.') }} ({{ $trx->tenor }} bln)
                    @else
                        Lunas Tunai
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Total Keseluruhan:</th>
                <th class="text-right">Rp {{ number_format($transaksis->sum('total_harga'), 0, ',', '.') }}</th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>