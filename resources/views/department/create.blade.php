<x-app-layout>

    <div x-cloak class="bg-gray-800 rounded-lg shadow-lg">
        <div class="py-4 px-4 text-gray-400 bg-gray-900 rounded-t-lg">
            <h2 class="mb-1 text-white text-lg font-semibold">Tambah Data Departemen</h2>
            <caption>
                <h2 class="md:text-justify">
                    Isi form di bawah untuk menambahkan data departemen baru ke dalam sistem. Pastikan semua data diisi
                    dengan benar agar informasi yang disimpan akurat.
                </h2>
            </caption>
        </div>

        <form action="{{ route('department.store') }}" method="POST" class="px-4 py-4 space-y-4">
            @csrf

            <!-- Input Nama Departemen -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Nama Departemen</label>
                <input type="text" id="name" name="name" required
                    class="h-10 px-3 w-full rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500"
                    placeholder="Masukkan nama departemen" value="{{ old('name') }}">
                @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input Warna Departemen -->
            <div>
                <label for="color" class="block text-sm font-medium text-gray-300">Warna (Pilih Warna)</label>
                <div class="flex items-center space-x-2">
                    <input type="color" id="color" name="color" required
                        class="h-10 w-16 rounded-lg border border-gray-600 bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500"
                        value="{{ old('color', '#000000') }}">
                    <span class="text-gray-400">Pilih warna untuk departemen</span>
                </div>
                @error('color')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="flex flex-col sm:flex-row justify-end sm:space-x-2 space-y-2 sm:space-y-0">
                <a href="{{ route('department.index') }}"
                    class="h-10 py-2 px-5 bg-gray-500 rounded-lg text-white hover:bg-gray-600 flex items-center justify-center">
                    Batal
                </a>
                <button type="submit"
                    class="h-10 py-2 px-5 bg-blue-500 rounded-lg text-white hover:bg-blue-600 flex items-center justify-center">
                    Simpan
                </button>
            </div>
        </form>

    </div>


</x-app-layout>
