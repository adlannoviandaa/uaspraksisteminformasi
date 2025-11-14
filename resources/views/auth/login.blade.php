<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITAMA - Login</title>

    <!-- CSS HARUS DI SINI, DI LUAR TAG <style> -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-container">
        <h1 class="sitama-title">SITAMA</h1>
        <p class="sitama-sub">SISTEM INFORMASI TUGAS AKHIR MAHASISWA</p>

        <main class="login-card">
            <h2>LOGIN</h2>

            @if ($errors->any())
                <div class="error-msg">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <input type="text" name="identifier" placeholder="Masukkan NIM/NIP/ID Anda" required autofocus>
                <input type="password" name="password" placeholder="********" required>

                <a href="#" class="forgot-password">Lupa Password?</a>

                <select name="role" required>
                    <option value="" disabled selected>Pilih Role</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                    <option value="admin">Admin</option>
                </select>

                <button type="submit" class="btn-masuk">Masuk</button>
            </form>
        </main>
    </div>
</body>
</html>
