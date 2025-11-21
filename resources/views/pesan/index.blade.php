@extends('layouts.admin')

@section('title', 'Pesan')

@section('content')
<div class="pesan-container">

    <h1 class="title">Pesan</h1>
    <p class="subtitle">Kelola pesan masuk dari mahasiswa.</p>

    <div class="pesan-wrapper">

        <!-- New Messages -->
        <div class="pesan-box">
            <h2 class="box-title">New Messages</h2>

            <div class="pesan-item">
                <div class="pesan-info">
                    <span class="nama">Cut Rezky Azaky</span>
                    <span class="waktu">10:45 AM</span>
                </div>
                <div class="judul">Revisi Bab 1</div>
                <div class="preview">Permisi Pak, saya sudah melakukan revisi</div>
            </div>

            <div class="pesan-item">
                <div class="pesan-info">
                    <span class="nama">Eky</span>
                    <span class="waktu">2 hari lalu</span>
                </div>
                <div class="judul">Pengajuan Judul Baru</div>
                <div class="preview">Pak, saya ingin mengajukan judul baru un...</div>
            </div>

        </div>

        <!-- Awaiting Reply -->
        <div class="pesan-box">
            <h2 class="box-title">Awaiting Reply</h2>

            <div class="pesan-item">
                <div class="pesan-info">
                    <span class="nama">Jihan Haniifah</span>
                    <span class="waktu">10:45 AM</span>
                </div>
                <div class="judul">Jadwal Bimbingan</div>
                <div class="preview">Selamat pagi Pak, apakah besok Bapak...</div>
            </div>

        </div>

    </div>
</div>
@endsection
