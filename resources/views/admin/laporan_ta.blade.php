@extends('layouts.app')

@section('title', 'Laporan Tugas Akhir')

@section('content')
    <div class="card">
        <h2>Laporan Global Tugas Akhir</h2>
        <p>Daftar lengkap semua judul Tugas Akhir yang diajukan oleh mahasiswa.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-container" style="overflow-x: auto; margin-top: 20px;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mahasiswa</th>
                    <th>Judul Tugas Akhir</th>
                    <th>Status</th>
                    <th>Pembimbing 1</th>
                    <th>Pembimbing 2</th>
                    <th>Aksi Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tugasAkhirList as $ta)
                    <tr>
                        <td>{{ $ta->id }}</td>
                        <td>{{ $ta->mahasiswa->name }} ({{ $ta->mahasiswa->identifier }})</td>
                        <td>{{ $ta->judul_ta }}</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($ta->status) }}">
                                {{ $ta->status }}
                            </span>
                        </td>
                        <td>{{ $ta->dosenPembimbing1->name ?? 'N/A' }}</td>
                        <td>{{ $ta->dosenPembimbing2->name ?? 'Belum Ditentukan' }}</td>
                        <td>
                            {{-- Tombol Set Pembimbing 2 hanya muncul jika statusnya Diterima --}}
                            @if ($ta->status === 'Diterima')
                                <a href="{{ route('admin.dosen.set.form', $ta) }}" class="button button-info">
                                    Set Pembimbing 2
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">Belum ada Tugas Akhir yang diajukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <style>
        /* CSS Tambahan untuk Laporan TA */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 0.9em;
        }

        .data-table th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }

        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.8em;
            font-weight: bold;
            color: white;
            display: inline-block;
        }

        .status-diajukan { background-color: #3498db; }
        .status-diterima { background-color: #27ae60; }
        .status-ditolak { background-color: #e74c3c; }
        .status-selesai { background-color: #9b59b6; }

        .button {
            display: inline-block;
            padding: 8px 12px;
            margin: 2px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 0.85em;
            font-weight: 500;
        }

        .button-info {
            background-color: #3498db;
            color: white;
            transition: background-color 0.3s ease;
        }

        .button-info:hover {
            background-color: #2980b9;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
@endsection
