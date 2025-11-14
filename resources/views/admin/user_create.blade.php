@extends('layouts.app')

@section('title', 'Tambah Pengguna Baru')

@section('content')
    <div class="card">
        <h3>Formulir Tambah Pengguna</h3>

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <label for="name" style="display: block; margin-top: 15px;">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">

            <label for="identifier" style="display: block; margin-top: 15px;">ID/NIM/NIP (Username Login)</label>
            <input type="text" name="identifier" value="{{ old('identifier') }}" required
                   style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">

            <label for="role" style="display: block; margin-top: 15px;">Pilih Role</label>
            <select name="role" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="">-- Pilih Role --</option>
                <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>

            <label for="password" style="display: block; margin-top: 15px;">Password</label>
            <input type="password" name="password" required minlength="8"
                   style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">

            <label for="password_confirmation" style="display: block; margin-top: 15px;">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required minlength="8"
                   style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">

            <button type="submit"
                    style="background-color: #2980b9; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 25px;">
                Simpan Pengguna
            </button>

            <a href="{{ route('admin.users.index') }}" style="color: #7f8c8d; text-decoration: none; margin-left: 15px;">Batal</a>
        </form>
    </div>
@endsection
