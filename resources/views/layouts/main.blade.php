<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SITAMA - Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboardmhs.css') }}">
</head>

<body>

<div class="layout">

    <aside class="sidebar">
        <h2 class="sidebar-title">Dashboard</h2>

        <ul class="menu">
            <li><a href="#">🏠 Beranda</a></li>
            <li><a href="#">📄 Tugas Akhir</a></li>
            <li><a href="#">👨‍🏫 Pilihan Dosen</a></li>
            <li><a href="#">💬 Pesan</a></li>
            <li><a href="#">⚙️ Pengaturan</a></li>
        </ul>
    </aside>

    <main class="content">
        @yield('content')
    </main>

</div>

</body>
</html>
