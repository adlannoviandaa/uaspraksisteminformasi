@extends('layouts.app')

@section('title', 'Edit Pengguna: ' . $user->name)

@section('content')
    <div class="card">
        <h3>Edit Data Pengguna</h3>
        <p>Anda sedang mengedit pengguna: <strong>{{ $user->name }}</strong></p>

        <!-- Menampilkan Error Validasi -->
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT') <!-- Method Spoofing untuk UPDATE -->

            <!-- Nama Pengguna -->
            <label for="name" style="display: block; margin-top: 15px;">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                   style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">

            <!-- ID/NIM/NIP -->
            <label for="identifier" style="display: block; margin-top: 15px;">ID/NIM/NIP (Username Login)</label>
            <input type="text" name="identifier" value="{{ old('identifier', $user->identifier) }}" required
                   style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">

            <!-- Role -->
            <label for="role" style="display: block; margin-top: 15px;">Pilih Role</label>
            <select name="role" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="mahasiswa" {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="dosen" {{ old('role', $user->role) == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>

            <!-- Password (Optional) -->
            <h4 style="margin-top: 30px; border-bottom: 1px dashed #ccc; padding-bottom: 5px;">Ganti Password (Opsional)</h4>

            <label for="password" style="display: block; margin-top: 15px;">Password Baru</label>
            <input type="password" name="password" minlength="8" placeholder="Kosongkan jika tidak ingin mengganti password"
                   style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">

            <!-- Konfirmasi Password -->
            <label for="password_confirmation" style="display: block; margin-top: 15px;">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" minlength="8"
                   style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">

            <button type="submit"
                    style="background-color: #2980b9; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 25px;">
                Simpan Perubahan
            </button>

            <a href="{{ route('admin.users.index') }}" style="color: #7f8c8d; text-decoration: none; margin-left: 15px;">Batal</a>
        </form>
    </div>
@endsection
