@extends('layouts.app')

@section('title', 'Data Motor')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Motor Kenanga Motor</h4>
                <div class="card-header-action">
                    <!-- Tombol Tambah Data -->
                    <div class="card-header-action">
    <a href="{{ route('motor.sampah') }}" class="btn btn-secondary mr-2"><i class="fas fa-trash"></i> Lihat Tong Sampah</a>
    <a href="{{ route('motor.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Motor</a>
</div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Info Motor</th>
                                <th>Spesifikasi</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($motors as $index => $motor)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                
                                <!-- Kolom Foto -->
                                <td>
                                    @if($motor->foto)
                                        <img src="{{ asset('storage/' . $motor->foto) }}" alt="Foto" width="80" class="img-fluid rounded shadow-sm">
                                    @else
                                        <span class="text-danger">No Image</span>
                                    @endif
                                </td>
                                
                                <!-- Kolom Info Motor (Digabung) -->
                                <td>
                                    <strong>{{ $motor->nama_motor }}</strong><br>
                                    <span class="text-muted">{{ $motor->merek }} ({{ $motor->tahun }})</span>
                                </td>

                                <!-- Kolom Spesifikasi (Digabung dengan Badge) -->
                                <td>
                                    <span class="badge badge-info">{{ $motor->transmisi }}</span>
                                    <span class="badge {{ $motor->kondisi == 'Baru' ? 'badge-success' : 'badge-warning' }}">{{ $motor->kondisi }}</span><br>
                                    <small class="text-muted">{{ $motor->cc }} CC | Warna: {{ $motor->warna }}</small>
                                </td>
                                
                                <td>Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                                <td>{{ $motor->stok }}</td>
                                <td>
                                    <form action="{{ route('motor.destroy', $motor->id) }}" method="POST">
                                        <a href="{{ route('motor.edit', $motor->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Data motor masih kosong.</td>
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