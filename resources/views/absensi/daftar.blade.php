@extends('layouts.app')

@section('title', 'Daftar Kehadiran')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-list-ul"></i> Daftar Kehadiran
                </h4>
                <a href="{{ route('absensi.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Absensi
                </a>
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" action="{{ route('absensi.daftar') }}" class="row g-3">
                            <div class="col-md-3">
                                <label for="tanggal" class="form-label">Filter Tanggal</label>
                                <input type="date" 
                                       class="form-control" 
                                       id="tanggal" 
                                       name="tanggal" 
                                       value="{{ request('tanggal') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="nama" class="form-label">Cari Nama</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nama" 
                                       name="nama" 
                                       value="{{ request('nama') }}" 
                                       placeholder="Masukkan nama">
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="form-label">Filter Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="hadir" {{ request('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="sakit" {{ request('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                    <option value="alfa" {{ request('status') == 'alfa' ? 'selected' : '' }}>Alfa</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                                <a href="{{ route('absensi.daftar') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP/NIM</th>
                                <th>Tanggal</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Keluar</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensis as $index => $absensi)
                                <tr>
                                    <td>{{ $absensis->firstItem() + $index }}</td>
                                    <td><strong>{{ $absensi->nama }}</strong></td>
                                    <td>{{ $absensi->nip ?? '-' }}</td>
                                    <td>{{ $absensi->tanggal->format('d/m/Y') }}</td>
                                    <td>
                                        @if($absensi->waktu_masuk)
                                            <span class="badge bg-info">{{ date('H:i', strtotime($absensi->waktu_masuk)) }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($absensi->waktu_keluar)
                                            <span class="badge bg-warning text-dark">{{ date('H:i', strtotime($absensi->waktu_keluar)) }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($absensi->status == 'hadir')
                                            <span class="badge bg-success">Hadir</span>
                                        @elseif($absensi->status == 'izin')
                                            <span class="badge bg-info text-dark">Izin</span>
                                        @elseif($absensi->status == 'sakit')
                                            <span class="badge bg-warning text-dark">Sakit</span>
                                        @else
                                            <span class="badge bg-danger">Alfa</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($absensi->keterangan)
                                            <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $absensi->keterangan }}">
                                                {{ $absensi->keterangan }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" 
                                                    class="btn btn-warning" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editModal{{ $absensi->id }}"
                                                    title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" 
                                                    class="btn btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $absensi->id }}"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $absensi->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Absensi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" class="form-control" name="nama" value="{{ $absensi->nama }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">NIP/NIM</label>
                                                        <input type="text" class="form-control" name="nip" value="{{ $absensi->nip }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal</label>
                                                        <input type="date" class="form-control" name="tanggal" value="{{ $absensi->tanggal->format('Y-m-d') }}" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Waktu Masuk</label>
                                                            <input type="time" class="form-control" name="waktu_masuk" value="{{ $absensi->waktu_masuk ? date('H:i', strtotime($absensi->waktu_masuk)) : '' }}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Waktu Keluar</label>
                                                            <input type="time" class="form-control" name="waktu_keluar" value="{{ $absensi->waktu_keluar ? date('H:i', strtotime($absensi->waktu_keluar)) : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select class="form-select" name="status" required>
                                                            <option value="hadir" {{ $absensi->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                                            <option value="izin" {{ $absensi->status == 'izin' ? 'selected' : '' }}>Izin</option>
                                                            <option value="sakit" {{ $absensi->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                                            <option value="alfa" {{ $absensi->status == 'alfa' ? 'selected' : '' }}>Alfa</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Keterangan</label>
                                                        <textarea class="form-control" name="keterangan" rows="3">{{ $absensi->keterangan }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $absensi->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('absensi.destroy', $absensi->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus absensi <strong>{{ $absensi->nama }}</strong> pada tanggal <strong>{{ $absensi->tanggal->format('d/m/Y') }}</strong>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-2">Tidak ada data absensi.</p>
                                        <a href="{{ route('absensi.index') }}" class="btn btn-primary">
                                            <i class="bi bi-plus-circle"></i> Tambah Absensi Pertama
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($absensis->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $absensis->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

