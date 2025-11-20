@extends('layouts.auth')

@section('content')

<link rel="stylesheet" href="{{ asset('css/login.css') }}">


<div class="container-all">

    <div class="title-app">
        <h1>SITAMA</h1>
        <p>SISTEM INFORMASI TUGAS AKHIR MAHASISWA</p>
    </div>

    <div class="login-box">
        <h3>LOGIN</h3>

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <input type="text" name="nim" placeholder="Masukkan NIM/NIP/ID Anda" required>

            <input type="password" name="password" placeholder="Masukkan Password" required>

            <a href="#" class="forgot">Lupa Password?</a>

            <select name="role" required>
                <option disabled selected>Pilih Role</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Masuk</button>
        </form>

    </div>

</div>

@endsection
