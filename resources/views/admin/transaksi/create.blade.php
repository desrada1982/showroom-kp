@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="row">
    <div class="col-12 col-lg-10">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-cart-plus mr-2 text-primary"></i> Form Tambah Transaksi Penjualan Motor</h4>
            </div>
            <div class="card-body">
                <!-- Pesan Notifikasi Error / Sukses Flash Session -->
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible show fade shadow-sm mb-4">
                        <div class="alert-body d-flex align-items-center">
                            <i class="fas fa-exclamation-circle fa-2x mr-3 text-white"></i>
                            <div class="flex-grow-1">
                                <h6 class="font-weight-bold mb-1">Transaksi Ditolak!</h6>
                                <span>{{ session('error') }}</span>
                            </div>
                            <button class="close ml-3" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade shadow-sm mb-4">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        </div>
                    </div>
                @endif

                <!-- Pesan Error Validasi Form -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible show fade shadow-sm mb-4">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            <h6 class="font-weight-bold mb-1"><i class="fas fa-exclamation-triangle mr-1"></i> Perhatian:</h6>
                            <ul class="mb-0 pl-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi" onsubmit="return handleFormSubmit(event)">
                    @csrf 

                    <!-- BAGIAN 1: DATA PEMBELI & MOTOR -->
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                                <i class="fas fa-user mr-1 text-primary"></i> Data Pelanggan / Pembeli
                            </h6>
                            <div class="form-group">
                                <label>Nama Lengkap Pembeli <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pembeli" class="form-control @error('nama_pembeli') is-invalid @enderror" placeholder="Contoh: Bpk. Ridwan Fauzi" value="{{ old('nama_pembeli') }}" required>
                                @error('nama_pembeli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>NIK / No. KTP Pembeli <small class="text-muted">(Penting untuk kontrak leasing)</small></label>
                                <input type="text" name="nik_pembeli" class="form-control" placeholder="16 digit nomor NIK KTP" value="{{ old('nik_pembeli') }}" maxlength="20">
                            </div>
                            <div class="form-group">
                                <label>No. HP / WhatsApp Pembeli</label>
                                <input type="text" name="no_telepon_pembeli" class="form-control" placeholder="Contoh: 081234567890" value="{{ old('no_telepon_pembeli') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                                <i class="fas fa-motorcycle mr-1 text-primary"></i> Pilihan Motor & Tanggal
                            </h6>
                            <div class="form-group">
                                <label>Pilih Unit Motor <span class="text-danger">*</span></label>
                                <select name="motor_id" id="selectMotor" class="form-control @error('motor_id') is-invalid @enderror" required onchange="updateInfoMotor()">
                                    <option value="" data-harga="0" data-stok="0">-- Pilih Motor Tersedia --</option>
                                    @foreach($motors as $motor)
                                        <option value="{{ $motor->id }}" data-harga="{{ $motor->harga }}" data-stok="{{ $motor->stok }}" data-nama="{{ $motor->nama_motor }}" {{ old('motor_id') == $motor->id ? 'selected' : '' }}>
                                            {{ $motor->nama_motor }} - {{ $motor->merek }} ({{ $motor->kondisi }} {{ $motor->tahun }}) | Stok: {{ $motor->stok }} | Rp {{ number_format($motor->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('motor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <label class="mb-0">Jumlah Beli <span class="text-danger">*</span></label>
                                            <span id="badgeInfoStok" class="badge badge-info text-white" style="display: none; font-size: 0.75rem;"></span>
                                        </div>
                                        <input type="number" name="jumlah_beli" id="inputJumlahBeli" class="form-control @error('jumlah_beli') is-invalid @enderror" required min="1" value="{{ old('jumlah_beli', 1) }}" oninput="validasiStokDanHitungTotal()" onchange="validasiStokDanHitungTotal()">
                                        <div id="feedbackStokError" class="invalid-feedback font-weight-bold" style="display: none;"></div>
                                        @error('jumlah_beli')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tanggal Transaksi <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal" class="form-control" required value="{{ old('tanggal', date('Y-m-d')) }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Preview Total Harga -->
                            <div class="alert alert-light border p-2 mb-0 d-flex justify-content-between align-items-center">
                                <span class="small font-weight-bold text-muted">Estimasi Total Harga:</span>
                                <h5 class="mb-0 text-primary font-weight-bold" id="labelTotalHarga">Rp 0</h5>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- BAGIAN 2: METODE PEMBAYARAN (CASH ATAU KREDIT LEASING) -->
                    <div class="mb-4">
                        <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                            <i class="fas fa-money-check-alt mr-1 text-success"></i> Metode Pembayaran
                        </h6>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="custom-control custom-radio custom-control-inline p-3 border rounded w-100 bg-light" style="cursor: pointer;" onclick="document.getElementById('metodeCash').checked = true; toggleMetodePembayaran();">
                                    <input type="radio" id="metodeCash" name="metode_pembayaran" value="Cash" class="custom-control-input" onchange="toggleMetodePembayaran()" {{ old('metode_pembayaran', 'Cash') == 'Cash' ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold text-dark w-100" for="metodeCash" style="cursor: pointer;">
                                        <i class="fas fa-wallet text-success mr-2"></i> Pembelian Cash / Tunai
                                        <small class="d-block text-muted font-weight-normal mt-1">Pembayaran lunas langsung (Cash, Transfer Bank, atau Debit).</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="custom-control custom-radio custom-control-inline p-3 border rounded w-100 bg-light" style="cursor: pointer;" onclick="document.getElementById('metodeKredit').checked = true; toggleMetodePembayaran();">
                                    <input type="radio" id="metodeKredit" name="metode_pembayaran" value="Kredit" class="custom-control-input" onchange="toggleMetodePembayaran()" {{ old('metode_pembayaran') == 'Kredit' ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold text-dark w-100" for="metodeKredit" style="cursor: pointer;">
                                        <i class="fas fa-hand-holding-usd text-primary mr-2"></i> Pembelian Kredit / Leasing
                                        <small class="d-block text-muted font-weight-normal mt-1">Melalui lembaga pembiayaan rekanan (Adira, FIF, BAF, OTO, MUF, dll).</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PANEL FORM KHUSUS KREDIT / LEASING (MUNCUL OTOMATIS JIKA KREDIT DIPILIH) -->
                    <div class="card border border-primary mb-4" id="panelKredit" style="{{ old('metode_pembayaran') == 'Kredit' ? '' : 'display: none;' }} background-color: #f4f8ff;">
                        <div class="card-header bg-primary text-white py-2">
                            <h6 class="mb-0 text-white font-weight-bold">
                                <i class="fas fa-file-signature mr-1"></i> Rincian Pembiayaan Leasing & Uang Muka (DP)
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Pihak / Lembaga Leasing <span class="text-danger">*</span></label>
                                        <select name="nama_leasing" id="nama_leasing" class="form-control">
                                            <option value="">-- Pilih Lembaga Leasing --</option>
                                            <option value="ADIRA Finance" {{ old('nama_leasing') == 'ADIRA Finance' ? 'selected' : '' }}>ADIRA Finance</option>
                                            <option value="FIFGROUP" {{ old('nama_leasing') == 'FIFGROUP' ? 'selected' : '' }}>FIFGROUP (Federal International Finance)</option>
                                            <option value="BAF (Bussan Auto Finance)" {{ old('nama_leasing') == 'BAF (Bussan Auto Finance)' ? 'selected' : '' }}>BAF (Bussan Auto Finance)</option>
                                            <option value="OTO Kredit Motor" {{ old('nama_leasing') == 'OTO Kredit Motor' ? 'selected' : '' }}>OTO Kredit Motor (OTO Multiartha)</option>
                                            <option value="Mandiri Utama Finance (MUF)" {{ old('nama_leasing') == 'Mandiri Utama Finance (MUF)' ? 'selected' : '' }}>Mandiri Utama Finance (MUF)</option>
                                            <option value="BCA Multifinance" {{ old('nama_leasing') == 'BCA Multifinance' ? 'selected' : '' }}>BCA Multifinance</option>
                                            <option value="Lainnya" {{ old('nama_leasing') == 'Lainnya' ? 'selected' : '' }}>Lainnya / Mitra Internal</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nominal Uang Muka (DP) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text font-weight-bold">Rp</span></div>
                                            <input type="number" name="uang_dp" id="uang_dp" class="form-control" placeholder="Contoh: 3500000" value="{{ old('uang_dp') }}" min="0">
                                        </div>
                                        <small class="text-muted">Besaran DP yang disetorkan pembeli.</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Jangka Waktu (Tenor) <span class="text-danger">*</span></label>
                                        <select name="tenor" id="tenor" class="form-control">
                                            <option value="">-- Pilih Tenor Cicilan --</option>
                                            <option value="11" {{ old('tenor') == '11' ? 'selected' : '' }}>11 Bulan (~1 Tahun)</option>
                                            <option value="17" {{ old('tenor') == '17' ? 'selected' : '' }}>17 Bulan (~1.5 Tahun)</option>
                                            <option value="23" {{ old('tenor') == '23' ? 'selected' : '' }}>23 Bulan (~2 Tahun)</option>
                                            <option value="29" {{ old('tenor') == '29' ? 'selected' : '' }}>29 Bulan (~2.5 Tahun)</option>
                                            <option value="35" {{ old('tenor') == '35' ? 'selected' : '' }}>35 Bulan (~3 Tahun)</option>
                                            <option value="47" {{ old('tenor') == '47' ? 'selected' : '' }}>47 Bulan (~4 Tahun)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Angsuran per Bulan (Rp)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text font-weight-bold">Rp</span></div>
                                            <input type="number" name="angsuran_per_bulan" id="angsuran_per_bulan" class="form-control" placeholder="Contoh: 850000" value="{{ old('angsuran_per_bulan') }}" min="0">
                                        </div>
                                        <small class="text-muted">Nominal cicilan yang wajib disetor tiap bulan.</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">No. Kontrak / ID Aplikasi Leasing</label>
                                        <input type="text" name="no_kontrak_leasing" class="form-control" placeholder="Contoh: ADR-2026-08812" value="{{ old('no_kontrak_leasing') }}">
                                        <small class="text-muted">Nomor PO / referensi persetujuan pihak leasing.</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="font-weight-bold">Catatan / Keterangan Transaksi</label>
                                        <textarea name="catatan_transaksi" class="form-control" rows="2" placeholder="Catatan khusus, nama surveyor, atau berkas pendukung...">{{ old('catatan_transaksi') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kotak Notifikasi Alert jika Melebihi Stok -->
                    <div id="alertBatasStok" class="alert alert-danger font-weight-bold mb-3 shadow-sm" style="display: none;">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span id="textBatasStok"></span>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mr-2">
                            <i class="fas fa-arrow-left mr-1"></i> Batal
                        </a>
                        <button type="submit" id="btnSimpanTransaksi" class="btn btn-primary px-4">
                            <i class="fas fa-save mr-1"></i> Simpan Transaksi Penjualan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleMetodePembayaran() {
        const isKredit = document.getElementById('metodeKredit').checked;
        const panelKredit = document.getElementById('panelKredit');
        const namaLeasing = document.getElementById('nama_leasing');
        const uangDp = document.getElementById('uang_dp');
        const tenor = document.getElementById('tenor');

        if (isKredit) {
            panelKredit.style.display = 'block';
            namaLeasing.setAttribute('required', 'required');
            uangDp.setAttribute('required', 'required');
            tenor.setAttribute('required', 'required');
        } else {
            panelKredit.style.display = 'none';
            namaLeasing.removeAttribute('required');
            uangDp.removeAttribute('required');
            tenor.removeAttribute('required');
        }
    }

    function validasiStokDanHitungTotal() {
        const select = document.getElementById('selectMotor');
        if (!select || select.selectedIndex < 0) return;

        const selectedOption = select.options[select.selectedIndex];
        const harga = parseFloat(selectedOption ? selectedOption.getAttribute('data-harga') : 0) || 0;
        const stok = parseInt(selectedOption ? selectedOption.getAttribute('data-stok') : 0) || 0;
        const namaMotor = selectedOption ? (selectedOption.getAttribute('data-nama') || 'unit motor') : 'unit motor';
        
        const jumlahInput = document.getElementById('inputJumlahBeli');
        const jumlah = parseInt(jumlahInput ? jumlahInput.value : 1) || 0;

        const badgeInfo = document.getElementById('badgeInfoStok');
        const feedbackError = document.getElementById('feedbackStokError');
        const alertBatas = document.getElementById('alertBatasStok');
        const textBatas = document.getElementById('textBatasStok');
        const btnSimpan = document.getElementById('btnSimpanTransaksi');

        // Tampilkan info badge stok motor jika motor dipilih
        if (select.value && stok > 0) {
            badgeInfo.style.display = 'inline-block';
            badgeInfo.innerText = 'Sisa Stok: ' + stok + ' Unit';
            jumlahInput.setAttribute('max', stok);
        } else {
            badgeInfo.style.display = 'none';
            jumlahInput.removeAttribute('max');
        }

        // Pengecekan apakah jumlah beli melebihi stok
        if (select.value && stok > 0 && jumlah > stok) {
            jumlahInput.classList.add('is-invalid');
            feedbackError.style.display = 'block';
            feedbackError.innerText = 'Jumlah beli (' + jumlah + ' unit) melebihi stok ' + namaMotor + ' yang tersedia (' + stok + ' unit)!';

            alertBatas.style.display = 'block';
            textBatas.innerText = 'Peringatan: Jumlah pembelian (' + jumlah + ' unit) melebihi stok motor ' + namaMotor + '! Sisa stok yang tersedia saat ini hanya ' + stok + ' unit. Silakan kurangi jumlah beli.';
            if (btnSimpan) {
                btnSimpan.setAttribute('disabled', 'disabled');
            }
        } else {
            jumlahInput.classList.remove('is-invalid');
            feedbackError.style.display = 'none';
            alertBatas.style.display = 'none';
            if (btnSimpan) {
                btnSimpan.removeAttribute('disabled');
            }
        }

        // Hitung total harga
        const total = harga * (jumlah > 0 ? jumlah : 1);
        const formatRupiah = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(total);
        const label = document.getElementById('labelTotalHarga');
        if (label) label.innerText = formatRupiah;
    }

    function updateInfoMotor() {
        validasiStokDanHitungTotal();
    }

    function handleFormSubmit(event) {
        const select = document.getElementById('selectMotor');
        if (!select || select.selectedIndex < 0) return true;

        const selectedOption = select.options[select.selectedIndex];
        const stok = parseInt(selectedOption ? selectedOption.getAttribute('data-stok') : 0) || 0;
        const namaMotor = selectedOption ? (selectedOption.getAttribute('data-nama') || 'unit motor') : 'unit motor';
        const jumlahInput = document.getElementById('inputJumlahBeli');
        const jumlah = parseInt(jumlahInput ? jumlahInput.value : 0) || 0;

        if (select.value && stok > 0 && jumlah > stok) {
            event.preventDefault();
            alert('Transaksi tidak dapat diproses!\nJumlah pembelian (' + jumlah + ' unit) melebihi sisa stok motor ' + namaMotor + ' (' + stok + ' unit).');
            jumlahInput.focus();
            return false;
        }
        return true;
    }

    document.addEventListener("DOMContentLoaded", function() {
        toggleMetodePembayaran();
        validasiStokDanHitungTotal();
    });
</script>
@endpush