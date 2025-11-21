@extends('layouts.admin')

@section('content')

<div class="content-header">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, Admin!</p>
</div>

<div class="summary-cards">
    <div class="card">
        <p class="card-title">Total Mahasiswa</p>
        <div class="card-number">{{ $totalMahasiswa }}</div>
        <p class="card-desc">Jumlah Mahasiswa</p>
    </div>

    <div class="card">
        <p class="card-title">Tugas Akhir</p>
        <div class="card-number">{{ $totalTA }}</div>
        <p class="card-desc">Jumlah Tugas Akhir</p>
    </div>

    <div class="card">
        <p class="card-title">Pesan</p>
        <div class="card-number">{{ $totalPesan }}</div>
        <p class="card-desc">Jumlah Pesan</p>
    </div>
</div>

<div class="table-box">
    <h3>Daftar Pengajuan Tugas Akhir</h3>

    <table class="ta-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Mahasiswa</th>
                <th>Judul</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pengajuan as $index => $ta)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ta->mahasiswa->name }}</td>
                    <td>{{ $ta->judul }}</td>

                    <td>
                        @if($ta->status == 'proses')
                            <span class="status-pill status-blue" data-tooltip="Pengajuan sedang diperiksa">
                                Sedang Diproses
                            </span>
                        @elseif($ta->status == 'diterima')
                            <span class="status-pill status-green" data-tooltip="Pengajuan telah disetujui">
                                Disetujui
                            </span>
                        @else
                            <span class="status-pill status-red" data-tooltip="Pengajuan ditolak admin">
                                Ditolak
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
