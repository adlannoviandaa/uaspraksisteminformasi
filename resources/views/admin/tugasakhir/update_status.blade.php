@extends('layouts.admin')

@section('title', 'Update Status Tugas Akhir')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Update Status</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.tugasakhir.updateStatusSubmit', $ta->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Status Baru</label>
                <select name="status" class="form-control" required>
                    <option value="Diajukan" {{ $ta->status == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="Disetujui" {{ $ta->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="Ditolak" {{ $ta->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="Proses Bimbingan" {{ $ta->status == 'Proses Bimbingan' ? 'selected' : '' }}>Proses Bimbingan</option>
                    <option value="Selesai" {{ $ta->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <button class="btn btn-primary">Update Status</button>
            <a href="{{ route('admin.tugasakhir.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
