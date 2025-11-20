@extends('layouts.dashboard-dosen')

@section('content')

<div class="dashboard-container">

    <!-- SIDEBAR ADA DI LAYOUT, TIDAK PERLU DI SINI -->

    <div class="content">
        <h1>Selamat Datang, Dosen 👋</h1>
        <p class="subtitle">Berikut ringkasan aktivitas Anda</p>

        <div class="summary-cards">
            <div class="card">
                <h3>Tugas Akhir</h3>
                <div class="value">4</div>
            </div>
            <div class="card">
                <h3>Pesan</h3>
                <div class="value">1</div>
            </div>
            <div class="card">
                <h3>Mahasiswa bimbingan</h3>
                <div class="value">4</div>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Tugas Akhir</th>
                        <th>Nama Dosen</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Pengembangan Aplikasi ...</td>
                        <td>Siti Nuarini</td>
                        <td><span class="badge badge-orange">Sedang Diproses</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
