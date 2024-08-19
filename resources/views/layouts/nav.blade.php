<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function toggleDropdown() {
            var dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }
    </script>
    <style>
        .active {
            font-weight: bold;
            color: #818CF8;
        }
        .navbar-text:hover {
            color: #818CF8;
        }
    </style>
</head>
<body class="h-screen font-sans bg-white-100">

<header class="bg-slate-700/25 backdrop-blur-md shadow-md">
    <div class="max-w-8xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <div class="flex  items-center">
                    <a class=" text-indigo-400 no-underline hover:no-underline font-bold text-xl" href="#">
                        Manajemen<span class="mr-2"></span><span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">Sekolah</span>
                      </a>
                </div>
                <nav class="hidden md:flex space-x-4 ml-10 text-white">
                    <a href="{{ route('dashboard.index') }}" class="navbar-text {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">Beranda</a>
                    <a href="{{ route('siswa.index') }}" class="navbar-text {{ request()->routeIs('siswa.index') || request()->routeIs('siswa.create') || request()->routeIs('siswa.edit') ? 'active' : '' }}">Data Siswa</a>
                    <a href="{{ route('guru.index') }}" class="navbar-text {{ request()->routeIs('guru.index') ? 'active' : '' }}">Data Guru</a>
                    <a href="{{ route('kelas.index') }}" class="navbar-text {{ request()->routeIs('kelas.index') || request()->routeIs('kelas.create') || request()->routeIs('kelas.edit') ? 'active' : '' }}">Data Kelas</a>
                    <a href="{{ route('jurusan.index') }}" class="navbar-text {{ request()->routeIs('jurusan.index') || request()->routeIs('jurusan.create') || request()->routeIs('jurusan.edit') ? 'active' : '' }}">Data Jurusan</a>
                    <a href="{{ route('organisasi.index') }}" class="navbar-text {{ request()->routeIs('organisasi.index') || request()->routeIs('organisasi.create') || request()->routeIs('organisasi.edit') ? 'active' : '' }}">Data Organisasi</a>
                    <a href="{{ route('ekskul.index') }}" class="navbar-text {{ request()->routeIs('ekskul.index') || request()->routeIs('ekskul.create') || request()->routeIs('ekskul.edit') ? 'active' : '' }}">Data Ekstrakurikuler</a>
                    <a href="{{ route('mapel.index') }}" class="navbar-text {{ request()->routeIs('mapel.index') || request()->routeIs('mapel.create') || request()->routeIs('mapel.edit') ? 'active' : '' }}">Data Mapel</a>
                </nav>
            </div>
            <div class="relative">
                <button id="user-menu-button" class="flex items-center text-sm font-medium navbar-text hover:text-white focus:outline-none" onclick="toggleDropdown()">
                    {{ Auth::user()->name }}
                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2 text-sm navbar-text hover:bg-white-100" role="menuitem">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

</body>
</html>
