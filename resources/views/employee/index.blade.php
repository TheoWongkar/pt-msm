<x-layouts.app>

    <!-- Success Message -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-green-500 text-white px-4 py-3 rounded-lg mb-4">
            <p class="text-md font-semibold text-center text-gray-800 uppercase">
                {{ session('success') }}
            </p>
        </div>
    @endif

    <div x-cloak class="bg-gray-800 rounded-lg shadow-lg">
        <div class="pt-4 px-4 text-gray-400 bg-gray-900 rounded-t-lg">
            <h2 class="mb-1 text-white text-lg font-semibold">Data Karyawan</h2>
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
            class="px-4 py-4 flex flex-wrap md:flex-nowrap justify-between items-center space-y-2 md:space-y-0 text-gray-800 bg-gray-900 rounded-t-lg">
            <!-- Tombol Tambah Data -->
            <a href="{{ route('employee.create') }}"
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
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            NIK
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Jenis Kelamin
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Departemen
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Jabatan
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Tanggal Masuk
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status Karyawan
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="text-sm">
                    @forelse ($employees as $employee)
                        <tr class="border-b bg-gray-800 border-gray-700 hover:bg-gray-700">
                            <td class="px-6 py-2 text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-2 font-medium text-white whitespace-nowrap">
                                {{ Str::words($employee->name, 3) }}
                            </td>
                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                {{ $employee->nik }}
                            </td>
                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                {{ $employee->gender }}
                            </td>
                            <td class="px-6 py-2 text-center text-white whitespace-nowrap">
                                {{ $employee->department->name }}
                            </td>
                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                {{ $employee->position }}
                            </td>
                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($employee->date_of_birth)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-2 text-center text-xs whitespace-nowrap">
                                @if ($employee->employee_status)
                                    <span class="px-3 py-1 text-white bg-green-500 rounded-full">Aktif</span>
                                @else
                                    <span class="px-3 py-1 text-white bg-red-500 rounded-full">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-2 text-center">
                                <div class="flex justify-center space-x-4">
                                    <!-- Show Button -->
                                    <a href="{{ route('employee.show', $employee->id) }}"
                                        class="font-medium text-blue-600 hover:underline">
                                        Lihat
                                    </a>
                                    <!-- Edit Button -->
                                    <a href="{{ route('employee.edit', $employee->id) }}"
                                        class="font-medium text-yellow-600 hover:underline">
                                        Ubah
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <!-- Hapus Button -->
                                        <button type="submit" class="font-medium text-red-600 hover:underline">
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td colspan="9" class="px-6 py-2 text-center">
                            Data tidak ditemukan.
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4">
            {{ $employees->links() }}
        </div>
    </div>

</x-layouts.app>
