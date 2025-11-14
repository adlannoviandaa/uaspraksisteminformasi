<!-- Pastikan Anda memuat Heroicons atau sejenisnya untuk ikon -->
<aside id="sidebar" class="w-64 fixed h-full bg-white shadow-xl transition-transform duration-300 ease-in-out z-30">
    <div class="flex flex-col h-full">
        <!-- Logo/Header Aplikasi -->
        <div class="p-6 border-b border-gray-100">
            <h1 class="text-2xl font-extrabold text-indigo-700">SITAMA</h1>
            <p class="text-xs text-gray-500 mt-1">Sistem Tugas Akhir</p>
        </div>

        <!-- Menu Navigasi -->
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">

            {{-- --- Menu Untuk Semua Pengguna Terautentikasi --- --}}
            <a href="{{ route(Auth::user()->role . '.dashboard') }}"
               class="sidebar-link {{ request()->routeIs(Auth::user()->role . '.dashboard') ? 'active' : '' }}">
                <!-- Ikon Dashboard: Home -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                <span>Dashboard</span>
            </a>

            {{-- --- Menu KHUSUS ADMIN --- --}}
            @if (Auth::user()->role === 'admin')
                <h3 class="text-xs font-semibold uppercase text-gray-400 pt-4 pb-2">Admin Panel</h3>

                <a href="{{ route('admin.persetujuan-judul') }}"
                   class="sidebar-link {{ request()->routeIs('admin.persetujuan-judul') ? 'active' : '' }}">
                    <!-- Ikon Persetujuan: Check/Clipboard -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM8.707 8.293a1 1 0 00-1.414 1.414l1.414 1.414 3.536-3.536a1 1 0 10-1.414-1.414L8.707 8.293z" clip-rule="evenodd" />
                    </svg>
                    <span>Persetujuan Judul</span>
                </a>

                <a href="{{ route('admin.penetapan-pembimbing2') }}"
                   class="sidebar-link {{ request()->routeIs('admin.penetapan-pembimbing2') ? 'active' : '' }}">
                    <!-- Ikon Penetapan: User Plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Penetapan Pembimbing 2</span>
                </a>

                <a href="{{ route('admin.laporan-ta') }}"
                   class="sidebar-link {{ request()->routeIs('admin.laporan-ta') ? 'active' : '' }}">
                    <!-- Ikon Laporan: Chart Bar -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2h1.259l.836 2.507A2 2 0 007.03 10H15a1 1 0 00.957-1.214l-.94-4.243A1 1 0 0015 3H3zM7.03 10H15a1 1 0 001-1V5a1 1 0 00-1-1H7.03a3 3 0 00-2.68 1.5l-.835 2.507A2 2 0 007.03 10zM10 16a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                    <span>Laporan Global TA</span>
                </a>
            @endif

            {{-- --- Menu KHUSUS DOSEN --- --}}
            @if (Auth::user()->role === 'dosen')
                <h3 class="text-xs font-semibold uppercase text-gray-400 pt-4 pb-2">Dosen Panel</h3>

                <a href="{{ route('dosen.bimbingan') }}"
                   class="sidebar-link {{ request()->routeIs('dosen.bimbingan') ? 'active' : '' }}">
                    <!-- Ikon Bimbingan: Users -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17.58a1 1 0 00.33.24l.41.28c1.16 0 1.96-.34 2.15-.55a.75.75 0 00-.51-1.39l-.49.33c-.22.15-.5.15-.72 0l-1.02-.68a1 1 0 00-1.15.11l-3.23 2.16a1 1 0 000 1.6l.82.55a1 1 0 001.16-.11l3.23-2.16a1 1 0 00.1-.15.75.75 0 00.51 1.39l.49-.33c.19.21.99.55 2.15.55l.41.28a1 1 0 00.33-.24l.43-.3c.19-.13.31-.32.31-.53V10a1 1 0 00-1-1h-1a1 1 0 00-1 1v7.18z" />
                    </svg>
                    <span>Daftar Bimbingan</span>
                </a>

                <a href="{{ route('dosen.penilaian-akhir') }}"
                   class="sidebar-link {{ request()->routeIs('dosen.penilaian-akhir') ? 'active' : '' }}">
                    <!-- Ikon Penilaian: Star -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.817 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.817-2.034a1 1 0 00-1.175 0l-2.817 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span>Penilaian Akhir</span>
                </a>
            @endif

            {{-- --- Menu KHUSUS MAHASISWA --- --}}
            @if (Auth::user()->role === 'mahasiswa')
                <h3 class="text-xs font-semibold uppercase text-gray-400 pt-4 pb-2">Area Mahasiswa</h3>

                <a href="{{ route('mahasiswa.pengajuan-judul') }}"
                   class="sidebar-link {{ request()->routeIs('mahasiswa.pengajuan-judul') ? 'active' : '' }}">
                    <!-- Ikon Judul: Pencil -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-1.414 7.07l-2.828 2.828-.793-.793 2.828-2.828.793.793zM11.5 6.5a1 1 0 100-2 1 1 0 000 2zM6 14a1 1 0 100-2 1 1 0 000 2z" />
                    </svg>
                    <span>Pengajuan Judul</span>
                </a>

                <a href="{{ route('mahasiswa.log-bimbingan') }}"
                   class="sidebar-link {{ request()->routeIs('mahasiswa.log-bimbingan') ? 'active' : '' }}">
                    <!-- Ikon Log: Document -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 1a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V6a1 1 0 00-1-1H6z" clip-rule="evenodd" />
                    </svg>
                    <span>Log Bimbingan</span>
                </a>
            @endif

        </nav>

        <!-- Footer Sidebar (Logout) -->
        <div class="p-4 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link w-full justify-start text-red-600 hover:bg-red-100 hover:text-red-700">
                    <!-- Ikon Logout: Arrow Right on Square -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h8a1 1 0 001-1v-2a1 1 0 00-2 0v1H4V4h7v1a1 1 0 102 0V4a1 1 0 00-1-1H3z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M17 10a1 1 0 00-1-1h-4a1 1 0 100 2h4a1 1 0 001-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
