@extends('layouts.dashboard-dosen')

@section('title', 'Beranda Dosen')

@section('content')

<div class="content-header">
    <h1>Selamat Datang, Dosen 👋</h1>
    <p>Berikut ringkasan aktivitas Anda</p>
</div>

<div class="summary-cards">

    <div class="card">
        <p class="card-title">Tugas Akhir</p>
        <div class="card-number status-primary">{{ $taDibimbing ?? 0 }}</div>
        <p class="card-desc">Jumlah Tugas Akhir Dibimbing</p>
    </div>

    <div class="card">
        <p class="card-title">Pengajuan Baru</p>
        <div class="card-number status-warning">{{ $pengajuanBaru ?? 0 }}</div>
        <p class="card-desc">Pengajuan Tugas Akhir Baru</p>
    </div>

    <div class="card">
        <p class="card-title">Total Bimbingan</p>
        <div class="card-number status-secondary">{{ $totalSesiBimbingan ?? 0 }}</div>
        <p class="card-desc">Total Sesi Bimbingan</p>
    </div>
</div>

<div class="table-box">
    <div class="table-header">
        <h3>Daftar Tugas Akhir Mahasiswa Bimbingan</h3>
    </div>
    <table class="dosen-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Judul Tugas Akhir</th>
                <th>Status Revisi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop data Mahasiswa Bimbingan dari Controller --}}
            @foreach($mahasiswaBimbingan as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->name }}</td>
                <td>{{ $mhs->tugasAkhir->judul }}</td>
                <td>
                    {{-- Logika Blade untuk menentukan status pill --}}
                    @if($mhs->tugasAkhir->status_revisi == 'perlu_cek')
                        <span class="status-pill status-blue-pill">Perlu Dicek</span>
                    @elseif($mhs->tugasAkhir->status_revisi == 'disetujui')
                        <span class="status-pill status-green-pill">Disetujui</span>
                    @elseif($mhs->tugasAkhir->status_revisi == 'revisi')
                        <span class="status-pill status-orange-pill">Revisi</span>
                    @endif
                </td>
            </tr>
            @endforeach

                <tr>
                    <td colspan="4" style="text-align: center; color: #888;">Belum ada data mahasiswa bimbingan.</td>
                </tr>
        </tbody>
    </table>
</div>

@endsection
