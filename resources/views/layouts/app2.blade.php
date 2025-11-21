{{-- resources/views/layout/app2.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SITAMA')</title>

    <!-- Load Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-100">

    <div class="flex h-screen">

        {{-- Sidebar baru --}}
        @include('components.sidebar2')

        {{-- Konten utama --}}
        <div class="flex-1 p-10">
            @yield('content')
        </div>

    </div>

</body>
</html>
