<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse ($motors as $motor)
    <div class="col">
        <div class="card h-100 border border-slate-200 shadow-sm rounded-3 overflow-hidden">
            @if($motor->foto)
                <img src="{{ asset('storage/' . $motor->foto) }}" class="card-img-top" alt="{{ $motor->nama_motor }}" style="height: 210px; object-fit: cover; width: 100%;">
            @else
                <div class="card-img-top d-flex flex-column align-items-center justify-content-center bg-light text-secondary" style="height: 210px;">
                    <i class="fas fa-motorcycle fa-3x mb-2 text-muted opacity-50"></i>
                    <span class="small text-muted">Foto belum tersedia</span>
                </div>
            @endif
            
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
                        <span class="badge bg-primary-subtle text-primary fw-semibold">{{ $motor->stok }} Unit Ready</span>
                    </div>
                    <a href="{{ route('katalog.detail', $motor->id) }}" class="btn btn-outline-primary w-100 rounded-3 d-flex align-items-center justify-content-center gap-2">
                        <i class="fas fa-info-circle"></i>
                        <span>Lihat Detail Spesifikasi</span>
                    </a>
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