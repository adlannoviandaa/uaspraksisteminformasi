@extends('layouts.app')

@section('title', 'Dashboard Dosen Pembimbing')

@section('content')
    <div class="card">
        <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p>Ringkasan tugas akademik Anda saat ini:</p>
    </div>

    <div style="display: flex; gap: 20px;">
        <div class="card" style="flex: 1; border-left: 5px solid #2980b9;">
            <h3>Mahasiswa Bimbingan Aktif</h3>
            <h1>{{ $jumlahBimbingan }}</h1>
            <p>Anda adalah Pembimbing 1 untuk mahasiswa ini.</p>
        </div>

        <div class="card" style="flex: 1; border-left: 5px solid #f39c12;">
            <h3>Judul Menunggu Review</h3>
            <h1>{{ $judulMenunggu }}</h1>
            <a href="{{ route('dosen.review.index') }}" style="color: #f39c12; text-decoration: none; font-weight: bold;">Lihat Daftar Review &raquo;</a>
        </div>

        <!-- CARD BARU: Log Bimbingan Menunggu -->
        <div class="card" style="flex: 1; border-left: 5px solid #e74c3c;">
            <h3>Log Bimbingan Menunggu</h3>
            <h1>{{ $logMenungguRespon }}</h1>
            <a href="{{ route('dosen.bimbingan.log.index') }}" style="color: #e74c3c; text-decoration: none; font-weight: bold;">Tindak Lanjuti Sekarang &raquo;</a>
        </div>
    </div>
@endsection
