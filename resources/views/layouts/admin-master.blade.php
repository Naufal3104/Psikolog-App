@php
// Definisi Warna Kustom RSUD Jombang (Konsisten dengan Soft UI)
$rsud_blue_dark = '#044f86'; // Biru Utama Baru
$rsud_blue_light = '#346b9b'; // Biru Hover/Aktif
$sidebar_bg = '#ffffff'; // Sidebar PUTIH

// Variabel untuk menandai menu yang aktif (AKAN DIISI DARI VIEW ANAK)
$active_menu = $active_menu ?? 'dashboard'; 
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') | RSUD Jombang</title> 
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        // ... (Tailwind Config yang sama) ...
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'rsud-blue': '{{ $rsud_blue_dark }}',
                        'rsud-blue-light': '{{ $rsud_blue_light }}',
                        'sidebar-dark': '{{ $sidebar_bg }}',
                    }
                }
            }
        }
    </script>
    
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        /* CSS Kustom (Sama seperti sebelumnya) */
        .sidebar { transition: width 0.3s ease; }
        .sidebar-closed { width: 80px !important; }
        .sidebar-closed .sidebar-menu a span, .sidebar-closed .sidebar-menu h3, .sidebar-closed h3 { 
            opacity: 0; visibility: hidden; width: 0; white-space: nowrap; transition: opacity 0.1s, visibility 0.1s, width 0.1s;
        }
        .sidebar-closed .sidebar-menu a { justify-content: center; }
        .sidebar-closed .sidebar-menu a svg { margin-right: 0 !important; }
        .sidebar-menu a.active { 
            background-color: {{ $rsud_blue_light }} !important; 
            color: white !important;
        }
        .sidebar-menu a:not(.active) { 
            color: {{ $rsud_blue_dark }} !important;
        }
        .sidebar-menu a:not(.active):hover {
            background-color: #f3f4f6;
            color: {{ $rsud_blue_dark }} !important;
        }
        .admin-card { @apply bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100; }
        .admin-input { @apply w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rsud-blue focus:border-rsud-blue transition duration-150; }
    </style>
</head>
<body class="bg-gray-50">

    <header class="sticky top-0 z-10 flex items-center justify-between px-8 py-3 bg-white shadow-md border-b border-gray-100">
        <div class="flex items-center">
            <button id="sidebarToggle" class="mr-6 text-rsud-blue transition duration-150 ease-in-out hover:text-rsud-blue-light focus:outline-none">
                <i data-feather="menu" class="w-6 h-6"></i>
            </button>
            <h1 class="text-xl font-bold text-rsud-blue">RSUD Jombang - Admin</h1>
        </div>
        
        <div class="relative dropdown" id="adminMenuDropdown">
            <button id="adminMenuToggle" class="flex items-center text-rsud-blue transition duration-150 ease-in-out hover:text-rsud-blue-light focus:outline-none">
                <i data-feather="user" class="w-6 h-6 mr-2"></i> 
                <span class="text-sm font-semibold">Admin Utama</span>
                <i data-feather="chevron-down" class="w-4 h-4 ml-2"></i>
            </button>
            <div class="absolute right-0 mt-3 overflow-hidden bg-white rounded-lg shadow-xl dropdown-menu w-40" id="dropdownMenu" style="display: none;">
                <a href="{{ url('/admin/profile/edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit Profile</a> 
                <a href="{{ url('/logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Log Out</a>
            </div>
        </div>
    </header>

    <div class="flex min-h-screen">
        <nav id="sidebar" class="sticky top-0 h-screen w-64 bg-white text-rsud-blue shadow-lg pt-8 border-r border-gray-100 transition-all duration-300">
            <h3 class="px-6 pb-4 mb-4 text-xs font-semibold uppercase text-gray-500 border-b border-gray-200 transition-all duration-300">Menu Navigasi</h3>
            
            <div class="sidebar-menu">
                {{-- 1. Dashboard --}}
                <a href="{{ url('/dashboard-dummy') }}" class="flex items-center px-6 py-3 transition duration-150 ease-in-out text-rsud-blue hover:text-rsud-blue @if($active_menu == 'dashboard') active @endif">
                    <i data-feather="home" class="w-5 h-5 mr-3"></i> <span>Dashboard</span>
                </a>

                <h3 class="px-6 pt-6 pb-2 text-xs font-semibold uppercase text-gray-500 transition-all duration-300">MANAJEMEN KONTEN</h3>
                {{-- 2. Buat Artikel --}}
                <a href="{{ url('/buat-artikel') }}" class="flex items-center px-6 py-3 text-rsud-blue hover:text-rsud-blue @if($active_menu == 'buat_artikel') active @endif">
                    <i data-feather="file-plus" class="w-5 h-5 mr-3"></i> <span>Buat Artikel</span>
                </a>
                {{-- 3. Kelola Artikel --}}
                <a href="{{ url('/kelola-artikel') }}" class="flex items-center px-6 py-3 text-rsud-blue hover:text-rsud-blue @if($active_menu == 'kelola_artikel') active @endif">
                    <i data-feather="list" class="w-5 h-5 mr-3"></i> <span>Kelola Artikel</span>
                </a>

                <h3 class="px-6 pt-6 pb-2 text-xs font-semibold uppercase text-gray-500 transition-all duration-300">PENGATURAN</h3>
                {{-- 4. Manajemen Admin --}}
                <a href="{{ url('/edit-profile') }}" class="flex items-center px-6 py-3 text-rsud-blue hover:text-rsud-blue @if($active_menu == 'manajemen_admin') active @endif">
                    <i data-feather="users" class="w-5 h-5 mr-3"></i> <span>Manajemen Admin</span>
                </a>
            </div>
        </nav>

        <main class="flex-grow p-8">
            @yield('content')
        </main>
    </div>

    {{-- START: FOOTER SEDERHANA BARU --}}
    <footer class="w-full bg-white border-t border-gray-200 p-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} RSUD Jombang. Dikelola oleh Tim IT RSUD Jombang.
    </footer>
    {{-- END: FOOTER SEDERHANA BARU --}}

    <script>
        feather.replace();

        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('sidebar-closed');
        });
        
        document.getElementById('adminMenuToggle').addEventListener('click', function() {
            var dropdown = document.getElementById('dropdownMenu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function(event) {
            var dropdownContainer = document.getElementById('adminMenuDropdown');
            var isToggle = document.getElementById('adminMenuToggle').contains(event.target);

            if (!dropdownContainer.contains(event.target) && !isToggle) {
                document.getElementById('dropdownMenu').style.display = 'none';
            }
        });
    </script>
</body>
</html>