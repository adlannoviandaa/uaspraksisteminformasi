@extends('layouts.app')

@section('title', 'Daftar Mahasiswa Bimbingan Aktif')

@section('content')
    <div class="card">
        <h3>Mahasiswa Bimbingan Anda</h3>
        <p>Gunakan halaman ini untuk melihat status Tugas Akhir dan memberikan penilaian akhir.</p>
    </div>

    @if ($mahasiswaBimbingan->isEmpty())
        <div class="card" style="border-left: 5px solid #f39c12;">
            <p>Anda belum memiliki mahasiswa bimbingan aktif saat ini.</p>
        </div>
    @else
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="background-color: #ecf0f1;">
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: left;">Mahasiswa</th>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: left;">ID/NIM</th>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: left;">Judul Tugas Akhir</th>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: left;">Status</th>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: left;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswaBimbingan as $ta)
                    <tr>
                        <td style="border: 1px solid #eee; padding: 10px;">{{ $ta->mahasiswa->name }}</td>
                        <td style="border: 1px solid #eee; padding: 10px;">{{ $ta->mahasiswa->identifier }}</td>
                        <td style="border: 1px solid #eee; padding: 10px;">{{ $ta->judul_ta }}</td>
                        <td style="border: 1px solid #eee; padding: 10px;">
                            <span style="padding: 5px 10px; border-radius: 5px; background-color:
                                {{ $ta->status == 'Selesai' ? '#3498db' : '#2ecc71' }}; color: white;">
                                {{ $ta->status }}
                            </span>
                        </td>
                        <td style="border: 1px solid #eee; padding: 10px;">
                            @if ($ta->status == 'Diterima')
                                <a href="{{ route('dosen.grading.form', $ta) }}" style="color: #2ecc71; text-decoration: none; font-weight: bold;">
                                    Beri Nilai Akhir
                                </a>
                                <span style="margin: 0 5px;">|</span>
                                <a href="{{ route('dosen.bimbingan.log.index') }}" style="color: #f39c12; text-decoration: none;">
                                    Cek Log Bimbingan
                                </a>
                            @elseif ($ta->status == 'Selesai')
                                <p style="color: #3498db; font-weight: bold;">Nilai: {{ $ta->nilai_akhir }}</p>
                            @else
                                <!-- Status lain (jika ada) -->
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
