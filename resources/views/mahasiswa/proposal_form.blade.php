@extends('layouts.app')

@section('title', 'Ajukan Proposal Tugas Akhir')

@section('content')
    <div class="card">
        <h2>Ajukan Proposal Tugas Akhir</h2>
        <p>Isi formulir di bawah ini untuk mengajukan judul Tugas Akhir (TA) dan memilih calon Dosen Pembimbing 1 Anda.</p>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('mahasiswa.proposal.submit') }}" method="POST">
            @csrf

            {{-- Bidang Judul Tugas Akhir --}}
            <div class="form-group">
                <label for="judul_ta">Judul Tugas Akhir <span class="required-field">*</span></label>
                <textarea name="judul_ta" id="judul_ta" rows="3" placeholder="Masukkan judul TA yang spesifik dan jelas..." required>{{ old('judul_ta') }}</textarea>
                @error('judul_ta')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Bidang Pemilihan Pembimbing 1 --}}
            <div class="form-group">
                <label for="dosen_pembimbing_1_id">Pilih Dosen Pembimbing 1 <span class="required-field">*</span></label>
                <select name="dosen_pembimbing_1_id" id="dosen_pembimbing_1_id" required>
                    <option value="" disabled selected>-- Pilih Dosen Calon Pembimbing --</option>
                    {{-- $dosenList datang dari controller --}}
                    @foreach ($dosenList as $dosen)
                        <option value="{{ $dosen->id }}"
                            {{ old('dosen_pembimbing_1_id') == $dosen->id ? 'selected' : '' }}>
                            {{ $dosen->name }} ({{ $dosen->identifier }})
                        </option>
                    @endforeach
                </select>
                <small class="help-text">Pilih dosen yang sesuai dengan topik TA Anda.</small>
                @error('dosen_pembimbing_1_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="button button-primary">Kirim Proposal</button>
                <a href="{{ route('mahasiswa.dashboard') }}" class="button button-secondary">Batal</a>
            </div>
        </form>
    </div>

    <style>
        /* CSS Styling */
        .card {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 5px solid #007bff;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .required-field {
            color: #dc3545;
            font-size: 1.1em;
            margin-left: 3px;
        }

        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }

        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        .help-text {
            display: block;
            margin-top: 5px;
            color: #6c757d;
            font-size: 0.9em;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.85em;
            margin-top: 5px;
            display: block;
        }

        .form-actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 1em;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        .button-primary {
            background-color: #28a745; /* Hijau */
            color: white;
        }

        .button-primary:hover {
            background-color: #218838;
            transform: translateY(-1px);
        }

        .button-secondary {
            background-color: #6c757d; /* Abu-abu */
            color: white;
        }

        .button-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-1px);
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
