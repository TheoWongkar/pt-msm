<x-layouts.app>

    <div x-cloak class="bg-gray-800 rounded-lg shadow-lg">
        <div class="pt-4 px-4 text-gray-400">
            <h2 class="mb-1 text-white text-lg font-semibold">Departemen</h2>
            <caption>
                <h2 class="md:text-justify">
                    Bagian atau unit organisasi yang memiliki tanggung jawab dan tugas khusus untuk mendukung
                    operasional dan pencapaian tujuan perusahaan. Setiap departemen biasanya memiliki fungsi tertentu
                    yang berfokus pada area spesifik, dan masing-masing berperan penting dalam kelancaran perusahaan
                    secara keseluruhan.
                </h2>
            </caption>
        </div>

        <div
            class="px-4 py-4 flex flex-wrap md:flex-nowrap justify-between items-center space-y-2 md:space-y-0 text-gray-800">
            <!-- Tombol Tambah Data -->
            <a href="#"
                class="h-10 py-2 px-5 w-full md:w-auto bg-green-500 rounded-lg hover:bg-green-600 flex items-center justify-center space-x-1">
                <span class="text-md font-semibold">Tambah Data</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                        clip-rule="evenodd" />
                </svg>
            </a>

            <!-- Form Pencarian -->
            <form method="GET" action="#" class="flex items-center w-full md:w-auto">
                <!-- Container Input dan Button -->
                <div
                    class="flex w-full md:w-auto rounded-lg border border-gray-600 focus-within:ring-2 focus-within:ring-blue-300 focus-within:border-blue-500">
                    <!-- Input Field -->
                    <input type="text" name="search"
                        class="h-10 px-3 rounded-l-lg bg-gray-700 text-white placeholder-gray-400 flex-grow md:w-56 focus:outline-none"
                        placeholder="Cari Departemen..." autocomplete="off" value="{{ request()->get('search') }}">

                    <!-- Button -->
                    <button type="submit"
                        class="h-10 p-2 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 flex items-center justify-center">
                        <!-- SVG Search Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>


        <div class="overflow-x-auto bg-gray-700">
            <table class="w-full table-auto text-gray-400">
                <thead class="text-xs uppercase bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Nama Departemen
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Warna
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Karyawan Aktif
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="text-sm">
                    @foreach ($departments as $department)
                        <tr class="border-b bg-gray-800 border-gray-700 hover:bg-gray-700">
                            <td class="px-6 py-2 text-center">
                                {{ $department->id }}
                            </td>
                            <td class="px-6 py-2 font-medium text-white">
                                {{ $department->name }}
                            </td>
                            <td class="px-6 py-2 text-center">
                                <span class="inline-block size-4 rounded-full"
                                    style="background-color: {{ $department->color }};">
                                </span>
                            </td>
                            <td class="px-6 py-2 text-center">
                                {{ $department->employees_count }}
                            </td>
                            <td class="px-6 py-2 text-center">
                                <div class="flex justify-center space-x-4">
                                    <!-- Edit Button -->
                                    <a href="#"
                                        class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">
                                        Ubah
                                    </a>

                                    <!-- Hapus Button -->
                                    <button type="button"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline flex items-center space-x-1">
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4">
            {{ $departments->links() }}
        </div>
    </div>

</x-layouts.app>
