@extends('layouts.admin')

@section('title', 'Detail Tugas Akhir')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Detail Tugas Akhir</h4>
    </div>

    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item"><b>Nama:</b> {{ $ta->mahasiswa->nama }}</li>
            <li class="list-group-item"><b>NIM:</b> {{ $ta->mahasiswa->nim }}</li>
            <li class="list-group-item"><b>Judul:</b> {{ $ta->judul }}</li>
            <li class="list-group-item"><b>Status:</b> {{ $ta->status }}</li>
            <li class="list-group-item"><b>Dosen Pembimbing:</b> {{ $ta->dosen_pembimbing ?? 'Belum ditentukan' }}</li>
        </ul>

        <a href="{{ route('admin.tugasakhir.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
