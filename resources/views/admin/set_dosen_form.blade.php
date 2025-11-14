@extends('layouts.app')

@section('title', 'Set Dosen Pembimbing 2')

@section('content')
    <div class="card">
        <h2>Penetapan Dosen Pembimbing 2</h2>
        <p>Anda akan menetapkan Dosen Pembimbing 2 untuk Tugas Akhir ini. Pastikan dosen yang dipilih belum menjadi Pembimbing 1.</p>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('admin.dosen.set.submit', $tugasAkhir) }}" method="POST">
            @csrf

            <div class="info-box">
                <p><strong>Mahasiswa:</strong> {{ $tugasAkhir->mahasiswa->name }} ({{ $tugasAkhir->mahasiswa->identifier }})</p>
                <p><strong>Judul TA:</strong> {{ $tugasAkhir->judul_ta }}</p>
                <p><strong>Pembimbing 1:</strong> {{ $tugasAkhir->dosenPembimbing1->name }}</p>
            </div>

            <div class="form-group">
                <label for="dosen_pembimbing_2_id">Pilih Dosen Pembimbing 2</label>
                <select name="dosen_pembimbing_2_id" id="dosen_pembimbing_2_id" required>
                    <option value="" disabled selected>-- Pilih Dosen --</option>
                    @foreach ($availableDosen as $dosen)
                        {{-- Pastikan Pembimbing 2 yang dipilih BUKAN Pembimbing 1 --}}
                        @if ($dosen->id !== $tugasAkhir->dosen_pembimbing_1_id)
                            <option value="{{ $dosen->id }}"
                                {{ old('dosen_pembimbing_2_id', $tugasAkhir->dosen_pembimbing_2_id) == $dosen->id ? 'selected' : '' }}>
                                {{ $dosen->name }} ({{ $dosen->identifier }})
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('dosen_pembimbing_2_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="button button-primary">Tetapkan Pembimbing 2</button>
                <a href="{{ route('admin.laporan.ta') }}" class="button button-secondary">Batal / Kembali</a>
            </div>
        </form>
    </div>

    <style>
        /* CSS untuk Form Penetapan Dosen */
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .info-box {
            background-color: #f7f9fc;
            border: 1px solid #e0e6ed;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .info-box p {
            margin: 5px 0;
            font-size: 0.95em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
            transition: border-color 0.3s;
            background-color: #fff;
        }

        .form-group select:focus {
            border-color: #3498db;
            outline: none;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.85em;
            margin-top: 5px;
            display: block;
        }

        .form-actions {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }

        .button {
            padding: 10px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 1em;
            font-weight: 500;
            transition: background-color 0.3s ease, opacity 0.3s ease;
        }

        .button-primary {
            background-color: #2ecc71;
            color: white;
        }

        .button-primary:hover {
            background-color: #27ae60;
        }

        .button-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .button-secondary:hover {
            background-color: #7f8c8d;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
@endsection
