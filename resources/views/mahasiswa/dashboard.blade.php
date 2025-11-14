@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p>Gunakan halaman ini untuk memantau kemajuan Tugas Akhir Anda.</p>
    </div>

    <!-- Tampilkan Status Tugas Akhir -->
    <div class="card" style="margin-top: 20px;">
        @if (!$tugasAkhir)
            <!-- Belum Ada Pengajuan -->
            <div style="text-align: center; padding: 30px; border: 1px dashed #ccc;">
                <h3 style="color: #e74c3c;">Anda Belum Mengajukan Judul Tugas Akhir</h3>
                <p>Silakan segera ajukan judul Anda untuk memulai proses TA.</p>
                <a href="{{ route('mahasiswa.pengajuan.form') }}" style="display: inline-block; padding: 10px 20px; background-color: #3498db; color: white; border-radius: 5px; text-decoration: none; margin-top: 10px;">
                    Ajukan Judul Sekarang
                </a>
            </div>
        @else
            <!-- Rincian Tugas Akhir -->
            <h3>Status Tugas Akhir Anda:</h3>
            <div style="display: flex; gap: 20px;">
                <div style="flex: 2;">
                    <p><strong>Judul:</strong> {{ $tugasAkhir->judul_ta }}</p>
                    <p><strong>Deskripsi Singkat:</strong> {{ $tugasAkhir->deskripsi_ta }}</p>
                    <p>
                        <strong>Pembimbing 1:</strong>
                        {{ $tugasAkhir->dosenPembimbing1 ? $tugasAkhir->dosenPembimbing1->name : 'Belum Ditetapkan' }}
                    </p>

                    <p>
                        <strong>Pembimbing 2:</strong>
                        {{ $tugasAkhir->dosenPembimbing2 ? $tugasAkhir->dosenPembimbing2->name : 'Belum Ditetapkan' }}
                    </p>

                </div>
                <div style="flex: 1; border-left: 3px solid #eee; padding-left: 20px;">
                    <p><strong>Status Saat Ini:</strong>
                        <span style="padding: 5px 10px; border-radius: 5px; font-weight: bold; background-color:
                            @if ($tugasAkhir->status == 'Diajukan') #f39c12
                            @elseif ($tugasAkhir->status == 'Diterima') #2ecc71
                            @elseif ($tugasAkhir->status == 'Ditolak') #e74c3c
                            @elseif ($tugasAkhir->status == 'Selesai') #3498db
                            @endif; color: white;">
                            {{ $tugasAkhir->status }}
                        </span>
                    </p>

                    @if ($tugasAkhir->status == 'Selesai')
                        <h4 style="color: #3498db;">Nilai Akhir: {{ $tugasAkhir->nilai_akhir }}</h4>
                        <p>Tanggal Lulus: {{ $tugasAkhir->tanggal_lulus ? \Carbon\Carbon::parse($tugasAkhir->tanggal_lulus)->format('d M Y') : '-' }}</p>
                    @endif

                    @if ($tugasAkhir->catatan_dosen)
                        <p style="margin-top: 10px; font-style: italic;">
                            <strong>Catatan Dosen (Review Judul):</strong> {{ $tugasAkhir->catatan_dosen }}
                        </p>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Bagian Log Bimbingan & Form Pengajuan (Hanya Muncul Jika Status Diterima) -->
    @if ($tugasAkhir && $tugasAkhir->status == 'Diterima')
        <div style="display: flex; gap: 30px; margin-top: 30px;">
            <!-- Kolom Kiri: Form Pengajuan Log Bimbingan -->
            <div style="flex: 1; min-width: 300px;">
                <div class="card" style="border-left: 5px solid #2980b9;">
                    <h4 style="margin-bottom: 15px;">Ajukan Log Bimbingan Baru</h4>
                    <form action="{{ route('mahasiswa.bimbingan.submit') }}" method="POST">
                        @csrf
                        <label for="catatan_mahasiswa" style="display: block; margin-bottom: 5px;">Deskripsi Kemajuan/Masalah:</label>
                        <textarea name="catatan_mahasiswa" required rows="6" placeholder="Misal: Sudah menyelesaikan Bab 3, butuh review metode penelitian. Atau: Saya mengalami kendala pada implementasi algoritma X." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
                        <button type="submit" style="display: block; width: 100%; padding: 10px; background-color: #2980b9; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;">
                            Kirim Log Bimbingan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Kolom Kanan: Daftar Riwayat Log Bimbingan -->
            <div style="flex: 2;">
                <div class="card">
                    <h4 style="margin-bottom: 15px;">Riwayat Log Bimbingan</h4>
                    @if ($logBimbingan->isEmpty())
                        <p style="font-style: italic; color: #777;">Belum ada riwayat bimbingan.</p>
                    @else
                        @foreach ($logBimbingan as $log)
                            <div style="border: 1px solid #eee; padding: 10px; margin-bottom: 10px; border-radius: 5px; background-color: #f9f9f9; border-left: 4px solid
                                {{ $log->status_dosen == 'Menunggu' ? '#f39c12' : ($log->status_dosen == 'Disetujui' ? '#2ecc71' : '#e74c3c') }};">

                                <p>
                                    <strong>Diajukan:</strong> {{ $log->created_at->format('d M Y H:i') }}
                                    <span style="float: right; font-weight: bold; color:
                                        {{ $log->status_dosen == 'Menunggu' ? '#f39c12' : ($log->status_dosen == 'Disetujui' ? '#2ecc71' : '#e74c3c') }};">
                                        Status: {{ $log->status_dosen }}
                                    </span>
                                </p>
                                <p style="margin-top: 5px;"><strong>Catatan Anda:</strong> {{ $log->catatan_mahasiswa }}</p>

                                @if ($log->status_dosen !== 'Menunggu')
                                    <hr style="margin: 5px 0;">
                                    <p style="font-size: 0.9em;">
                                        <strong>Respon Pembimbing:</strong>
                                        {{ $log->catatan_dosen ?? 'Tidak ada catatan balasan.' }}
                                        <br>
                                        <small>Respon pada: {{ \Carbon\Carbon::parse($log->tanggal_respon)->format('d M Y H:i') }}</small>
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection
