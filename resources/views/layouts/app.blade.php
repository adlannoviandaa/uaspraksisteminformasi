<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SITAMA')</title>

    <!-- Pastikan CSS di folder public/css -->
    <link rel="stylesheet" href="{{ asset('css/dashboardmhs.css') }}">
</head>

<body>
    <div class="wrapper">

        <!-- Sidebar -->
        <nav class="sidebar">
            <ul>

                @if(Auth::check())

                    @if(Auth::user()->role == 'mahasiswa')
                        <li><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('mahasiswa.judul.form') }}">Ajukan Judul</a></li>
                        <li><a href="{{ route('mahasiswa.bimbingan.riwayat') }}">Riwayat Bimbingan</a></li>
                        <li><a href="{{ route('mahasiswa.ta.laporan') }}">Laporan TA</a></li>

                    @elseif(Auth::user()->role == 'dosen')
                        <li><a href="{{ route('dosen.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('dosen.judul.persetujuan') }}">Persetujuan Judul</a></li>
                        <li><a href="{{ route('dosen.bimbingan.log') }}">Log Bimbingan</a></li>

                    @elseif(Auth::user()->role == 'admin')
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                    @endif

                @endif

            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            @include('partials.alert')
            @yield('content')
        </div>

    </div>
</body>
</html>
