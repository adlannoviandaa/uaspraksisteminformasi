@extends('layouts.dashboardmhs')

@section('content')

<div class="dashboard-box">

    <h2 style="font-size:22px; margin-bottom:5px;">Dashboard Mahasiswa</h2>
    <p style="color:#555; margin-bottom:20px;">
        Menunjukkan sejauh mana Anda sudah menyelesaikan tiap tahap.
    </p>

    <table class="table">
        <tr>
            <th>Tahap</th>
            <th>Status</th>
            <th>Presentase</th>
        </tr>

        <tr>
            <td>Proposal</td>
            <td>Disetujui</td>
            <td>✔ 100%</td>
        </tr>

        <tr>
            <td>Bab I–III</td>
            <td>Sedang Diperiksa</td>
            <td>⏳ 70%</td>
        </tr>

        <tr>
            <td>Sidang</td>
            <td>Belum</td>
            <td>⬜ 0%</td>
        </tr>
    </table>

</div>

@endsection
