@extends('layouts.app')

@section('title', 'Pengajuan Judul Tugas Akhir')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen flex items-start justify-center">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-2xl p-8">
        <h1 class="text-3xl font-extrabold text-indigo-700 mb-6 border-b-2 border-indigo-200 pb-3">
            Formulir Pengajuan Judul Tugas Akhir
        </h1>

        @if ($status['judul_diajukan'])
            <!-- Tampilan Status Jika Sudah Mengajukan -->
            <div class="p-6 bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-2">Judul Anda Sudah Diajukan</h2>
                <p class="mb-1"><span class="font-semibold">Judul:</span> {{ $mahasiswa->judul->judul }}</p>
                <p class="mb-3"><span class="font-semibold">Ringkasan:</span> {{ Str::limit($mahasiswa->judul->ringkasan, 150) }}</p>
                <p class="text-lg font-extrabold
                    @if ($mahasiswa->judul->status == 'disetujui') text-green-600 @elseif ($mahasiswa->judul->status == 'ditolak') text-red-600 @else text-yellow-600 @endif">
                    Status Saat Ini: {{ ucfirst($mahasiswa->judul->status) }}
                </p>

                @if ($mahasiswa->judul->catatan)
                    <div class="mt-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <p class="font-semibold">Catatan Admin/Dosen:</p>
                        <p class="text-sm italic">{{ $mahasiswa->judul->catatan }}</p>
                    </div>
                @endif

                @if ($mahasiswa->judul->status == 'ditolak')
                    <p class="mt-4 text-sm text-gray-600">Anda dapat mengajukan judul baru setelah revisi.</p>
                @endif
            </div>

        @else
            <!-- Tampilan Form Pengajuan -->
            <form action="{{ route('mahasiswa.pengajuan-judul.submit') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Judul Tugas Akhir -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Tugas Akhir <span class="text-red-500">*</span></label>
                    <input type="text" id="judul" name="judul" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 @error('judul') border-red-500 @enderror"
                           placeholder="Contoh: Implementasi Deep Learning untuk Klasifikasi Citra">
                    @error('judul')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ringkasan/Abstrak Singkat -->
                <div>
                    <label for="ringkasan" class="block text-sm font-medium text-gray-700 mb-1">Ringkasan/Abstrak Singkat (Max 500 Kata) <span class="text-red-500">*</span></label>
                    <textarea id="ringkasan" name="ringkasan" rows="5" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 @error('ringkasan') border-red-500 @enderror"
                              placeholder="Jelaskan secara singkat latar belakang, tujuan, dan metode yang akan digunakan dalam TA Anda."></textarea>
                    @error('ringkasan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Calon Pembimbing 1 -->
                <div>
                    <label for="pembimbing1_id" class="block text-sm font-medium text-gray-700 mb-1">Calon Pembimbing 1 <span class="text-red-500">*</span></label>
                    <select id="pembimbing1_id" name="pembimbing1_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 @error('pembimbing1_id') border-red-500 @enderror">
                        <option value="">-- Pilih Dosen Pembimbing 1 --</option>
                        @foreach ($dosens as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->name }} ({{ $dosen->nip }})</option>
                        @endforeach
                    </select>
                    @error('pembimbing1_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-[1.01]">
                        Ajukan Judul
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
