@extends('layouts.app')

@section('title', 'Dashboard Administrator')

@section('content')
    <div class="card">
        <h2>Panel Kontrol Sistem SITAMA</h2>
        <p>Ringkasan pengguna dan Tugas Akhir di sistem:</p>
    </div>

    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <!-- Statistik Pengguna -->
        <div class="card" style="flex: 1; min-width: 200px; border-left: 5px solid #2ecc71;">
            <h3>Total Pengguna</h3>
            <h1>{{ $totalUsers }}</h1>
        </div>

        <div class="card" style="flex: 1; min-width: 200px; border-left: 5px solid #3498db;">
            <h3>Mahasiswa</h3>
            <h1>{{ $totalMahasiswa }}</h1>
        </div>

        <div class="card" style="flex: 1; min-width: 200px; border-left: 5px solid #e67e22;">
            <h3>Dosen</h3>
            <h1>{{ $totalDosen }}</h1>
        </div>
    </div>

    <!-- Statistik Status TA -->
    <div class="card" style="margin-top: 20px;">
        <h3>Status Pengajuan Tugas Akhir</h3>
        <div style="display: flex; gap: 20px; margin-top: 15px;">
            <div style="flex: 1; text-align: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <p style="font-size: 14px; color: #f39c12;">DIAJUKAN</p>
                <h2 style="color: #f39c12;">{{ $totalDiajukan }}</h2>
            </div>
            <div style="flex: 1; text-align: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <p style="font-size: 14px; color: #2ecc71;">DITERIMA</p>
                <h2 style="color: #2ecc71;">{{ $totalDiterima }}</h2>
            </div>
            <div style="flex: 1; text-align: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <p style="font-size: 14px; color: #e74c3c;">DITOLAK</p>
                <h2 style="color: #e74c3c;">{{ $totalDitolak }}</h2>
            </div>
        </div>
    </div>

    <!-- Link Aksi -->
    <div class="card" style="margin-top: 20px;">
        <a href="{{ route('admin.users.index') }}" style="background-color: #9b59b6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Kelola Pengguna Sistem &raquo;</a>
        <a href="{{ route('admin.laporan.ta') }}" style="background-color: #34495e; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-left: 10px;">Lihat Laporan TA Global &raquo;</a>
    </div>
@endsection
