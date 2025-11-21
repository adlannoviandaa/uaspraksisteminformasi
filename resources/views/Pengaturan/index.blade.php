@extends('layouts.admin')

@section('content')
<div class="settings-container">
    <div class="settings-title">Pengaturan</div>
    <div class="settings-subtitle">Kelola pengaturan akun dan aplikasi Anda.</div>

    <div class="settings-card">
        <div class="settings-card-title">Akun Pengguna</div>
        <div class="settings-card-desc">
            Ubah detail profil, email, dan kata sandi Anda.
        </div>

        <input type="text" placeholder="Nama">
        <input type="email" placeholder="Alamat Email">

        <button class="save-btn">Simpan Perubahan</button>
    </div>
</div>
@endsection
