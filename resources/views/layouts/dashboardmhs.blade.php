<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SITAMA - Dashboard Mahasiswa</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Variabel Warna Disesuaikan */
        :root {
            --sidebar-color: #25805E; /* WARNA BARU: Hijau Tua */
            --accent-color: #388E3C; /* Hijau yang serasi untuk Penekanan/Proses */
            --bg-color: #f0f4f7; /* Latar Belakang Abu-abu Muda */
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Gaya Dasar */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            display: flex;
            min-height: 100vh;
        }

        .layout {
            display: flex;
            width: 100%;
        }

        /* Sidebar Navigasi */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-color); /* MENGGUNAKAN WARNA BARU #25805E */
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar-title {
            font-size: 1.6em;
            font-weight: 600;
            padding: 0 20px 20px 20px;
            margin: 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu li a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            transition: background-color 0.3s, transform 0.1s;
            font-weight: 400;
        }

        .menu li a:hover,
        .menu li a.active {
            /* Warna hover disesuaikan agar lebih gelap dari #25805E */
            background-color: #1a6449;
        }

        /* Konten Utama */
        .content {
            flex-grow: 1;
            padding: 40px;
        }

        .content-header h1 {
            font-size: 2em;
            font-weight: 600;
            color: #333;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .content-header p {
            color: #666;
            margin-bottom: 30px;
        }

        /* Ringkasan Aktivitas (Card) */
        .summary-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            flex: 1;
            text-align: left;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .card h3 {
            font-size: 1em;
            font-weight: 400;
            color: #666;
            margin-top: 10px;
            margin-bottom: 0;
        }

        .card .number {
            font-size: 3em;
            font-weight: 700;
            color: var(--sidebar-color); /* MENGGUNAKAN WARNA BARU #25805E */
            line-height: 1;
            margin-bottom: 5px;
        }

        /* Tabel Tugas Akhir Mahasiswa */
        .table-container {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        .ta-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .ta-table th, .ta-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .ta-table th {
            background-color: #f9f9f9;
            font-weight: 600;
            color: #444;
            text-transform: uppercase;
            font-size: 0.9em;
        }

        .ta-table tr:hover {
            background-color: #fafafa;
        }

        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
            color: white;
            text-align: center;
        }

        .badge.diajukan {
            background-color: #ff9800; /* Orange (untuk Revisi/Diajukan) */
        }

        .badge.bimbingan {
            background-color: #4CAF50; /* Hijau (untuk Disetujui/Bimbingan) */
        }

        .badge.lulus {
            background-color: #2E7D32; /* Hijau gelap (untuk Lulus) */
        }

        .badge.proses {
            background-color: var(--accent-color); /* Hijau #388E3C (untuk Proses) */
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">
        <h2 class="sidebar-title">Dashboard</h2>

        <ul class="menu">
            <li><a href="#" class="active">🏠 Beranda</a></li>
            <li><a href="#">📄 Tugas Akhir</a></li>
            <li><a href="#">👨‍🏫 Pilihan Dosen</a></li>
            <li><a href="#">💬 Pesan</a></li>
            <li><a href="#">⚙️ Pengaturan</a></li>
        </ul>
    </aside>

    <main class="content">

        <div class="content-header">
            <h1>Selamat Datang, Mahasiswa! 👋</h1>
            <p>Ringkasan status akademik Tugas Akhir Anda</p>
        </div>

        <div class="summary-cards">

            <div class="card">
                <h3>Status Bimbingan</h3>
                <div class="number">12x</div>
                <p style="font-size: 0.9em; color: #999;">Total Sesi Bimbingan</p>
            </div>

            <div class="card">
                <h3>Bab Selesai</h3>
                <div class="number">4</div>
                <p style="font-size: 0.9em; color: #999;">Bab dari 5 Bab TA</p>
            </div>

            <div class="card">
                <h3>Status Akhir</h3>
                <div class="number" style="color: var(--accent-color);">Proses</div>
                <p style="font-size: 0.9em; color: #999;">TA Sedang Berjalan</p>
            </div>
        </div>

        <div class="table-container">
            <h2>Riwayat Bimbingan Terakhir</h2>
            <table class="ta-table">
                <thead>
                    <tr>
                        <th>Tgl Bimbingan</th>
                        <th>Materi</th>
                        <th>Dosen Pembimbing</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>20 November 2025</td>
                        <td>Revisi Bab 3 dan Metodologi</td>
                        <td>Dr. Rahmat Hidayat, S.T., M.T</td>
                        <td><span class="badge bimbingan">Disetujui</span></td>
                    </tr>
                    <tr>
                        <td>15 November 2025</td>
                        <td>Pengajuan Bab 4 (Hasil & Pembahasan)</td>
                        <td>Dr. Rahmat Hidayat, S.T., M.T</td>
                        <td><span class="badge diajukan">Revisi</span></td>
                    </tr>
                    <tr>
                        <td>10 November 2025</td>
                        <td>Presentasi Progress Bab 1-2</td>
                        <td>Dr. Rahmat Hidayat, S.T., M.T</td>
                        <td><span class="badge bimbingan">Disetujui</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

</div>

</body>
</html>
