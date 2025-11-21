@extends('layouts.admin')

@section('content')

<div class="content-header">
    <h1>Daftar Tugas Akhir</h1>
    <p>Selamat datang, Admin!</p>
</div>

<div class="table-box">
    <h3>Pengajuan Tugas Akhir</h3>

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
            @foreach($tugasAkhirList as $index => $ta)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ta->mahasiswa->name ?? '-' }}</td>
                    <td>{{ $ta->judul_ta ?? $ta->judul }}</td>

                    <td>
                        @if($ta->status == 'Menunggu' || $ta->status == 'proses')
                            <span class="status-pill status-blue" data-tooltip="Pengajuan sedang diperiksa">
                                Sedang Diproses
                            </span>
                        @elseif($ta->status == 'Diterima' || $ta->status == 'diterima')
                            <span class="status-pill status-green" data-tooltip="Pengajuan telah disetujui">
                                Disetujui
                            </span>
                        @elseif($ta->status == 'Ditolak' || $ta->status == 'ditolak')
                            <span class="status-pill status-red" data-tooltip="Pengajuan ditolak admin">
                                Ditolak
                            </span>
                        @else
                            <span class="status-pill status-gray">
                                {{ $ta->status }}
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
