@extends('layouts.admin')

@section('title', 'Set Dosen Pembimbing')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Set Dosen Pembimbing</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.tugasakhir.setDosenSubmit', $ta->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Pilih Dosen Pembimbing</label>
                <select name="dosen_pembimbing" class="form-control">
                    @foreach ($dosen as $d)
                        <option value="{{ $d->nama }}" {{ $ta->dosen_pembimbing == $d->nama ? 'selected' : '' }}>
                            {{ $d->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.tugasakhir.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
