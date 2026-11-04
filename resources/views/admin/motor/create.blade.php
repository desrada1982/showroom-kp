@extends('layouts.app')

@section('title', 'Tambah Motor')

@section('content')
<div class="row">
    <div class="col-12 col-md-10 col-lg-10">
        <div class="card">
            <div class="card-header">
                <h4>Form Tambah Motor</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('motor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    
                    <div class="row">
                        <!-- BAGIAN KIRI: Info Dasar -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Motor</label>
                                <input type="text" name="nama_motor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Merek</label>
                                <input type="text" name="merek" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control" required>
                            </div>
                        </div>

                        <!-- BAGIAN KANAN: Spesifikasi -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun Pembuatan</label>
                                <input type="number" name="tahun" class="form-control" required placeholder="Contoh: 2024">
                            </div>
                            <div class="form-group">
                                <label>Kapasitas Mesin (CC)</label>
                                <input type="number" name="cc" class="form-control" required placeholder="Contoh: 150">
                            </div>
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" name="warna" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tipe Transmisi</label>
                                <select name="transmisi" class="form-control" required>
                                    <option value="">-- Pilih Transmisi --</option>
                                    <option value="Matic">Matic</option>
                                    <option value="Manual">Manual</option>
                                    <option value="Kopling">Kopling</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kondisi</label>
                                <select name="kondisi" id="selectKondisi" class="form-control" required onchange="toggleFormBekas()">
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="Baru">Baru</option>
                                    <option value="Bekas" selected>Bekas</option>
                                </select>
                            </div>
                        </div>
                    </div> <!-- Akhir Row Dalam -->

                    <!-- SEKSI KHUSUS MOTOR BEKAS (ODOMETER, LEGALITAS BPKB/STNK, PEMILIK) -->
                    <div class="card border border-info mb-4" id="sectionDetailBekas" style="background-color: #f0f7ff;">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                <h6 class="font-weight-bold text-primary mb-0">
                                    <i class="fas fa-file-contract mr-1"></i> Data Riwayat, Legalitas & Kondisi Motor Bekas
                                </h6>
                                <span class="badge badge-info">Penting untuk Calon Pembeli</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Kilometer (Odometer)</label>
                                        <div class="input-group">
                                            <input type="number" name="kilometer" class="form-control" placeholder="Contoh: 15400" value="{{ old('kilometer') }}">
                                            <div class="input-group-append"><span class="input-group-text">KM</span></div>
                                        </div>
                                        <small class="text-muted">Total jarak tempuh motor.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Plat Nomor Kendaraan</label>
                                        <input type="text" name="plat_nomor" class="form-control" placeholder="Contoh: T 4589 WX" value="{{ old('plat_nomor') }}" style="text-transform: uppercase;">
                                        <small class="text-muted">Nomor polisi & wilayah registrasi.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Nama Pemilik Sebelumnya</label>
                                        <input type="text" name="nama_pemilik_sebelumnya" class="form-control" placeholder="Contoh: Bpk. Hendra (Tangan Pertama)" value="{{ old('nama_pemilik_sebelumnya') }}">
                                        <small class="text-muted">Sesuai BPKB / Faktur pertama.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Status BPKB</label>
                                        <select name="status_bpkb" class="form-control">
                                            <option value="Ada">Ada & Lengkap (Faktur Asli)</option>
                                            <option value="Proses Balik Nama">Proses Balik Nama</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Status STNK</label>
                                        <select name="status_stnk" class="form-control">
                                            <option value="Hidup">Hidup (Aktif)</option>
                                            <option value="Mati">Mati (Perlu Perpanjang)</option>
                                            <option value="Proses Perpanjangan">Proses Perpanjangan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Pajak Berlaku Sampai</label>
                                        <input type="text" name="pajak_berlaku_sampai" class="form-control" placeholder="Contoh: November 2026" value="{{ old('pajak_berlaku_sampai') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-md-0">
                                        <label class="small font-weight-bold">Kondisi Rangka / Sasis</label>
                                        <select name="status_rangka" class="form-control">
                                            <option value="Mulus">Mulus (Bebas Tabrak & Banjir)</option>
                                            <option value="Pernah Servis Ringan">Pernah Servis Ringan</option>
                                            <option value="Bekas Tabrak">Bekas Tabrak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-md-0">
                                        <label class="small font-weight-bold">Kondisi Ban Depan</label>
                                        <select name="ban_depan" class="form-control">
                                            <option value="Bagus">Bagus (Tebal 80% - 95%)</option>
                                            <option value="Cukup">Cukup (60% - 79%)</option>
                                            <option value="Perlu Ganti">Perlu Ganti (< 50%)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="small font-weight-bold">Kondisi Ban Belakang</label>
                                        <select name="ban_belakang" class="form-control">
                                            <option value="Bagus">Bagus (Tebal 80% - 95%)</option>
                                            <option value="Cukup">Cukup (60% - 79%)</option>
                                            <option value="Perlu Ganti">Perlu Ganti (< 50%)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEKSI LAYANAN LEASING & PEMBIAYAAN -->
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                <h6 class="font-weight-bold text-dark mb-0">
                                    <i class="fas fa-hand-holding-usd text-success mr-1"></i> Pengaturan Kredit & Leasing
                                </h6>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="switchKredit" name="tersedia_kredit" value="1" checked>
                                    <label class="custom-control-label font-weight-bold text-success" for="switchKredit">Tersedia untuk Kredit / Leasing</label>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label class="small font-weight-bold">Catatan Opsi Leasing / Rekanan Finance (Opsional)</label>
                                <textarea name="info_leasing" class="form-control" rows="2" placeholder="Contoh: Bisa diproses via Adira Finance, FIFGROUP, BAF. Promo DP mulai 15% atau potongan angsuran 2 bulan.">{{ old('info_leasing') }}</textarea>
                                <small class="text-muted">Akan ditampilkan pada halaman rincian motor untuk memudahkan calon debitur.</small>
                            </div>
                        </div>
                    </div>

                    <!-- SEKSI UPLOAD 3 FOTO -->
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-dark mb-3"><i class="fas fa-images mr-1"></i> Foto Unit Motor (Hingga 3 Foto)</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-md-0">
                                        <label class="small font-weight-bold">Foto 1 (Utama / Cover)</label>
                                        <input type="file" name="foto" class="form-control-file">
                                        <small class="form-text text-muted">Tampil di kartu katalog utama.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-md-0">
                                        <label class="small font-weight-bold">Foto 2 (Tampak Samping)</label>
                                        <input type="file" name="foto_2" class="form-control-file">
                                        <small class="form-text text-muted">Tampil di galeri detail motor.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="small font-weight-bold">Foto 3 (Tampak Belakang / Kokpit)</label>
                                        <input type="file" name="foto_3" class="form-control-file">
                                        <small class="form-text text-muted">Tampil di galeri detail motor.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi/Catatan (Opsional)</label>
                        <textarea name="deskripsi" class="form-control" style="height: 100px;"></textarea>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('motor.index') }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleFormBekas() {
        const kondisi = document.getElementById('selectKondisi').value;
        const section = document.getElementById('sectionDetailBekas');
        if (section) {
            if (kondisi === 'Baru') {
                section.style.opacity = '0.5';
            } else {
                section.style.opacity = '1';
            }
        }
    }
</script>
@endpush