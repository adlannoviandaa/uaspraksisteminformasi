@extends('layouts.app')

@section('title', 'Daftar Judul Tugas Akhir untuk Ditinjau')

@section('content')
    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($judulReview->isEmpty())
        <div class="card">
            <p>Tidak ada judul Tugas Akhir yang menunggu peninjauan saat ini.</p>
        </div>
    @else
        @foreach ($judulReview as $ta)
            <div class="card" style="margin-bottom: 30px; border-bottom: 2px solid #ccc;">
                <h3>{{ $ta->judul_ta }}</h3>
                <p><strong>Mahasiswa:</strong> {{ $ta->mahasiswa->name }} ({{ $ta->mahasiswa->identifier }})</p>
                <p><strong>Bidang Minat:</strong> {{ $ta->bidang_minat }}</p>
                <p><strong>Deskripsi:</strong> {{ $ta->deskripsi }}</p>

                <hr>

                <h4>Tindakan:</h4>
                <form action="{{ route('dosen.review.proses', $ta) }}" method="POST">
                    @csrf

                    <label for="action">Keputusan:</label>
                    <select name="action" required style="padding: 8px; margin-right: 15px;">
                        <option value="terima">TERIMA</option>
                        <option value="tolak">TOLAK</option>
                    </select>

                    <textarea name="catatan" placeholder="Catatan/Saran (Opsional)" rows="2" style="width: 80%; padding: 8px; margin-top: 10px;"></textarea>

                    <button type="submit" style="background-color: #2ecc71; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;">Proses Judul</button>
                </form>
            </div>
        @endforeach
    @endif
@endsection
