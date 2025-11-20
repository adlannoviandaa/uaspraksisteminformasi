<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Gaya Dasar */
        body {
            /* Menggunakan Montserrat sebagai font utama */
            font-family: 'Montserrat', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e8f5e9; /* Warna hijau muda untuk latar belakang */
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Navigasi */
        .sidebar {
            width: 250px;
            /* WARNA BARU: #25805E */
            background-color: #25805E;
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar h2 {
            font-size: 1.5em;
            padding: 0 20px 20px 20px;
            margin: 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nav-links {
            list-style: none;
            padding: 0;
        }

        .nav-links li a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
        }

        .nav-links li a:hover,
        .nav-links li a.active {
            /* Warna hover disesuaikan agar lebih gelap dari #25805E */
            background-color: #1a6449;
        }

        .nav-links i {
            margin-right: 10px;
            font-size: 1.2em;
        }

        /* Konten Utama */
        .main-content {
            flex-grow: 1;
            padding: 40px;
        }

        /* Header Konten */
        .content-header h1 {
            font-size: 2em;
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
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            flex: 1;
            text-align: center;
        }

        .card h3 {
            font-size: 1em;
            color: #666;
            margin-top: 10px;
            margin-bottom: 0;
        }

        .card .number {
            font-size: 2.5em;
            font-weight: bold;
            /* Warna angka pada card disesuaikan dengan warna sidebar baru */
            color: #25805E;
            margin-bottom: 5px;
        }

        /* Tabel Tugas Akhir */
        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        .ta-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .ta-table th, .ta-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        .ta-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #333;
        }

        .ta-table tr:hover {
            background-color: #f9f9f9;
        }

        /* Badge Persentase */
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.85em;
            font-weight: bold;
            color: white;
            text-align: center;
        }

        .badge.diproses {
            background-color: #03a9f4; /* Biru muda */
        }

        .badge.disetujui {
            background-color: #4caf50; /* Hijau */
        }

        /* Untuk keterangan di bawah angka card */
        .card p {
            font-size: 0.8em;
            color: #999;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul class="nav-links">
            <li><a href="#" class="active"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="#"><i class="fas fa-file-alt"></i> Tugas Akhir</a></li>
            <li><a href="#"><i class="fas fa-envelope"></i> Pesan</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Pengaturan</a></li>
        </ul>
    </div>

    <div class="main-content">

        <div class="content-header">
            <h1>Selamat Datang, Dosen 👋</h1>
            <p>Berikut ringkasan aktivitas Anda</p>
        </div>

        <div class="summary-cards">
            <div class="card">
                <div class="number">4</div>
                <h3>Tugas Akhir</h3>
                <p>Jumlah Tugas Akhir</p>
            </div>

            <div class="card">
                <div class="number">1</div>
                <h3>Pesan</h3>
                <p>Jumlah Pesan</p>
            </div>

            <div class="card">
                <div class="number">4</div>
                <h3>Mahasiswa bimbingan</h3>
                <p>Jumlah Mahasiswa Bimbingan</p>
            </div>
        </div>

        <div class="table-container">
            <table class="ta-table">
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
                        <td>Pengembangan Aplikasi Manajemen Data Analisis Pengaruh Media Sosial Terhadap Produktivitas</td>
                        <td>Siti Nuraini, S.Kom, M.Sc.</td>
                        <td><span class="badge diproses">Sedang Diproses</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Analisi Pengaruh Media Sosial Terhadap Produktivitas</td>
                        <td>Ir. Rina Marlina, M.T.</td>
                        <td><span class="badge disetujui">Disetujui</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Rancang Bangun Aplikasi Reservasi Hotel dan Penginapan Berbasis Android</td>
                        <td>Dewi Kartika, S.E, M.M.</td>
                        <td><span class="badge disetujui">Disetujui</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Implementasi Algoritma K-Mearis untuk Pengelompokan Data Penjualan pada UMKM</td>
                        <td>Dr. Rahmat Hidayat, S.T., M.T</td>
                        <td><span class="badge diproses">Sedang Diproses</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
