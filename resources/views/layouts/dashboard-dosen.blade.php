<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Dosen')</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/dashboard-dosen.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="{{ url('/dosen/dashboard') }}" class="{{ Request::is('dosen/dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Beranda</a></li>
                <li><a href="{{ url('/dosen/tugas-akhir') }}" class="{{ Request::is('dosen/tugas-akhir*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Tugas Akhir</a></li>
                <li><a href="{{ url('/dosen/pesan') }}" class="{{ Request::is('dosen/pesan*') ? 'active' : '' }}"><i class="fas fa-envelope"></i> Pesan</a></li>
                <li><a href="{{ url('/dosen/pengaturan') }}" class="{{ Request::is('dosen/pengaturan*') ? 'active' : '' }}"><i class="fas fa-cog"></i> Pengaturan</a></li>

                <li><a href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            @yield('content')
        </div>

    </div>

</body>
</html>
