<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Admin' }}</title>

    {{-- Font Montserrat --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body>

    <div class="dashboard-container">

        {{-- SIDEBAR --}}
        <div class="sidebar">
            <h2>Dashboard</h2>

            <ul>
                <li><a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Beranda</a>
                </li>

                <li><a href="/admin/tugas-akhir" class="{{ request()->is('admin/tugas-akhir*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i> Tugas Akhir</a>
                </li>

                <li><a href="/admin/pesan" class="{{ request()->is('admin/pesan*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> Pesan</a>
                </li>

                <li><a href="/admin/pengaturan" class="{{ request()->is('admin/pengaturan') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Pengaturan</a>
                </li>
            </ul>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="main-content">
            @yield('content')
        </div>

    </div>

</body>
</html>
