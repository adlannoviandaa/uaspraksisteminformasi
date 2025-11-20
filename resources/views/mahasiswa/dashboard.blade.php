@extends('layouts.main')

@section('content')

<div class="max-w-4xl mx-auto mt-10">

    <h2 class="text-3xl font-bold mb-6">Dashboard Mahasiswa</h2>

    {{-- Jika belum pernah mengajukan --}}
    @if(!$tugasAkhir)
        <div class="p-6 bg-yellow-100 border-l-4 border-yellow-600 rounded">
            <h3 class="text-xl font-semibold mb-2">Belum Ada Pengajuan</h3>
            <p>Silakan ajukan Tugas Akhir terlebih dahulu.</p>

            <a href="{{ route('mahasiswa.judul.form') }}"
               class="mt-3 inline-block bg-blue-600 text-white px-5 py-2 rounded">
               Ajukan Sekarang
            </a>
        </div>

    @else

        {{-- Progress Card --}}
        <div class="bg-white shadow rounded p-6 mb-6">
            <h3 class="text-xl font-bold mb-4">Progres Tugas Akhir</h3>

            @php
                $progress = $tugasAkhir->progress ?? 0;
            @endphp

            <div class="w-full bg-gray-200 rounded-full h-5">
                <div class="h-5 rounded-full text-center text-white text-sm"
                     style="width: {{ $progress }}%;
                        background: {{ $progress == 100 ? '#16a34a' : ($progress >= 60 ? '#f59e0b' : '#3b82f6') }};">
                    {{ $progress }}%
                </div>
            </div>

            <p class="mt-4 text-gray-600">
                Status: <span class="font-bold capitalize">{{ $tugasAkhir->status }}</span>
            </p>
        </div>

        {{-- Status Box --}}
        @switch($tugasAkhir->status)

            @case('menunggu')
                <div class="p-6 bg-blue-100 border-l-4 border-blue-600 rounded">
                    <h3 class="text-lg font-semibold">Menunggu Pemeriksaan</h3>
                    <p>Dosen akan segera memeriksa berkas Anda.</p>
                </div>
                @break

            @case('direvisi')
                <div class="p-6 bg-red-100 border-l-4 border-red-600 rounded">
                    <h3 class="text-lg font-semibold">Perlu Revisi</h3>
                    <p>Silakan perbaiki berkas Anda sesuai catatan dosen.</p>

                    <a href="{{ route('mahasiswa.revisi.upload') }}"
                       class="mt-3 inline-block bg-red-600 text-white px-5 py-2 rounded">
                        Upload Revisi
                    </a>
                </div>
                @break

            @case('diterima')
                <div class="p-6 bg-green-100 border-l-4 border-green-600 rounded">
                    <h3 class="text-lg font-semibold">Tugas Akhir Diterima</h3>
                    <p>Selamat! Anda sudah dapat melanjutkan ke tahap berikutnya.</p>
                </div>
                @break

            @default
                <div class="p-6 bg-gray-100 border-l-4 border-gray-400 rounded">
                    <h3 class="text-lg font-semibold">Status Tidak Dikenal</h3>
                </div>

        @endswitch

    @endif

</div>

@endsection
