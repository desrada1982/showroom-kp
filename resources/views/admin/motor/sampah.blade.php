@extends('layouts.app')

@section('title', 'Tong Sampah Motor')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h4 class="text-white">Tong Sampah - Data Motor Terhapus</h4>
                <div class="card-header-action">
                    <a href="{{ route('motor.index') }}" class="btn btn-light text-dark"><i class="fas fa-arrow-left"></i> Kembali ke Data Motor</a>
                </div>
            </div>
            <div class="card-body">
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Info Motor</th>
                                <th>Harga</th>
                                <th>Waktu Dihapus</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($motors as $index => $motor)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $motor->nama_motor }}</strong><br>
                                    <span class="text-muted">{{ $motor->merek }}</span>
                                </td>
                                <td>Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($motor->deleted_at)->format('d M Y - H:i') }}</td>
                                <td>
                                    <!-- Tombol Restore -->
                                    <form action="{{ route('motor.restore', $motor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Kembalikan data ini ke tabel utama?')">
                                            <i class="fas fa-undo"></i> Restore
                                        </button>
                                    </form>

                                    <!-- Tombol Hapus Permanen -->
                                    <form action="{{ route('motor.force_delete', $motor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('PERINGATAN: Data akan hilang selamanya. Yakin?')">
                                            <i class="fas fa-trash-alt"></i> Hapus Permanen
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tong sampah kosong.</td>
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