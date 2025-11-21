@extends('layout.admin')

{{-- resources/views/settings/update.blade.php --}}

@extends('layout.app2')

@section('title', 'Pengaturan Akun')

@section('content')

<h1 class="text-4xl font-bold mb-2">Pengaturan</h1>
<p class="text-gray-700 mb-6">Kelola pengaturan akun dan aplikasi Anda.</p>

<div class="bg-gray-200 p-8 rounded-lg shadow-md w-3/4">

    <h2 class="text-2xl font-semibold mb-1">Akun Pengguna</h2>
    <p class="text-gray-600 mb-4">Ubah detail profil, email, dan kata sandi Anda.</p>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="bg-green-300 text-green-900 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="bg-red-300 text-red-900 p-3 rounded mb-4">
            <ul class="list-disc ml-5 text-sm">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf

        {{-- Input Nama --}}
        <label class="block mb-1 font-semibold">Nama</label>
        <input type="text" name="name"
               value="{{ old('name', $user->name) }}"
               class="w-full p-2 rounded border mb-4">

        {{-- Input Email --}}
        <label class="block mb-1 font-semibold">Alamat Email</label>
        <input type="email" name="email"
               value="{{ old('email', $user->email) }}"
               class="w-full p-2 rounded border mb-6">

        <button type="submit"
                class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 transition">
            Simpan Perubahan
        </button>

    </form>

</div>

@endsection

