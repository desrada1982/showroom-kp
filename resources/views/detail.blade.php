<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spesifikasi {{ $motor->nama_motor }} &mdash; Kenanga Motor</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        :root {
            --showroom-primary: #1e40af;
            --showroom-primary-hover: #1d4ed8;
            --showroom-dark: #0f172a;
            --showroom-light: #f8fafc;
            --showroom-card-border: #e2e8f0;
        }

        body { 
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--showroom-light); 
            color: #334155;
        }

        .img-detail { 
            width: 100%; 
            height: 420px; 
            object-fit: cover; 
            border-radius: 12px; 
            border: 1px solid var(--showroom-card-border);
        }

        .img-thumbnail-gallery { 
            width: 100%; 
            height: 80px; 
            object-fit: cover; 
            border-radius: 8px; 
            cursor: pointer; 
            transition: 0.2s; 
            opacity: 0.65; 
            border: 2px solid transparent;
        }
        .img-thumbnail-gallery:hover, .img-thumbnail-gallery.active { 
            opacity: 1; 
            border-color: var(--showroom-primary); 
        }

        .table-specs th {
            width: 35%;
            font-weight: 600;
            color: #475569;
            background-color: #f8fafc;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 py-3" style="background-color: var(--showroom-dark) !important;">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
                <i class="fas fa-motorcycle text-primary"></i>
                <span>Kenanga Motor</span>
            </a>
            <div class="ms-auto">
                <a href="{{ route('home') }}#katalog" class="btn btn-outline-light btn-sm px-3 rounded-2">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten Detail -->
    <div class="container mb-5">
        <div class="row bg-white p-4 p-md-5 rounded-3 border shadow-sm g-4">
            
            <!-- Bagian Kiri: Galeri 3 Sudut Foto Motor -->
            <div class="col-lg-6">
                <!-- Foto Utama Tampil Besar -->
                <div class="position-relative mb-3">
                    @if($motor->foto)
                        <img src="{{ asset('storage/' . $motor->foto) }}" id="mainImage" class="img-detail shadow-sm" alt="{{ $motor->nama_motor }}" style="transition: opacity 0.2s ease;">
                    @else
                        <div id="mainImage" class="img-detail d-flex flex-column align-items-center justify-content-center bg-light text-secondary">
                            <i class="fas fa-motorcycle fa-4x mb-2 text-muted opacity-50"></i>
                            <span class="text-muted fw-medium">Foto fisik motor belum diunggah</span>
                        </div>
                    @endif
                    <div class="position-absolute bottom-0 start-0 m-3">
                        <span class="badge bg-dark bg-opacity-75 text-white px-3 py-2 rounded-2 small shadow-sm">
                            <i class="fas fa-camera me-1"></i> Klik thumbnail foto di bawah untuk ganti sudut pandang
                        </span>
                    </div>
                </div>

                <!-- Thumbnail 3 Foto (Sudut Depan, Samping, Belakang/Kokpit) -->
                <div class="row g-2">
                    <!-- Foto 1 (Utama / Tampak Depan) -->
                    <div class="col-4">
                        <div class="position-relative">
                            @if($motor->foto)
                                <img src="{{ asset('storage/' . $motor->foto) }}" class="img-thumbnail-gallery active" onclick="changeImage(this)" alt="Foto Tampak Depan">
                                <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 start-50 translate-middle-x mb-1 px-2 py-0" style="font-size: 0.65rem;">Tampak Depan</span>
                            @else
                                <div class="img-thumbnail-gallery d-flex align-items-center justify-content-center bg-light text-muted border" style="cursor: default;">
                                    <span style="font-size: 0.7rem;">Foto 1 Kosong</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Foto 2 (Tampak Samping) -->
                    <div class="col-4">
                        <div class="position-relative">
                            @if($motor->foto_2)
                                <img src="{{ asset('storage/' . $motor->foto_2) }}" class="img-thumbnail-gallery" onclick="changeImage(this)" alt="Foto Tampak Samping">
                                <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 start-50 translate-middle-x mb-1 px-2 py-0" style="font-size: 0.65rem;">Tampak Samping</span>
                            @else
                                <div class="img-thumbnail-gallery d-flex flex-column align-items-center justify-content-center bg-light text-muted border text-center p-1" style="cursor: default;">
                                    <i class="fas fa-camera text-secondary opacity-50 mb-1" style="font-size: 0.85rem;"></i>
                                    <span style="font-size: 0.65rem;">Foto Samping</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Foto 3 (Tampak Belakang / Kokpit) -->
                    <div class="col-4">
                        <div class="position-relative">
                            @if($motor->foto_3)
                                <img src="{{ asset('storage/' . $motor->foto_3) }}" class="img-thumbnail-gallery" onclick="changeImage(this)" alt="Foto Tampak Belakang">
                                <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 start-50 translate-middle-x mb-1 px-2 py-0" style="font-size: 0.65rem;">Tampak Belakang</span>
                            @else
                                <div class="img-thumbnail-gallery d-flex flex-column align-items-center justify-content-center bg-light text-muted border text-center p-1" style="cursor: default;">
                                    <i class="fas fa-camera text-secondary opacity-50 mb-1" style="font-size: 0.85rem;"></i>
                                    <span style="font-size: 0.65rem;">Foto Belakang</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan: Detail, Spesifikasi & Kalkulator -->
            <div class="col-lg-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('home') }}#katalog" class="text-decoration-none">Katalog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $motor->nama_motor }}</li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center justify-content-between mb-1">
                    <span class="text-uppercase fw-bold text-primary small tracking-wider">{{ $motor->merek }}</span>
                    <span class="badge {{ $motor->kondisi == 'Baru' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-warning-subtle text-warning-emphasis border border-warning-subtle' }} px-3 py-1">
                        Kondisi: {{ $motor->kondisi }}
                    </span>
                </div>

                <h1 class="h2 fw-bold text-dark mb-2">{{ $motor->nama_motor }}</h1>
                <h3 class="text-primary fw-bold mb-4">Rp {{ number_format($motor->harga, 0, ',', '.') }}</h3>

                <!-- Tabel Spesifikasi Umum -->
                <div class="card border rounded-3 mb-4 overflow-hidden shadow-sm">
                    <div class="card-header bg-light py-2 px-3 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0 text-dark small text-uppercase">
                            <i class="fas fa-info-circle text-primary me-1"></i> Spesifikasi Kendaraan
                        </h6>
                        <span class="badge bg-secondary-subtle text-secondary small">Spesifikasi Pabrik</span>
                    </div>
                    <table class="table table-sm table-striped table-specs mb-0">
                        <tbody>
                            <tr>
                                <th>Tahun Pembuatan</th>
                                <td>{{ $motor->tahun }}</td>
                            </tr>
                            <tr>
                                <th>Kapasitas Mesin</th>
                                <td>{{ $motor->cc }} CC</td>
                            </tr>
                            <tr>
                                <th>Tipe Transmisi</th>
                                <td>{{ $motor->transmisi }}</td>
                            </tr>
                            <tr>
                                <th>Warna Kendaraan</th>
                                <td>{{ $motor->warna }}</td>
                            </tr>
                            <tr>
                                <th>Ketersediaan Unit</th>
                                <td>
                                    @if($motor->stok > 0)
                                        <span class="badge bg-primary-subtle text-primary fw-semibold">{{ $motor->stok }} Unit Tersedia</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger fw-semibold">Stok Habis</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- SEKSI KHUSUS MOTOR BEKAS: Transparansi Dokumen, Kilometer, dan Kondisi Fisik -->
                @if($motor->kondisi == 'Bekas' || $motor->kilometer || $motor->plat_nomor || $motor->status_bpkb)
                <div class="card border-primary border-opacity-25 rounded-3 mb-4 overflow-hidden shadow-sm">
                    <div class="card-header bg-primary bg-opacity-10 py-2 px-3 border-bottom border-primary border-opacity-25 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0 text-primary small text-uppercase">
                            <i class="fas fa-clipboard-check me-1"></i> Transparansi Kondisi & Dokumen Motor Bekas
                        </h6>
                        <span class="badge bg-primary text-white small">Wajib Diketahui Pembeli</span>
                    </div>
                    <table class="table table-sm table-specs mb-0">
                        <tbody>
                            <tr>
                                <th><i class="fas fa-road text-primary me-1"></i> Odometer (Kilometer)</th>
                                <td>
                                    <strong class="text-dark">{{ $motor->kilometer ? number_format($motor->kilometer, 0, ',', '.') . ' KM' : 'Jarak Tempuh Rendah' }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-id-card text-primary me-1"></i> Plat Nomor Polisi</th>
                                <td>
                                    <span class="badge bg-dark text-white px-2 py-1 font-monospace">{{ $motor->plat_nomor ?? 'Plat T (Purwakarta)' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-user-check text-primary me-1"></i> Pemilik Sebelumnya</th>
                                <td>{{ $motor->nama_pemilik_sebelumnya ?? 'Tangan Pertama (Atas Nama Pribadi)' }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-file-invoice text-primary me-1"></i> Dokumen BPKB</th>
                                <td>
                                    @if(($motor->status_bpkb ?? 'Ada') == 'Ada')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle"><i class="fas fa-check-circle me-1"></i>Ada & Lengkap (Faktur Asli)</span>
                                    @elseif($motor->status_bpkb == 'Proses Balik Nama')
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle"><i class="fas fa-clock me-1"></i>Dalam Proses Balik Nama</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Tidak Ada</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-file-contract text-primary me-1"></i> Status STNK & Pajak</th>
                                <td>
                                    @if(($motor->status_stnk ?? 'Hidup') == 'Hidup')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle me-1"><i class="fas fa-check-circle me-1"></i>STNK Hidup</span>
                                    @elseif($motor->status_stnk == 'Proses Perpanjangan')
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle me-1"><i class="fas fa-sync-alt me-1"></i>Proses Perpanjang</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle me-1"><i class="fas fa-times-circle me-1"></i>STNK Mati</span>
                                    @endif
                                    @if($motor->pajak_berlaku_sampai)
                                        <span class="small text-muted">(Pajak s/d {{ $motor->pajak_berlaku_sampai }})</span>
                                    @else
                                        <span class="small text-muted">(Pajak aktif)</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-shield-alt text-primary me-1"></i> Kondisi Sasis / Rangka</th>
                                <td>
                                    <span class="text-dark fw-medium">{{ $motor->status_rangka ?? 'Mulus (Bebas Bekas Tabrak & Bebas Banjir)' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-ring text-primary me-1"></i> Ketebalan Ban</th>
                                <td>
                                    <span class="small text-muted">Depan:</span> <strong class="text-dark me-2">{{ $motor->ban_depan ?? 'Bagus (Tebal)' }}</strong>
                                    <span class="small text-muted">Belakang:</span> <strong class="text-dark">{{ $motor->ban_belakang ?? 'Bagus (Tebal)' }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif

                <!-- Deskripsi Kendaraan -->
                <div class="mb-4">
                    <h6 class="fw-bold text-dark mb-2">Deskripsi & Catatan Penjual:</h6>
                    <div class="p-3 bg-light rounded-3 border">
                        <p class="text-muted mb-0 small" style="white-space: pre-line;">{{ $motor->deskripsi ?? 'Tidak ada catatan khusus untuk unit ini. Seluruh dokumen legalitas terjamin sah dan mesin terawat siap pakai.' }}</p>
                    </div>
                </div>

                <!-- SEKSI LEASING & PEMBIAYAAN KREDIT -->
                @if($motor->tersedia_kredit ?? true)
                <div class="card border rounded-3 mb-4 shadow-sm" style="border-left: 4px solid #1e40af !important;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">
                                    <i class="fas fa-hand-holding-usd text-primary me-1"></i> Opsi Kredit & Lembaga Pembiayaan (Leasing)
                                </h6>
                                <small class="text-muted">Proses cepat 1 hari kerja bekerjasama dengan leasing resmi OJK</small>
                            </div>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">
                                <i class="fas fa-check me-1"></i>Kredit Tersedia
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <!-- Mitra Leasing -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark mb-1">Mitra Leasing Resmi Rekanan Showroom:</label>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-light text-dark border px-2 py-1"><i class="fas fa-building text-primary me-1"></i>ADIRA Finance</span>
                                <span class="badge bg-light text-dark border px-2 py-1"><i class="fas fa-building text-danger me-1"></i>FIFGROUP</span>
                                <span class="badge bg-light text-dark border px-2 py-1"><i class="fas fa-building text-warning-emphasis me-1"></i>BAF (Bussan Auto)</span>
                                <span class="badge bg-light text-dark border px-2 py-1"><i class="fas fa-building text-info me-1"></i>OTO Multiartha</span>
                                <span class="badge bg-light text-dark border px-2 py-1"><i class="fas fa-building text-success me-1"></i>Mandiri Utama Finance</span>
                            </div>
                        </div>

                        @if($motor->info_leasing)
                        <div class="alert alert-info py-2 px-3 small mb-3 border-0 rounded-2">
                            <i class="fas fa-bullhorn me-1"></i> <strong>Catatan Leasing Showroom:</strong> {{ $motor->info_leasing }}
                        </div>
                        @endif

                        <!-- Tab Persyaratan vs Kalkulator -->
                        <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active py-1 small fw-semibold" id="tab-simulasi" data-bs-toggle="pill" data-bs-target="#konten-simulasi" type="button" role="tab">
                                    <i class="bi bi-calculator me-1"></i> Kalkulator Simulasi Cicilan
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link py-1 small fw-semibold" id="tab-syarat" data-bs-toggle="pill" data-bs-target="#konten-syarat" type="button" role="tab">
                                    <i class="fas fa-id-card me-1"></i> Persyaratan Dokumen Kredit
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <!-- TAB 1: KALKULATOR SIMULASI KREDIT -->
                            <div class="tab-pane fade show active" id="konten-simulasi" role="tabpanel">
                                <div class="p-3 bg-light rounded-3 border">
                                    <div class="row g-2">
                                        <div class="col-sm-6">
                                            <label for="dpMotor" class="form-label small fw-semibold text-muted mb-1">Uang Muka (DP)</label>
                                            <select class="form-select form-select-sm rounded-2" id="dpMotor" onchange="hitungKredit()">
                                                <option value="15">15% (DP Rendah)</option>
                                                <option value="20" selected>20% (Rekomendasi Leasing)</option>
                                                <option value="30">30% (Cicilan Lebih Ringan)</option>
                                                <option value="40">40%</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="tenorMotor" class="form-label small fw-semibold text-muted mb-1">Jangka Waktu (Tenor)</label>
                                            <select class="form-select form-select-sm rounded-2" id="tenorMotor" onchange="hitungKredit()">
                                                <option value="11">11 Bulan (~1 Tahun)</option>
                                                <option value="23">23 Bulan (~2 Tahun)</option>
                                                <option value="35" selected>35 Bulan (~3 Tahun)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="my-2 border-secondary-subtle">
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <span class="text-muted small d-block">Estimasi DP:</span>
                                            <h6 id="hasilDp" class="fw-bold text-success mb-0">Rp 0</h6>
                                        </div>
                                        <div class="col-6 border-start">
                                            <span class="text-muted small d-block">Estimasi Angsuran:</span>
                                            <h6 id="hasilCicilan" class="fw-bold text-primary mb-0">Rp 0 /bln</h6>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mt-2" style="font-size: 0.725rem;">
                                        * Estimasi perhitungan bunga flat per bulan ~1.5%. Nilai final, approval & promo DP ditentukan oleh pihak leasing yang dipilih saat survei.
                                    </small>
                                </div>
                            </div>

                            <!-- TAB 2: PERSYARATAN KREDIT LEASING -->
                            <div class="tab-pane fade" id="konten-syarat" role="tabpanel">
                                <div class="p-3 bg-light rounded-3 border small">
                                    <h6 class="fw-bold text-dark mb-2" style="font-size: 0.85rem;"><i class="fas fa-check-circle text-success me-1"></i> Persyaratan Pengajuan Kredit Motor:</h6>
                                    
                                    <div class="row g-2">
                                        <div class="col-sm-6">
                                            <div class="bg-white p-2 rounded border">
                                                <strong class="d-block text-primary mb-1">A. Pemohon Karyawan / Pegawai:</strong>
                                                <ul class="mb-0 ps-3 text-muted" style="font-size: 0.75rem;">
                                                    <li>Fotokopi KTP Pemohon & Pasangan (atau Orang Tua)</li>
                                                    <li>Fotokopi Kartu Keluarga (KK)</li>
                                                    <li>Slip Gaji Asli / Surat Keterangan Kerja</li>
                                                    <li>Fotokopi PBB / Rekening Listrik / Bukti Tempat Tinggal</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="bg-white p-2 rounded border">
                                                <strong class="d-block text-primary mb-1">B. Pemohon Wiraswasta / Usaha:</strong>
                                                <ul class="mb-0 ps-3 text-muted" style="font-size: 0.75rem;">
                                                    <li>Fotokopi KTP Pemohon & Pasangan</li>
                                                    <li>Fotokopi Kartu Keluarga (KK)</li>
                                                    <li>Surat Keterangan Usaha (SKU) / NIB / Bon Usaha</li>
                                                    <li>Mutasi Rekening Tabungan 3 Bulan Terakhir</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-muted" style="font-size: 0.725rem;">
                                        <i class="fas fa-info-circle text-primary me-1"></i> Showroom siap membantu pendampingan pengumpulan berkas dan proses survei leasing hingga motor turun.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Tombol Aksi -->
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('home') }}#katalog" class="btn btn-outline-secondary px-3 rounded-2 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Kenanga%20Motor,%20saya%20tertarik%20dengan%20unit%20*{{ urlencode($motor->nama_motor) }}*%20({{ $motor->kondisi }}%20{{ $motor->tahun }})%20seharga%20*Rp%20{{ number_format($motor->harga, 0, ',', '.') }}*.%20Saya%20ingin%20konsultasi%20mengenai%20pembelian%20(Cash%20/%20Kredit%20Leasing).%20Apakah%20unit%20masih%20tersedia?" target="_blank" rel="noopener noreferrer" class="btn btn-success px-4 rounded-2 d-inline-flex align-items-center gap-2 flex-grow-1 justify-content-center">
                        <i class="bi bi-whatsapp"></i>
                        <span>Konsultasi Cash / Kredit Leasing (WhatsApp)</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Script Logika Interaktif -->
    <script>
        // Logika Ganti Gambar Galeri dengan Transisi Halus
        function changeImage(element) {
            const mainImg = document.getElementById('mainImage');
            if (mainImg && mainImg.tagName === 'IMG') {
                mainImg.style.opacity = '0.4';
                setTimeout(() => {
                    mainImg.src = element.src;
                    mainImg.style.opacity = '1';
                }, 130);
            }
            
            let thumbnails = document.getElementsByClassName('img-thumbnail-gallery');
            for(let i = 0; i < thumbnails.length; i++) {
                thumbnails[i].classList.remove('active');
            }
            element.classList.add('active');
        }

        // Logika Kalkulator Kredit
        function hitungKredit() {
            const harga = {{ $motor->harga }};
            const dpPersen = parseFloat(document.getElementById('dpMotor').value);
            const tenor = parseInt(document.getElementById('tenorMotor').value);
            
            const bungaPerBulan = 0.015; // Estimasi bunga rata-rata 1.5%

            const dpNominal = harga * (dpPersen / 100);
            const pokokHutang = harga - dpNominal;
            const totalBunga = pokokHutang * bungaPerBulan * tenor;
            const totalHutang = pokokHutang + totalBunga;
            const angsuranPerBulan = totalHutang / tenor;

            const formatDp = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(dpNominal);
            const formatCicilan = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angsuranPerBulan);

            document.getElementById('hasilDp').innerHTML = formatDp;
            document.getElementById('hasilCicilan').innerHTML = formatCicilan + ' <span class="small fw-normal text-muted">/bln</span>';
        }

        document.addEventListener("DOMContentLoaded", function() {
            hitungKredit();
        });
    </script>
</body>
</html>