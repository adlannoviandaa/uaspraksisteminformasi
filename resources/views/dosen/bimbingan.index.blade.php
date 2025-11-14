@extends('layouts.app')

@section('title', 'Manajemen Log Bimbingan Mahasiswa')

@section('content')
    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <h3>Daftar Semua Log Bimbingan Mahasiswa Bimbingan Anda</h3>
        <p>Anda dapat melihat riwayat dan memproses permintaan bimbingan yang baru diajukan.</p>
    </div>

    @if ($logBimbingan->isEmpty())
        <div class="card" style="border-left: 5px solid #3498db;">
            <p>Tidak ada log bimbingan yang diajukan oleh mahasiswa bimbingan Anda saat ini.</p>
        </div>
    @else
        @foreach ($logBimbingan as $log)
            <div class="card" style="margin-bottom: 20px; border-left: 5px solid
                {{ $log->status_dosen == 'Menunggu' ? '#f39c12' : ($log->status_dosen == 'Disetujui' ? '#2ecc71' : '#e74c3c') }};">

                <p style="font-size: 1.1em; margin-bottom: 5px;">
                    <strong>Mahasiswa:</strong> {{ $log->tugasAkhir->mahasiswa->name }} ({{ $log->tugasAkhir->mahasiswa->identifier }})
                </p>
                <p><strong>Judul TA:</strong> {{ $log->tugasAkhir->judul_ta }}</p>
                <p><strong>Tanggal Pengajuan:</strong> {{ $log->created_at->format('d M Y H:i') }}</p>

                <hr style="margin: 10px 0;">

                <h4>Catatan Mahasiswa:</h4>
                <div style="background-color: #f9f9f9; padding: 10px; border-radius: 5px; border: 1px solid #eee;">
                    {{ $log->catatan_mahasiswa }}
                </div>

                <h4 style="margin-top: 15px;">Status dan Respon Dosen:</h4>

                @if ($log->status_dosen == 'Menunggu')
                    <!-- FORM RESPON DOSEN -->
                    <form action="{{ route('dosen.bimbingan.proses', $log) }}" method="POST">
                        @csrf

                        <label for="status_dosen">Keputusan:</label>
                        <select name="status_dosen" required style="padding: 8px; margin-right: 15px;">
                            <option value="Disetujui">Disetujui</option>
                            <option value="Revisi">Revisi</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>

                        <textarea name="catatan_dosen" placeholder="Catatan/Saran Balasan untuk Mahasiswa" rows="3" style="width: 100%; padding: 8px; margin-top: 10px;"></textarea>

                        <button type="submit" style="background-color: #3498db; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;">Kirim Respon</button>
                    </form>
                @else
                    <!-- RESUME RESPON DOSEN -->
                    <div style="padding: 10px; border-radius: 5px; background-color: #ecf0f1;">
                        <strong>Status:</strong>
                        <span style="font-weight: bold; color: {{ $log->status_dosen == 'Disetujui' ? 'green' : 'red' }};">{{ $log->status_dosen }}</span>
                        <br>
                        <strong>Respon Anda:</strong> {{ $log->catatan_dosen ?? 'Tidak ada catatan.' }}
                        <br>
                        <small>Respon diberikan pada: {{ \Carbon\Carbon::parse($log->tanggal_respon)->format('d M Y H:i') }}</small>
                    </div>
                @endif
            </div>
        @endforeach
    @endif
@endsection
