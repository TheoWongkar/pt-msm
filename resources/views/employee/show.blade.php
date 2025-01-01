<x-app-layout>

    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between pb-4 border-b border-gray-700">
            <h2 class="text-white text-lg font-semibold mb-2 md:mb-0">Detail Karyawan</h2>
            <a href="{{ route('employee.index') }}" class="text-blue-500 hover:underline">Kembali ke Daftar</a>
        </div>

        <!-- Main Content -->
        <div class="mt-6">
            <!-- Profile Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Left Section: Profile Picture and Basic Info -->
                <div class="flex items-start space-x-6">
                    <!-- Profile Picture -->
                    <div class="w-24 h-24 md:w-32 md:h-32 flex-shrink-0">
                        @if ($employee->profile_picture)
                            <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="{{ $employee->name }}"
                                class="w-full h-full rounded-full object-cover">
                        @else
                            <div
                                class="w-full h-full rounded-full bg-gray-700 flex items-center justify-center text-gray-400">
                                Tidak Ada Foto
                            </div>
                        @endif
                    </div>

                    <!-- Basic Info -->
                    <div class="flex flex-col">
                        <h3 class="text-xl font-semibold text-white">{{ $employee->name }}</h3>
                        <p class="text-gray-400">{{ $employee->position }}</p>
                        <p class="text-gray-400">{{ $employee->department->name }}</p>
                    </div>
                </div>

                <!-- Right Section: Account Info -->
                <div class="flex flex-col bg-gray-700 rounded-lg p-4 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Email:</span>
                        <span class="text-gray-200">{{ $employee->user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Username:</span>
                        <span class="text-gray-200">{{ $employee->user->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Role:</span>
                        <span class="text-gray-200">{{ $employee->user->role }}</span>
                    </div>
                </div>
            </div>

            <!-- Detail Table -->
            <div class="overflow-hidden bg-gray-700 rounded-lg">
                <table class="w-full text-sm text-left text-gray-400">
                    <tbody>
                        <tr class="border-b border-gray-600">
                            <th class="px-4 py-2 md:px-6 md:py-3 text-white">Nama Lengkap</th>
                            <td class="px-4 py-2 md:px-6 md:py-3">{{ $employee->name }}</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <th class="px-4 py-2 md:px-6 md:py-3 text-white">NIK</th>
                            <td class="px-4 py-2 md:px-6 md:py-3">{{ $employee->nik }}</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <th class="px-4 py-2 md:px-6 md:py-3 text-white">No. Telepon</th>
                            <td class="px-4 py-2 md:px-6 md:py-3">{{ $employee->phone }}</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <th class="px-4 py-2 md:px-6 md:py-3 text-white">Alamat</th>
                            <td class="px-4 py-2 md:px-6 md:py-3">{{ $employee->address }}</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <th class="px-4 py-2 md:px-6 md:py-3 text-white">Tanggal Lahir</th>
                            <td class="px-4 py-2 md:px-6 md:py-3">
                                {{ \Carbon\Carbon::parse($employee->date_of_birth)->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <th class="px-4 py-2 md:px-6 md:py-3 text-white">Jenis Kelamin</th>
                            <td class="px-4 py-2 md:px-6 md:py-3">{{ $employee->gender }}</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <th class="px-4 py-2 md:px-6 md:py-3 text-white">Departemen</th>
                            <td class="px-4 py-2 md:px-6 md:py-3">{{ $employee->department->name }}</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <th class="px-4 py-2 md:px-6 md:py-3 text-white">Jabatan</th>
                            <td class="px-4 py-2 md:px-6 md:py-3">{{ $employee->position }}</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <th class="px-4 py-2 md:px-6 md:py-3 text-white">Tanggal Masuk</th>
                            <td class="px-4 py-2 md:px-6 md:py-3">
                                {{ \Carbon\Carbon::parse($employee->date_of_entry)->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 md:px-6 md:py-3 text-white">Status Karyawan</th>
                            <td class="px-4 py-2 md:px-6 md:py-3 text-xs font-thin">
                                @if ($employee->deleted_at)
                                    <span class="px-2 py-1 text-white bg-red-500 rounded-full">Tidak Aktif</span>
                                @else
                                    <span class="px-2 py-1 text-white bg-green-500 rounded-full">Aktif</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
