<x-app-layout>

    <div class="container mx-auto px-4 py-6">
        <div x-cloak class="bg-gray-800 rounded-lg shadow-lg">
            <div class="py-4 px-4 text-gray-400 bg-gray-900 rounded-t-lg">
                <h2 class="mb-1 text-white text-lg font-semibold">Dashboard</h2>
                <caption>
                    <h2 class="md:text-justify text-gray-400">
                        Menyajikan data
                        Departemen, Karyawan, Key Performance Indicator
                        dalam bentuk visual seperti grafik, tabel, atau metrik utama
                    </h2>
                </caption>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card Data Departemen -->
                    <div
                        class="bg-gray-900 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border border-transparent hover:border-blue-500 flex flex-col h-full">
                        <h2
                            class="text-md md:text-lg font-semibold bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-purple-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6 text-green-400 group-hover:scale-110 transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                            </svg>
                            Data Departemen
                        </h2>
                        <div class="text-gray-400 mt-4 flex-grow">
                            <p class="flex justify-between text-sm md:text-base">
                                Jumlah Departemen: <span class="font-bold text-cyan-400">{{ $departmentTotal }}</span>
                            </p>
                            <p class="flex justify-between mt-2 text-sm md:text-base">
                                Karyawan Terbanyak: <span
                                    class="font-bold text-green-400">{{ $departmentWithMostEmployees->name }}</span>
                            </p>
                        </div>
                        <a href="{{ route('department.index') }}"
                            class="text-blue-400 hover:text-blue-300 mt-4 inline-block text-sm font-medium">
                            <span class="flex items-center gap-1">
                                Lihat Data
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-200"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <!-- Card Data Karyawan -->
                    <div
                        class="bg-gray-900 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border border-transparent hover:border-blue-500 flex flex-col h-full">
                        <h2
                            class="text-md md:text-lg font-semibold bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-purple-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="size-6 text-red-400 group-hover:scale-110 transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            Data Karyawan
                        </h2>
                        <div class="text-gray-400 mt-4 flex-grow">
                            <p class="flex justify-between text-sm md:text-base">
                                Jumlah Karyawan: <span class="font-bold text-cyan-400">{{ $employeeTotal }}</span>
                            </p>
                            <p class="flex justify-between mt-2 text-sm md:text-base">
                                Karyawan Aktif: <span class="font-bold text-green-400">{{ $employeeActive }}</span>
                            </p>
                            <p class="flex justify-between mt-2 text-sm md:text-base">
                                Karyawan Tidak Aktif: <span
                                    class="font-bold text-red-400">{{ $employeeInactive }}</span>
                            </p>
                        </div>
                        <a href="{{ route('employee.index') }}"
                            class="text-blue-400 hover:text-blue-300 mt-4 inline-block text-sm font-medium">
                            <span class="flex items-center gap-1">
                                Lihat Data
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-200"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <!-- Card Data KPI -->
                    <div
                        class="bg-gray-900 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border border-transparent hover:border-blue-500 flex flex-col h-full">
                        <h2
                            class="text-md md:text-lg font-semibold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="size-6 text-blue-400 group-hover:scale-110 transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                            </svg>
                            Data KPI
                        </h2>
                        <div class="text-gray-400 mt-4 flex-grow">
                            <p class="flex justify-between text-sm md:text-base">
                                KPI Tertinggi: <span class="font-bold text-green-400">90%</span>
                            </p>
                            <p class="flex justify-between mt-2 text-sm md:text-base">
                                KPI Terendah: <span class="font-bold text-red-400">40%</span>
                            </p>
                        </div>
                        <a href="#"
                            class="text-blue-400 hover:text-blue-300 mt-4 inline-block text-sm font-medium">
                            <span class="flex items-center gap-1">
                                Lihat Data
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-200"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Grafik dan Laporan -->
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-300 mb-4">Grafik dan Laporan</h2>
                    <div class="bg-gray-900 rounded-lg shadow p-6">
                        <p class="text-gray-400">Tambahkan grafik atau laporan di sini menggunakan library seperti
                            Chart.js atau ApexCharts.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
