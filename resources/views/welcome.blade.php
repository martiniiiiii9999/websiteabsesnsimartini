@extends('layouts.app')

@section('title', 'Beranda - Sistem Absensi')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Hero Section -->
        <div class="text-center mb-5 py-5">
            <div class="mb-4">
                <i class="bi bi-calendar-check-fill" style="font-size: 5rem; color: #0d6efd;"></i>
            </div>
            <h1 class="display-4 fw-bold mb-3">Sistem Absensi</h1>
            <p class="lead text-muted mb-4">
                Kelola kehadiran dengan mudah dan efisien. Catat absensi, pantau kehadiran, dan kelola data dengan sistem yang modern dan user-friendly.
            </p>
        </div>

        <!-- Feature Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="bi bi-person-plus-fill" style="font-size: 3.5rem; color: #0d6efd;"></i>
                        </div>
                        <h3 class="card-title fw-bold mb-3">Form Absensi</h3>
                        <p class="card-text text-muted mb-4">
                            Isi data absensi dengan mudah. Input nama, tanggal, waktu masuk/keluar, dan status kehadiran dalam satu form yang sederhana.
                        </p>
                        <a href="{{ route('absensi.index') }}" class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-plus-circle"></i> Isi Absensi
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="bi bi-list-check" style="font-size: 3.5rem; color: #198754;"></i>
                        </div>
                        <h3 class="card-title fw-bold mb-3">Daftar Kehadiran</h3>
                        <p class="card-text text-muted mb-4">
                            Lihat semua data kehadiran dalam satu tempat. Filter berdasarkan tanggal, nama, atau status untuk menemukan data yang Anda cari.
                        </p>
                        <a href="{{ route('absensi.daftar') }}" class="btn btn-success btn-lg px-4">
                            <i class="bi bi-list-ul"></i> Lihat Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h5 class="card-title mb-4 fw-bold">
                    <i class="bi bi-lightning-charge"></i> Akses Cepat
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <a href="{{ route('absensi.index') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-person-plus me-2"></i>
                            <strong>Form Absensi</strong>
                            <br>
                            <small class="text-muted">Tambah data absensi baru</small>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('absensi.daftar') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-list-ul me-2"></i>
                            <strong>Daftar Kehadiran</strong>
                            <br>
                            <small class="text-muted">Lihat semua data absensi</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features List -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold">Mudah Digunakan</h5>
                        <p class="text-muted mb-0">Interface yang sederhana dan intuitif untuk semua pengguna.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="bi bi-speedometer2 text-primary" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold">Cepat & Efisien</h5>
                        <p class="text-muted mb-0">Proses input dan pencarian data yang cepat dan akurat.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="bi bi-funnel-fill text-info" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold">Filter & Pencarian</h5>
                        <p class="text-muted mb-0">Temukan data dengan mudah menggunakan filter yang powerful.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
