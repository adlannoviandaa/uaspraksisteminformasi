<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... head content ... -->
    <title>SITAMA | @yield('title')</title>
    <!-- Pastikan Anda memuat Tailwind, misalnya melalui Vite: -->
    @vite('resources/css/app.css')
    <!-- Atau melalui CDN jika ini hanya contoh development -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body class="bg-gray-100">
    <!-- Sidebar: Lebar 64px, z-30 -->
    @include('layouts.sidebar')

    <!-- Main Content Area: Padding kiri sebesar lebar sidebar, yaitu 64px -->
    <main class="ml-64 p-0 min-h-screen">
        @yield('content')
    </main>
</body>
</html>
