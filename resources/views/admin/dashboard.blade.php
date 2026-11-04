@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Kartu Total Jenis Motor -->
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-motorcycle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Jenis Motor</h4>
                </div>
                <div class="card-body">
                    {{ $total_motor }}
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Total Stok -->
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Sisa Stok Keseluruhan</h4>
                </div>
                <div class="card-body">
                    {{ $total_stok }}
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Total Pendapatan -->
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pendapatan</h4>
                </div>
                <div class="card-body">
                    Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Baris Statistik Metode Pembayaran Cash vs Leasing -->
<div class="row">
    <div class="col-lg-6 col-md-6 col-12">
        <div class="card card-statistic-1 border-left-success">
            <div class="card-icon bg-success text-white">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Penjualan Tunai (Cash)</h4>
                </div>
                <div class="card-body">
                    {{ $total_cash ?? 0 }} <span class="small text-muted font-weight-normal">Transaksi</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <div class="card card-statistic-1 border-left-info">
            <div class="card-icon bg-info text-white">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Penjualan Kredit (Leasing)</h4>
                </div>
                <div class="card-body">
                    {{ $total_kredit ?? 0 }} <span class="small text-muted font-weight-normal">Transaksi Rekanan</span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Selamat Datang di Sistem Informasi Kenanga Motor</h4>
            </div>
            <div class="card-body">
                <p>Halo <b>{{ Auth::user()->name }}</b>! Anda sedang berada di halaman kontrol utama. Gunakan menu di sebelah kiri untuk mengelola data motor dan mencatat transaksi penjualan harian Anda.</p>
            </div>
        </div>
    </div>
</div>

<!-- Area Grafik Penjualan -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Pendapatan Penjualan Motor Tahun {{ date('Y') }}</h4>
            </div>
            <div class="card-body">
                <!-- Elemen Canvas ini adalah tempat Chart.js menggambar grafik -->
                <canvas id="grafikPenjualan" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Load library Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Menangkap data PHP ke dalam variabel JavaScript
    const dataPendapatan = @json($pendapatan_per_bulan);
    
    // Inisialisasi Grafik
    const ctx = document.getElementById('grafikPenjualan').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line', // Jenis grafik: garis (bisa diganti 'bar' untuk batang)
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Total Pendapatan (Rp)',
                data: dataPendapatan,
                backgroundColor: 'rgba(56, 114, 250, 0.2)', // Warna isian bawah garis (biru transparan)
                borderColor: '#6777ef', // Warna garis (biru Stisla)
                borderWidth: 3,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#6777ef',
                pointRadius: 4,
                fill: true,
                tension: 0.4 // Membuat garis menjadi melengkung halus (smooth)
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            // Format angka dengan titik ribuan (Rp)
                            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += 'Rp ' + context.parsed.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection