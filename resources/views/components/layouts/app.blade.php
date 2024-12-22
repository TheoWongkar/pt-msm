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
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
</head>

<body>

    <div class="flex h-screen" x-data="{ sidebarOpen: false }">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-gray-800 shadow-lg z-20 transform transition-transform duration-200 ease-in-out md:translate-x-0"
            :class="{ '-translate-x-full': !sidebarOpen }">
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-xl font-semibold">Dashboard</h1>
            </div>
            <nav class="mt-4">
                <ul>
                    <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Home</a></li>
                    <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Profile</a></li>
                    <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Settings</a></li>
                    <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Logout</a></li>
                </ul>
            </nav>
        </div>

        <!-- Backdrop for mobile -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-10 md:hidden" x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="sidebarOpen = false">
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-64">
            <!-- Header -->
            <header class="bg-gray-800 shadow-lg px-4 py-4 md:px-6 flex justify-between items-center">
                <button class="md:hidden text-gray-400 hover:text-gray-200" @click="sidebarOpen = true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h2 class="text-lg font-semibold">Dashboard</h2>
                <div class="text-gray-400">User</div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 md:p-6">
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold">Welcome!</h3>
                    <p class="mt-2 text-gray-400">This is your dashboard. Customize it as needed.</p>
                </div>
            </main>
        </div>
    </div>

</body>

</html>
