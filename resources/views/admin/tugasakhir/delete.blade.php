@extends('layouts.admin')

@section('title', 'Hapus Tugas Akhir')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Konfirmasi Hapus</h4>
    </div>

    <div class="card-body">
        <p>Anda yakin ingin menghapus data Tugas Akhir berikut?</p>

        <ul>
            <li><b>Nama:</b> {{ $ta->mahasiswa->nama }}</li>
            <li><b>NIM:</b> {{ $ta->mahasiswa->nim }}</li>
            <li><b>Judul TA:</b> {{ $ta->judul }}</li>
        </ul>

        <form action="{{ route('admin.tugasakhir.destroy', $ta->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger">Hapus</button>
            <a href="{{ route('admin.tugasakhir.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
