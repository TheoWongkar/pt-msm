<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        PT. MSM/TTN
        @isset($title)
            | {{ $title }}
        @endisset
    </title>

    <link rel="icon" href="img/msm-logo.svg" type="image/x-icon">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</head>

<body class="font-sans bg-gray-300">

    <div x-data="{ sidebar: window.innerWidth >= 1024, openSubmenu: false }" @resize.window="sidebar = window.innerWidth >= 1024"
        class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside x-cloak :class="sidebar ? 'w-60 md:w-80' : 'w-16 md:w-20'"
            class="bg-gray-900 transition-all duration-300 h-full overflow-y-scroll px-4 py-3 shadow-r-xl fixed md:relative z-20">
            <!-- Hamburger Button -->
            <div class="flex justify-center">
                <button @click="sidebar = !sidebar; openSubmenu = false"
                    class="text-gray-200 p-2 focus:outline-none bg-gray-800 hover:bg-gray-700 rounded-md shadow-md transition duration-300 transform hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                </button>
            </div>
            <hr class="flex w-full border-t border-gray-700 my-3">
            <!-- Sidebar Content -->
            <div class="space-y-4 text-gray-400 mt-2">
                <div class="flex items-center space-x-4">
                    <img src="img/msm-logo.svg" alt="Logo" class="w-12 h-12">
                    <div>
                        <h2 x-show="sidebar" class="text-lg font-semibold text-gray-200">PT.MSM/TTN</h2>
                        <h2 x-show="sidebar" class="text-xs">Sistem Informasi Karyawan</h2>
                    </div>
                </div>
                <ul>
                    <li><span x-show="sidebar" class="ml-3 text-sm text-gray-500">MENU</span></li>
                    <li>
                        <a href="#" :class="sidebar ? 'py-2 px-4' : 'p-1'"
                            class="flex items-center hover:bg-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span x-show="sidebar" class="ml-3">Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('department.index') }}" :class="sidebar ? 'py-2 px-4' : 'p-1'"
                            class="flex items-center hover:bg-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                            </svg>
                            <span x-show="sidebar" class="ml-3">Departemen</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" :class="sidebar ? 'py-2 px-4' : 'p-1'"
                            class="flex items-center hover:bg-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            <span x-show="sidebar" class="ml-3">Data Karyawan</span>
                        </a>
                    </li>
                    <li x-data="{ open: false }">
                        <!-- Menu Indikator Kinerja -->
                        <button @click="openSubmenu = !openSubmenu; sidebar = true"
                            :class="sidebar ? 'py-2 px-4' : 'p-1'"
                            class="flex items-center w-full hover:bg-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125-1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                            </svg>
                            <span x-show="sidebar" class="ml-3">Indikator Kinerja</span>
                            <svg x-show="sidebar" xmlns="http://www.w3.org/2000/svg" class="ml-auto w-4 h-4 transform"
                                :class="openSubmenu ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                            </svg>
                        </button>
                        <!-- Submenu -->
                        <ul x-show="openSubmenu" x-transition class="ml-6 space-y-2">
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-700 rounded-md">Data
                                    KPI</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-700 rounded-md">Total
                                    KPI</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li><span x-show="sidebar" class="ml-3 text-sm text-gray-500">DATA SAYA</span></li>
                    <li>
                        <a href="#" :class="sidebar ? 'py-2 px-4' : 'p-1'"
                            class="flex items-center hover:bg-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                            </svg>
                            <span x-show="sidebar" class="ml-3">Biodata</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" :class="sidebar ? 'py-2 px-4' : 'p-1'"
                            class="flex items-center hover:bg-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125-1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                            </svg>
                            <span x-show="sidebar" class="ml-3">Kinerja Saya</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" :class="sidebar ? 'py-2 px-4 w-full' : 'p-1'"
                                class="inline-flex items-center hover:bg-gray-700 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                                <span x-show="sidebar" class="ml-3">Keluar</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-16 md:ml-0 overflow-auto w-full">
            <!-- Header -->
            <header
                class="bg-gray-900 text-gray-400 py-3 px-4 flex items-center justify-between flex-wrap border-b border-gray-500 shadow-lg">
                <div class="flex items-center space-x-6 lg:mb-0">
                    <!-- Guide Button -->
                    <a href="#"
                        class="text-gray-200 hover:text-blue-200 p-2 rounded-full bg-gray-800 hover:bg-gray-700 transition duration-300 transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </a>
                </div>
                <div class="flex items-center space-x-3">
                    <!-- Notification Button -->
                    <a href="#"
                        class="text-gray-200 hover:text-red-200 p-2 rounded-full bg-gray-800 hover:bg-gray-700 transition duration-300 transform hover:scale-110 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                        </svg>
                        <span
                            class="absolute top-0 right-0 bg-red-500 text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                    </a>
                    <!-- Calendar Button -->
                    <a href="#"
                        class="text-gray-200 hover:text-yellow-200 p-2 rounded-full bg-gray-800 hover:bg-gray-700 transition duration-300 transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                    </a>

                    <div x-data="{ open: false }" class="flex items-center space-x-2 pl-4 cursor-pointer"
                        @click="open = !open">
                        <!-- User Info -->
                        <div class="hidden lg:block text-right leading-4">
                            <span class="font-semibold text-gray-200">{{ auth()->user()->name }}</span><br>
                            <span class="text-sm text-gray-400">{{ auth()->user()->employee->position }}</span>
                        </div>
                        <!-- Profile Photo -->
                        <div class="relative">
                            <img src="https://placehold.co/400" alt="Profile"
                                class="w-10 h-10 rounded-full border-2 border-blue-200 transition duration-300 transform hover:scale-110">
                            <!-- Dropdown Menu -->
                            <div x-cloak x-show="open" x-transition
                                class="absolute right-0 mt-3 w-48 bg-gray-900 border border-gray-700 rounded-lg shadow-lg z-50">
                                <div class="px-4 py-2">
                                    <p class="font-semibold text-gray-200">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-gray-400">{{ auth()->user()->employee->position }}</p>
                                </div>
                                <div class="border-t border-gray-700">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white">
                                        Profile
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white">
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Dropdown Toggle -->
                        <div class="inline-flex items-center">
                            <!-- Down Arrow -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-300" x-cloak
                                x-show="!open" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                            <!-- Up Arrow -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-300" x-cloak
                                x-show="open" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Body Content -->
            <div class="p-4">
                {{ $slot }}
            </div>
        </main>
    </div>


</body>

</html>
