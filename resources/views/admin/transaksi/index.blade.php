@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- KARTU RINGKASAN TRANSAKSI (CASH VS KREDIT) -->
        <div class="row mb-3">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Penjualan</h4>
                        </div>
                        <div class="card-body">
                            {{ $transaksis->count() }} Trx
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-success">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Penjualan Cash</h4>
                        </div>
                        <div class="card-body">
                            {{ $transaksis->where('metode_pembayaran', 'Cash')->count() }} Trx
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-info">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Via Leasing (Kredit)</h4>
                        </div>
                        <div class="card-body">
                            {{ $transaksis->where('metode_pembayaran', 'Kredit')->count() }} Trx
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Nilai Unit</h4>
                        </div>
                        <div class="card-body" style="font-size: 1.1rem;">
                            Rp {{ number_format($transaksis->sum('total_harga'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-history mr-2 text-primary"></i> Riwayat Penjualan & Pembiayaan</h4>
                <div class="card-header-action">
                    <!-- Tombol Cetak PDF membawa data filter -->
                    <a href="{{ route('transaksi.pdf', request()->all()) }}" target="_blank" class="btn btn-danger mr-2">
                        <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
                    </a>
                    
                    <!-- Tombol Cetak Excel membawa data filter -->
                    <a href="{{ route('transaksi.excel', request()->all()) }}" class="btn btn-success mr-2">
                        <i class="fas fa-file-excel mr-1"></i> Cetak Excel
                    </a>
                    
                    <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Tambah Transaksi
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Form Filter Tanggal & Metode Pembayaran -->
                <form action="{{ route('transaksi.index') }}" method="GET" class="mb-4 p-3 bg-light rounded border">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label class="small font-weight-bold">Mulai Tanggal</label>
                            <input type="date" name="tgl_awal" class="form-control" value="{{ request('tgl_awal') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="small font-weight-bold">Sampai Tanggal</label>
                            <input type="date" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="small font-weight-bold">Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-control">
                                <option value="">-- Semua Metode --</option>
                                <option value="Cash" {{ request('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash / Tunai</option>
                                <option value="Kredit" {{ request('metode_pembayaran') == 'Kredit' ? 'selected' : '' }}>Kredit (Leasing)</option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-2 mt-md-0">
                            <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-filter"></i> Filter</button>
                            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</a>
                        </div>
                    </div>
                </form>
                <!-- Akhir Form Filter -->

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-md">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Data Pembeli</th>
                                <th>Motor Dibeli</th>
                                <th>Qty</th>
                                <th>Total Harga</th>
                                <th>Metode Pembayaran</th>
                                <th>Rincian Leasing / DP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksis as $index => $trx)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="font-weight-bold">{{ \Carbon\Carbon::parse($trx->tanggal)->format('d-m-Y') }}</span>
                                </td>
                                <td>
                                    <strong>{{ $trx->nama_pembeli }}</strong>
                                    @if($trx->no_telepon_pembeli)
                                        <div class="small text-muted"><i class="fas fa-phone-alt mr-1"></i>{{ $trx->no_telepon_pembeli }}</div>
                                    @endif
                                    @if($trx->nik_pembeli)
                                        <div class="small text-muted"><i class="fas fa-id-card mr-1"></i>NIK: {{ $trx->nik_pembeli }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="font-weight-bold text-dark">{{ $trx->motor->nama_motor ?? 'Motor Terhapus' }}</span>
                                    <div class="small text-muted">{{ $trx->motor->merek ?? '' }} ({{ $trx->motor->kondisi ?? '' }} {{ $trx->motor->tahun ?? '' }})</div>
                                </td>
                                <td><span class="badge badge-light border">{{ $trx->jumlah_beli }} Unit</span></td>
                                <td>
                                    <strong class="text-primary">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    @if(($trx->metode_pembayaran ?? 'Cash') == 'Kredit')
                                        <span class="badge badge-info px-2 py-1">
                                            <i class="fas fa-hand-holding-usd mr-1"></i>Kredit / Leasing
                                        </span>
                                    @else
                                        <span class="badge badge-success px-2 py-1">
                                            <i class="fas fa-wallet mr-1"></i>Cash / Tunai
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if(($trx->metode_pembayaran ?? 'Cash') == 'Kredit')
                                        <div class="small font-weight-bold text-dark">
                                            <i class="fas fa-building text-primary mr-1"></i>{{ $trx->nama_leasing ?? 'Leasing Rekanan' }}
                                        </div>
                                        <div class="small text-muted">
                                            DP: <strong class="text-success">Rp {{ number_format($trx->uang_dp ?? 0, 0, ',', '.') }}</strong>
                                            @if($trx->tenor) | Tenor: {{ $trx->tenor }} bln @endif
                                        </div>
                                        @if($trx->angsuran_per_bulan)
                                            <div class="small text-muted">Angsuran: Rp {{ number_format($trx->angsuran_per_bulan, 0, ',', '.') }}/bln</div>
                                        @endif
                                        @if($trx->no_kontrak_leasing)
                                            <div class="small text-secondary"><i class="fas fa-file-contract mr-1"></i>No: {{ $trx->no_kontrak_leasing }}</div>
                                        @endif
                                    @else
                                        <span class="text-muted small"><i class="fas fa-check-circle text-success mr-1"></i>Lunas Sekaligus</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada transaksi penjualan sesuai filter yang dipilih.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection