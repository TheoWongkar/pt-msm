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

    <link rel="icon" href="{{ asset('img/msm-logo.png') }}" type="image/x-icon">

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
        @include('layouts.navigation')

        <!-- Main Content -->
        <main class="ml-16 md:ml-0 overflow-auto w-full">
            <!-- Header -->
            <header
                class="bg-gray-900 text-gray-400 py-3 px-4 flex items-center justify-between flex-wrap border-b border-gray-500 shadow-lg">
                <div class="flex items-center space-x-6 lg:mb-0">
                    <!-- Guide Button -->
                    <a href="#"
                        class="text-gray-200 hover:text-blue-200 p-2 rounded-full bg-gray-800 hover:bg-gray-700 transition duration-300 transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </a>
                </div>
                <div class="flex items-center space-x-3">
                    <!-- Notification Button -->
                    <a href="#"
                        class="text-gray-200 hover:text-red-200 p-2 rounded-full bg-gray-800 hover:bg-gray-700 transition duration-300 transform hover:scale-110 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                        </svg>
                        <span
                            class="absolute top-0 right-0 bg-red-500 text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                    </a>
                    <!-- Calendar Button -->
                    <a href="#"
                        class="text-gray-200 hover:text-yellow-200 p-2 rounded-full bg-gray-800 hover:bg-gray-700 transition duration-300 transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
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
