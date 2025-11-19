@extends('layouts.app')

@section('content')
<div class="container-all">
    <div class="title-app">
        <h1>Dashboard Mahasiswa</h1>
        <p>Selamat datang, {{ auth()->user()->name }}</p>
    </div>

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div style="color: red; margin-bottom: 10px;">{{ session('error') }}</div>
    @endif

    @if (!$tugasAkhir)
        <div style="text-align: center; padding: 30px; border: 1px dashed #ccc;">
            <h3 style="color: #e74c3c;">Anda Belum Mengajukan Judul Tugas Akhir</h3>
            <p>Silakan segera ajukan judul Anda untuk memulai proses TA.</p>
            <a href="{{ route('mahasiswa.judul.form') }}"
               style="display: inline-block; padding: 10px 20px; background-color: #3498db; color: white; border-radius: 5px; text-decoration: none; margin-top: 10px;">
                Ajukan Judul Sekarang
            </a>
        </div>
    @else
        <div style="padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
            <h3>Status Tugas Akhir Anda</h3>
            <p><strong>Judul:</strong> {{ $tugasAkhir->judul_ta }}</p>
            <p><strong>Status:</strong> {{ $tugasAkhir->status }}</p>
            <p><strong>Pembimbing 1:</strong> {{ $tugasAkhir->dosenPembimbing1->name ?? '-' }}</p>
            <p><strong>Pembimbing 2:</strong> {{ $tugasAkhir->dosenPembimbing2->name ?? '-' }}</p>
        </div>
    @endif
</div>
@endsection
