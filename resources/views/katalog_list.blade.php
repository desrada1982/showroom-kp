<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse ($motors as $motor)
    <div class="col">
        <div class="card h-100 border shadow-sm rounded-3 overflow-hidden {{ $motor->stok <= 0 ? 'border-secondary opacity-75' : 'border-slate-200' }}"
             style="{{ $motor->stok <= 0 ? 'filter: grayscale(35%)' : '' }}">

            {{-- Gambar Motor --}}
            <div class="position-relative">
                @if($motor->foto)
                    <img src="{{ asset('storage/' . $motor->foto) }}" class="card-img-top" alt="{{ $motor->nama_motor }}" style="height: 210px; object-fit: cover; width: 100%;">
                @else
                    <div class="card-img-top d-flex flex-column align-items-center justify-content-center bg-light text-secondary" style="height: 210px;">
                        <i class="fas fa-motorcycle fa-3x mb-2 text-muted opacity-50"></i>
                        <span class="small text-muted">Foto belum tersedia</span>
                    </div>
                @endif

                {{-- Badge Sold Out di atas gambar --}}
                @if($motor->stok <= 0)
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                         style="background: rgba(0,0,0,0.45); border-radius: 0;">
                        <span class="badge bg-danger px-3 py-2" style="font-size: 1rem; letter-spacing: 1px;">
                            <i class="fas fa-times-circle me-1"></i> SOLD OUT
                        </span>
                    </div>
                @endif
            </div>

            <div class="card-body d-flex flex-column p-4">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <div>
                        <span class="text-uppercase fw-semibold text-secondary small tracking-wider">{{ $motor->merek }}</span>
                        <h5 class="card-title fw-bold text-dark mb-0">{{ $motor->nama_motor }}</h5>
                    </div>
                    <span class="badge bg-light text-dark border">{{ $motor->tahun }}</span>
                </div>

                <h4 class="text-primary fw-bold my-3">Rp {{ number_format($motor->harga, 0, ',', '.') }}</h4>

                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge bg-light text-secondary border"><i class="fas fa-tachometer-alt me-1"></i>{{ $motor->cc }} CC</span>
                    <span class="badge bg-light text-secondary border"><i class="fas fa-cog me-1"></i>{{ $motor->transmisi }}</span>
                    <span class="badge {{ $motor->kondisi == 'Baru' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-warning-subtle text-warning-emphasis border border-warning-subtle' }}">
                        {{ $motor->kondisi }}
                    </span>
                    @if($motor->kondisi == 'Bekas' && $motor->kilometer)
                        <span class="badge bg-light text-secondary border"><i class="fas fa-road me-1 text-primary"></i>{{ number_format($motor->kilometer, 0, ',', '.') }} KM</span>
                    @endif
                    @if($motor->kondisi == 'Bekas' && $motor->status_bpkb)
                        <span class="badge bg-light text-success border"><i class="fas fa-file-alt me-1"></i>BPKB {{ $motor->status_bpkb }}</span>
                    @endif
                    @if($motor->tersedia_kredit)
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle"><i class="fas fa-hand-holding-usd me-1"></i>Bisa Kredit</span>
                    @endif
                </div>

                <p class="card-text small text-muted flex-grow-1 mb-4">{{ Str::limit($motor->deskripsi, 85) }}</p>

                <div class="mt-auto pt-3 border-top">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="small text-muted">Ketersediaan Unit:</span>
                        @if($motor->stok > 0)
                            <span class="badge bg-primary-subtle text-primary fw-semibold">{{ $motor->stok }} Unit Ready</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger fw-semibold">
                                <i class="fas fa-times-circle me-1"></i> Stok Kosong
                            </span>
                        @endif
                    </div>

                    @if($motor->stok > 0)
                        <a href="{{ route('katalog.detail', $motor->id) }}" class="btn btn-outline-primary w-100 rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            <span>Lihat Detail Spesifikasi</span>
                        </a>
                    @else
                        <button class="btn btn-secondary w-100 rounded-3 d-flex align-items-center justify-content-center gap-2" disabled>
                            <i class="fas fa-times-circle"></i>
                            <span>Unit Tidak Tersedia</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="p-4 bg-light rounded-3 d-inline-block border">
            <i class="fas fa-search fa-2x text-muted mb-2"></i>
            <h5 class="text-dark fw-bold mb-1">Motor Tidak Ditemukan</h5>
            <p class="text-muted small mb-0">Coba ubah kata kunci pencarian Anda untuk menemukan model motor lainnya.</p>
        </div>
    </div>
    @endforelse
</div>

<!-- Paginasi -->
<div class="d-flex justify-content-center mt-5">
    {{ $motors->withQueryString()->links() }}
</div>