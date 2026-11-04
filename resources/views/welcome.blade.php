<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenanga Motor &mdash; Jual Beli Motor Berkualitas & Terpercaya</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        :root {
            --showroom-primary: #1e40af;
            --showroom-primary-hover: #1d4ed8;
            --showroom-dark: #0f172a;
            --showroom-slate: #1e293b;
            --showroom-light: #f8fafc;
            --showroom-card-border: #e2e8f0;
        }

        html { scroll-behavior: smooth; }
        body { 
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--showroom-light); 
            color: #334155;
            padding-top: 72px; 
        }

        /* Hero Section dengan Kontras Tinggi & Nuansa Otomotif */
        .hero-section {
            background: linear-gradient(135deg, #090d16 0%, #0f172a 50%, #1e293b 100%);
            color: #ffffff;
            padding: 90px 0 100px;
            position: relative;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            font-size: 0.875rem;
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        .section-padding { padding: 80px 0; }

        /* Kartu Keunggulan Transisi */
        .feature-box {
            background: #ffffff;
            border: 1px solid var(--showroom-card-border);
            border-radius: 12px;
            padding: 24px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .feature-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05);
        }

        /* Responsive Google Maps Container (No Overflow) */
        .map-container {
            position: relative;
            width: 100%;
            height: 380px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--showroom-card-border);
        }
        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            border: 0;
        }

        /* Form Search Focus */
        .form-control:focus {
            border-color: var(--showroom-primary);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.15);
        }
        
        .btn-showroom-primary {
            background-color: var(--showroom-primary);
            border-color: var(--showroom-primary);
            color: #ffffff;
            min-height: 44px;
        }
        .btn-showroom-primary:hover {
            background-color: var(--showroom-primary-hover);
            border-color: var(--showroom-primary-hover);
            color: #ffffff;
        }

        /* ========================================================
           Scroll Reveal Animation System (R-19 & WCAG Accessibility)
           ======================================================== */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-from-left {
            opacity: 0;
            transform: translateX(-35px);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-from-right {
            opacity: 0;
            transform: translateX(35px);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-fade {
            opacity: 0;
            transition: opacity 0.8s ease-out;
            will-change: opacity;
        }

        /* State saat elemen masuk ke viewport */
        .reveal-on-scroll.is-revealed,
        .reveal-from-left.is-revealed,
        .reveal-from-right.is-revealed {
            opacity: 1;
            transform: translate(0, 0);
        }

        .reveal-fade.is-revealed {
            opacity: 1;
        }

        /* Stagger Delay untuk item berderet */
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }

        /* Animasi halus saat kartu katalog dimuat atau difilter */
        #wadahKatalog .col {
            animation: fadeInCatalog 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes fadeInCatalog {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Aksesibilitas: Hormati preferensi pengguna yang mematikan animasi */
        @media (prefers-reduced-motion: reduce) {
            .reveal-on-scroll,
            .reveal-from-left,
            .reveal-from-right,
            .reveal-fade,
            #wadahKatalog .col {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
                animation: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar Fixed Top -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm py-3" style="background-color: var(--showroom-dark) !important;">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#home">
                <i class="fas fa-motorcycle text-primary"></i>
                <span>Kenanga Motor</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="#home">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#tentang">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#katalog">Katalog Motor</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#leasing">Kredit & Leasing</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#kontak">Kontak & Lokasi</a></li>
                </ul>
                <div class="mt-3 mt-lg-0">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3 rounded-2">
                        <i class="fas fa-lock me-1"></i> Portal Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- SECTION 1: Hero / Banner -->
    <section id="home" class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="hero-badge reveal-on-scroll">
                        <i class="fas fa-shield-alt text-primary"></i>
                        <span>Showroom Motor Terpercaya Purwakarta</span>
                    </div>
                    <h1 class="display-5 fw-bold mb-3 text-white reveal-on-scroll reveal-delay-1">Temukan Motor Impian dengan Kualitas Terverifikasi</h1>
                    <p class="lead mb-4 text-slate-300 reveal-on-scroll reveal-delay-2" style="color: #cbd5e1; max-width: 720px; margin: 0 auto;">
                        Menyediakan motor baru dan bekas siap pakai dengan pemeriksaan kondisi mesin, kelengkapan surat legal, dan transparansi harga untuk kepuasan Anda.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3 reveal-on-scroll reveal-delay-3">
                        <a href="#katalog" class="btn btn-showroom-primary px-4 py-2 rounded-3 fw-semibold d-inline-flex align-items-center gap-2">
                            <i class="fas fa-motorcycle"></i>
                            <span>Telusuri Katalog Unit</span>
                        </a>
                        <a href="#kontak" class="btn btn-outline-light px-4 py-2 rounded-3 fw-semibold d-inline-flex align-items-center gap-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Lokasi Showroom</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HIGHLIGHT STRIP: Keunggulan Layanan -->
    <section class="py-4 bg-white border-bottom">
        <div class="container">
            <div class="row g-3 text-center">
                <div class="col-md-4 reveal-on-scroll reveal-delay-1">
                    <div class="d-flex align-items-center justify-content-center gap-3 py-2">
                        <i class="fas fa-file-invoice text-primary fa-2x"></i>
                        <div class="text-start">
                            <h6 class="fw-bold mb-0 text-dark">Legalitas Terjamin</h6>
                            <small class="text-muted">BPKB & STNK terverifikasi aman</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 border-start-md border-end-md reveal-on-scroll reveal-delay-2">
                    <div class="d-flex align-items-center justify-content-center gap-3 py-2">
                        <i class="fas fa-tools text-primary fa-2x"></i>
                        <div class="text-start">
                            <h6 class="fw-bold mb-0 text-dark">Pengecekan Mesin</h6>
                            <small class="text-muted">Inspeksi fisik dan kelistrikan menyeluruh</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 reveal-on-scroll reveal-delay-3">
                    <div class="d-flex align-items-center justify-content-center gap-3 py-2">
                        <i class="fas fa-hand-holding-usd text-primary fa-2x"></i>
                        <div class="text-start">
                            <h6 class="fw-bold mb-0 text-dark">Harga Transparan</h6>
                            <small class="text-muted">Tanpa biaya terselubung & proses cepat</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: Tentang Kami -->
    <section id="tentang" class="section-padding bg-light">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-md-6 reveal-from-left">
                    <img src="{{ asset('assets/img/showroom-tentang.jpg') }}" alt="Kenanga Motor Purwakarta" class="img-fluid rounded-3 shadow-sm border" loading="lazy">
                </div>
                <div class="col-md-6 reveal-from-right">
                    <span class="text-primary fw-bold text-uppercase small tracking-wide">Profil Perusahaan</span>
                    <h2 class="fw-bold text-dark mb-3 mt-1">Dedikasi Melayani Kebutuhan Kendaraan Roda Dua</h2>
                    <p class="text-muted mb-4">
                        Kenanga Motor berdiri dengan komitmen memberikan solusi jual beli motor yang aman, nyaman, dan terpercaya di wilayah Purwakarta dan sekitarnya. Setiap unit motor yang kami tawarkan telah melewati tahapan kurasi ketat untuk memastikan kualitas mesin, kelayakan jalan, serta keaslian dokumen resmi.
                    </p>
                    
                    <!-- Real Statistics from Database (R-17 & C-5) -->
                    <div class="row g-3">
                        <div class="col-4 reveal-on-scroll reveal-delay-1">
                            <div class="bg-white p-3 rounded-3 border text-center">
                                <h4 class="fw-bold text-primary mb-1">{{ $total_unit_ready ?? 0 }}</h4>
                                <p class="text-muted small mb-0">Unit Ready</p>
                            </div>
                        </div>
                        <div class="col-4 reveal-on-scroll reveal-delay-2">
                            <div class="bg-white p-3 rounded-3 border text-center">
                                <h4 class="fw-bold text-dark mb-1">{{ $total_model ?? 0 }}</h4>
                                <p class="text-muted small mb-0">Pilihan Model</p>
                            </div>
                        </div>
                        <div class="col-4 reveal-on-scroll reveal-delay-3">
                            <div class="bg-white p-3 rounded-3 border text-center">
                                <h4 class="fw-bold text-success mb-1">100%</h4>
                                <p class="text-muted small mb-0">Surat Sah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: Katalog Motor -->
    <section id="katalog" class="section-padding bg-white border-top">
        <div class="container">
            <div class="text-center mb-5 reveal-on-scroll">
                <span class="text-primary fw-bold text-uppercase small tracking-wide">Pilihan Unit</span>
                <h2 class="fw-bold text-dark mb-2 mt-1">Katalog Motor Tersedia</h2>
                <p class="text-muted mb-0">Telusuri unit motor siap pakai dengan spesifikasi detail dan harga terbaik.</p>
            </div>
            
            <!-- Pencarian dengan Debounce & Feedback Visual -->
            <div class="row justify-content-center mb-4 reveal-on-scroll reveal-delay-1">
                <div class="col-md-7 col-lg-6">
                    <div class="input-group border rounded-3 p-1 bg-white shadow-sm">
                        <span class="input-group-text bg-white border-0 text-secondary ps-3">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="inputCari" class="form-control border-0 shadow-none ps-2" placeholder="Cari nama motor atau merek (misal: Vario, Nmax, Honda)..." aria-label="Cari katalog motor">
                        <button class="btn btn-sm btn-light border-0 text-muted d-none me-1" id="btnClear" type="button" title="Bersihkan pencarian">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Indikator Loading State (R-27) -->
            <div id="indikatorLoading" class="text-center py-5 d-none">
                <div class="spinner-border text-primary" role="status" style="width: 2.5rem; height: 2.5rem;">
                    <span class="visually-hidden">Memuat data motor...</span>
                </div>
                <p class="text-muted small mt-2 mb-0">Memperbarui katalog unit motor...</p>
            </div>

            <!-- Wadah Konten Katalog -->
            <div id="wadahKatalog" class="reveal-on-scroll reveal-delay-2">
                @include('katalog_list')
            </div>
        </div>
    </section>

    <!-- SECTION LEASING: Lembaga Pembiayaan, Kredit & Persyaratan -->
    <section id="leasing" class="section-padding bg-light border-top">
        <div class="container">
            <div class="text-center mb-5 reveal-on-scroll">
                <span class="text-primary fw-bold text-uppercase small tracking-wide">Fasilitas Pembiayaan</span>
                <h2 class="fw-bold text-dark mb-2 mt-1">Layanan Kredit & Rekanan Leasing Terpercaya</h2>
                <p class="text-muted mb-0" style="max-width: 700px; margin: 0 auto;">
                    Miliki motor baru maupun bekas impian Anda dengan fasilitas kredit resmi, angsuran fleksibel, proses survei kilat 1 hari kerja, dan suku bunga kompetitif.
                </p>
            </div>

            <!-- Rekanan Lembaga Leasing Resmi -->
            <div class="row g-3 mb-5 justify-content-center reveal-on-scroll reveal-delay-1">
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="bg-white p-3 rounded-3 border text-center h-100 shadow-sm d-flex flex-column justify-content-center">
                        <i class="fas fa-landmark fa-2x text-primary mb-2"></i>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">ADIRA</h6>
                        <small class="text-muted" style="font-size: 0.725rem;">Finance</small>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="bg-white p-3 rounded-3 border text-center h-100 shadow-sm d-flex flex-column justify-content-center">
                        <i class="fas fa-handshake fa-2x text-danger mb-2"></i>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">FIFGROUP</h6>
                        <small class="text-muted" style="font-size: 0.725rem;">Astra Financial</small>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="bg-white p-3 rounded-3 border text-center h-100 shadow-sm d-flex flex-column justify-content-center">
                        <i class="fas fa-motorcycle fa-2x text-warning mb-2"></i>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">BAF</h6>
                        <small class="text-muted" style="font-size: 0.725rem;">Bussan Auto</small>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="bg-white p-3 rounded-3 border text-center h-100 shadow-sm d-flex flex-column justify-content-center">
                        <i class="fas fa-shield-alt fa-2x text-info mb-2"></i>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">OTO</h6>
                        <small class="text-muted" style="font-size: 0.725rem;">Kredit Motor</small>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="bg-white p-3 rounded-3 border text-center h-100 shadow-sm d-flex flex-column justify-content-center">
                        <i class="fas fa-briefcase fa-2x text-success mb-2"></i>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">MUF</h6>
                        <small class="text-muted" style="font-size: 0.725rem;">Mandiri Utama Finance</small>
                    </div>
                </div>
            </div>

            <!-- Alur 3 Langkah & Persyaratan Kredit -->
            <div class="row g-4 align-items-stretch">
                <!-- Kolom Kiri: Alur Proses Pengajuan -->
                <div class="col-lg-5 reveal-from-left">
                    <div class="bg-white p-4 rounded-3 border h-100 shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary p-2 rounded-2 me-2">
                                <i class="fas fa-route fa-lg"></i>
                            </span>
                            <h5 class="fw-bold text-dark mb-0">Alur Mudah Pengajuan Kredit</h5>
                        </div>
                        <p class="text-muted small mb-4">Kenanga Motor bermitra langsung dengan pihak leasing resmi yang terdaftar dan diawasi oleh OJK (Otoritas Jasa Keuangan).</p>

                        <div class="position-relative ps-4 border-start border-2 border-primary border-opacity-25 pb-2">
                            <div class="mb-4 position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-primary" style="left: -25px !important;">1</span>
                                <h6 class="fw-bold text-dark mb-1">Pilih Unit & Konsultasi Angsuran</h6>
                                <p class="text-muted small mb-0">Tentukan motor pilihan dan sesuaikan DP serta tenor cicilan (11, 23, atau 35 bulan) sesuai kemampuan Anda.</p>
                            </div>
                            <div class="mb-4 position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-primary" style="left: -25px !important;">2</span>
                                <h6 class="fw-bold text-dark mb-1">Penyiapan & Verifikasi Dokumen</h6>
                                <p class="text-muted small mb-0">Tim sales kami akan mendampingi pengumpulan berkas KTP, KK, dan bukti penghasilan untuk diserahkan ke pihak leasing.</p>
                            </div>
                            <div class="position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-success" style="left: -25px !important;">3</span>
                                <h6 class="fw-bold text-dark mb-1">Survei Cepat & Pengiriman Unit</h6>
                                <p class="text-muted small mb-0">Proses persetujuan (approval) cepat 1 hari kerja. Setelah disetujui, unit motor diantar langsung ke rumah Anda!</p>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Kenanga%20Motor,%20saya%20ingin%20konsultasi%20mengenai%20simulasi%20dan%20syarat%20kredit%20leasing%20motor." target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm w-100 rounded-2 py-2">
                                <i class="fab fa-whatsapp me-1"></i> Konsultasi Simulasi Kredit Gratis
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Persyaratan Dokumen yang Dibutuhkan -->
                <div class="col-lg-7 reveal-from-right">
                    <div class="bg-white p-4 rounded-3 border h-100 shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success-subtle text-success p-2 rounded-2 me-2">
                                <i class="fas fa-file-invoice-dollar fa-lg"></i>
                            </span>
                            <h5 class="fw-bold text-dark mb-0">Persyaratan Pengajuan Kredit Leasing</h5>
                        </div>
                        <p class="text-muted small mb-4">Pastikan Anda menyiapkan dokumen berikut untuk mempercepat proses survei dan persetujuan leasing:</p>

                        <div class="row g-3">
                            <!-- Kategori Karyawan -->
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border h-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-user-tie text-primary me-2"></i>
                                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">Untuk Karyawan / PNS</h6>
                                    </div>
                                    <ul class="list-unstyled small text-muted mb-0 ps-1" style="font-size: 0.825rem; line-height: 1.7;">
                                        <li><i class="fas fa-check-circle text-success me-2"></i>Fotokopi <strong>KTP Pemohon & Pasangan</strong> (atau Orang Tua bagi pemohon lajang)</li>
                                        <li><i class="fas fa-check-circle text-success me-2"></i>Fotokopi <strong>Kartu Keluarga (KK)</strong> terbaru</li>
                                        <li><i class="fas fa-check-circle text-success me-2"></i><strong>Slip Gaji Asli</strong> (bulan terakhir) atau Surat Keterangan Penghasilan</li>
                                        <li><i class="fas fa-check-circle text-success me-2"></i>Bukti Kepemilikan Rumah (Fotokopi <strong>PBB / Rekening Listrik</strong> / PDAM)</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Kategori Wiraswasta -->
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border h-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-store text-success me-2"></i>
                                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">Untuk Wiraswasta / Usaha</h6>
                                    </div>
                                    <ul class="list-unstyled small text-muted mb-0 ps-1" style="font-size: 0.825rem; line-height: 1.7;">
                                        <li><i class="fas fa-check-circle text-success me-2"></i>Fotokopi <strong>KTP Pemohon & Pasangan</strong></li>
                                        <li><i class="fas fa-check-circle text-success me-2"></i>Fotokopi <strong>Kartu Keluarga (KK)</strong></li>
                                        <li><i class="fas fa-check-circle text-success me-2"></i><strong>Surat Keterangan Usaha (SKU)</strong> Kelurahan atau NIB</li>
                                        <li><i class="fas fa-check-circle text-success me-2"></i>Fotokopi <strong>Buku Tabungan / Mutasi Rekening</strong> 3 bulan terakhir</li>
                                        <li><i class="fas fa-check-circle text-success me-2"></i>Nota / Bon Bukti Transaksi Penjualan Usaha</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Banner Keuntungan Kredit di Showroom -->
                        <div class="mt-4 p-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-3">
                            <div class="row text-center g-2">
                                <div class="col-4 border-end border-primary border-opacity-25">
                                    <i class="fas fa-percentage text-primary mb-1"></i>
                                    <p class="mb-0 fw-bold text-dark small">DP Mulai 15%</p>
                                    <small class="text-muted" style="font-size: 0.7rem;">Uang muka ringan</small>
                                </div>
                                <div class="col-4 border-end border-primary border-opacity-25">
                                    <i class="fas fa-bolt text-warning mb-1"></i>
                                    <p class="mb-0 fw-bold text-dark small">Proses 1 Hari</p>
                                    <small class="text-muted" style="font-size: 0.7rem;">Survei kilat OJK</small>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-file-signature text-success mb-1"></i>
                                    <p class="mb-0 fw-bold text-dark small">BPKB & STNK Sah</p>
                                    <small class="text-muted" style="font-size: 0.7rem;">Jaminan legalitas</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: Kontak & Lokasi -->
    <section id="kontak" class="section-padding bg-light border-top">
        <div class="container">
            <div class="text-center mb-5 reveal-on-scroll">
                <span class="text-primary fw-bold text-uppercase small tracking-wide">Hubungi Kami</span>
                <h2 class="fw-bold text-dark mb-2 mt-1">Lokasi Showroom & Layanan Pelanggan</h2>
                <p class="text-muted mb-0">Kunjungi showroom kami langsung atau hubungi tim sales kami untuk informasi ketersediaan unit.</p>
            </div>

            <div class="row g-4 align-items-stretch">
                <!-- Info Kontak -->
                <div class="col-lg-5 reveal-from-left">
                    <div class="bg-white p-4 rounded-3 border h-100 shadow-sm d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-start mb-4">
                                <div class="bg-primary-subtle text-primary p-3 rounded-3 me-3">
                                    <i class="fas fa-map-marked-alt fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Alamat Showroom</h6>
                                    <p class="text-muted small mb-0">
                                        Jl. Veteran No.140, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-4">
                                <div class="bg-success-subtle text-success p-3 rounded-3 me-3">
                                    <i class="fab fa-whatsapp fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Konsultasi WhatsApp</h6>
                                    <p class="text-muted small mb-2">Respons cepat setiap hari kerja (08.00 - 17.00 WIB)</p>
                                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Kenanga%20Motor,%20saya%20ingin%20bertanya%20mengenai%20unit%20motor%20yang%20tersedia." target="_blank" rel="noopener noreferrer" class="btn btn-outline-success btn-sm px-3 rounded-2">
                                        <i class="fab fa-whatsapp me-1"></i> Chat Sales Kenanga Motor
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <div class="bg-info-subtle text-info-emphasis p-3 rounded-3 me-3">
                                    <i class="fas fa-clock fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Jam Operasional</h6>
                                    <p class="text-muted small mb-0">Senin - Sabtu: 08.00 - 17.00 WIB<br>Minggu / Hari Libur: Dengan Perjanjian</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <small class="text-muted">Siap melayani pembayaran tunai, tukar tambah, dan rekomendasi pembiayaan terpercaya.</small>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div class="col-lg-7 reveal-from-right">
                    <div class="map-container shadow-sm">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7927.88790724431!2d107.44353860174684!3d-6.52876321398498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6905cf5e0e6d6d%3A0xe9099bd5c54ebd6a!2sKenanga%20Motor%20Purwakarta%20(mokas)!5e0!3m2!1sid!2sid!4v1787324576017!5m2!1sid!2sid" 
                            title="Peta Lokasi Kenanga Motor Purwakarta"
                            loading="lazy" 
                            referrerpolicy="strict-origin-when-cross-origin">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white py-4" style="background-color: var(--showroom-dark);">
        <div class="container text-center">
            <p class="mb-1 fw-medium text-slate-300">
                &copy; {{ date('Y') }} Kenanga Motor &mdash; Sistem Informasi Manajemen & Penjualan Motor.
            </p>
            <p class="small text-muted mb-0">Purwakarta, Jawa Barat. Seluruh Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Pencarian Real-Time dengan Debounce & Loading State (R-27) -->
    <script>
        const inputCari = document.getElementById('inputCari');
        const wadahKatalog = document.getElementById('wadahKatalog');
        const indikatorLoading = document.getElementById('indikatorLoading');
        const btnClear = document.getElementById('btnClear');
        
        let debounceTimer = null;
        let abortController = null;

        function jalankanPencarian() {
            const kataKunci = inputCari.value.trim();

            if (btnClear) {
                if (kataKunci.length > 0) {
                    btnClear.classList.remove('d-none');
                } else {
                    btnClear.classList.add('d-none');
                }
            }

            if (abortController) {
                abortController.abort();
            }
            abortController = new AbortController();

            // Tampilkan loading indicator
            indikatorLoading.classList.remove('d-none');
            wadahKatalog.classList.add('opacity-50');

            fetch(`{{ route('home') }}?cari=${encodeURIComponent(kataKunci)}`, {
                signal: abortController.signal,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data katalog');
                }
                return response.text();
            })
            .then(html => {
                wadahKatalog.innerHTML = html;
            })
            .catch(error => {
                if (error.name !== 'AbortError') {
                    wadahKatalog.innerHTML = `
                        <div class="col-12 text-center py-5">
                            <div class="alert alert-warning d-inline-block">
                                <i class="fas fa-exclamation-triangle me-2"></i> Terjadi kendala saat memuat katalog. Silakan coba lagi.
                            </div>
                        </div>`;
                }
            })
            .finally(() => {
                indikatorLoading.classList.add('d-none');
                wadahKatalog.classList.remove('opacity-50');
            });
        }

        inputCari.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(jalankanPencarian, 350);
        });

        if (btnClear) {
            btnClear.addEventListener('click', function() {
                inputCari.value = '';
                jalankanPencarian();
                inputCari.focus();
            });
        }

        // ========================================================
        // Inisialisasi Animasi Scroll Reveal (IntersectionObserver)
        // ========================================================
        document.addEventListener('DOMContentLoaded', function () {
            const revealElements = document.querySelectorAll('.reveal-on-scroll, .reveal-from-left, .reveal-from-right, .reveal-fade');

            if (!('IntersectionObserver' in window)) {
                // Fallback jika browser lawas tidak mendukung IntersectionObserver
                revealElements.forEach(el => el.classList.add('is-revealed'));
                return;
            }

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        // Unobserve agar animasi tidak terulang-ulang terus menerus (nyaman untuk user)
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                root: null,
                threshold: 0.12, // Aktif saat 12% elemen mulai terlihat di layar
                rootMargin: '0px 0px -30px 0px' // Sedikit offset dari batas bawah agar terasa responsif
            });

            revealElements.forEach(el => revealObserver.observe(el));
        });
    </script>
</body>
</html>