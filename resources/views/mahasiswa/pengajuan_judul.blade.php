@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Ajukan Judul Tugas Akhir</h2>

    <form action="{{ route('mahasiswa.judul.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Judul Tugas Akhir</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Ajukan</button>
    </form>
</div>
@endsection
