<x-app-layout>

    <div class="bg-gray-800 rounded-lg shadow-lg">
        <div class="py-4 px-4 text-gray-400 bg-gray-900 rounded-t-lg">
            <h2 class="mb-1 text-white text-lg font-semibold">Data Karyawan</h2>
            <caption>
                <h2 class="md:text-justify">
                    kumpulan informasi terkait individu yang bekerja di sebuah organisasi atau perusahaan. Data ini
                    biasanya digunakan untuk keperluan administratif, manajemen, atau analisis sumber daya manusia
                    (SDM).
                </h2>
            </caption>
        </div>

        <!-- Form -->
        <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data"
            class="p-5">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-400">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $employee->name) }}"
                            class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- No. Telepon -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-400">No. Telepon</label>
                        <input type="number" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}"
                            class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('phone')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-400">Jenis Kelamin</label>
                        <select id="gender" name="gender"
                            class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Pria" {{ old('gender', $employee->gender) == 'Pria' ? 'selected' : '' }}>
                                Pria</option>
                            <option value="Wanita" {{ old('gender', $employee->gender) == 'Wanita' ? 'selected' : '' }}>
                                Wanita</option>
                        </select>
                        @error('gender')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-400">Alamat</label>
                        <textarea id="address" name="address" rows="3"
                            class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500">{{ old('address', $employee->address) }}</textarea>
                        @error('address')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-400">Tanggal Lahir</label>
                        <input type="date" id="date_of_birth" name="date_of_birth"
                            class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('date_of_birth', $employee->date_of_birth) }}">
                        @error('date_of_birth')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Foto Profil -->
                    <div x-data="{
                        previewUrl: '{{ old('profile_picture', $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : '') }}',
                        isImageChanged: false,
                        isReset: false
                    }" class="space-y-4">
                        <!-- Label -->
                        <label for="profile_picture" class="block text-sm font-medium text-gray-200">Edit Foto
                            Profil</label>

                        <!-- Input File -->
                        <input type="file" id="profile_picture" name="profile_picture"
                            x-on:change="
                            previewUrl = URL.createObjectURL($event.target.files[0]); 
                            isImageChanged = true;
                            isReset = false;
                            "
                            class="block w-full text-sm text-gray-200 bg-gray-800 border border-gray-600 rounded-md cursor-pointer file:bg-gray-700 file:border-none file:rounded-md file:px-4 file:py-2 file:text-sm file:font-medium file:text-gray-200 hover:file:bg-gray-600">

                        <!-- Hidden Input for Reset -->
                        <input type="hidden" name="reset_profile_picture" :value="isReset ? 'true' : 'false'">

                        <!-- Error Message -->
                        @error('profile_picture')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror

                        <!-- Area Preview -->
                        <div class="relative group">
                            <!-- Preview Image -->
                            <div x-show="previewUrl" class="w-32 h-32 border border-gray-600 overflow-hidden">
                                <img :src="previewUrl" alt="Preview Gambar"
                                    class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                            </div>

                            <!-- Placeholder -->
                            <div x-show="!previewUrl"
                                class="w-32 h-32 border-2 border-dashed border-gray-400 flex items-center justify-center">
                                <span class="text-sm text-gray-400">Preview Gambar</span>
                            </div>
                        </div>

                        <!-- Button Actions -->
                        <div class="flex items-center space-x-4">
                            <!-- Reset Button -->
                            <button type="button"
                                x-on:click="
                                previewUrl = '';
                                isImageChanged = false;
                                isReset = true;
                                "
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-400">NIK</label>
                        <input type="number" id="nik" name="nik"
                            class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('nik', $employee->nik) }}" required>
                        @error('nik')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tanggal Masuk -->
                    <div>
                        <label for="date_of_entry" class="block text-sm font-medium text-gray-400">Tanggal Masuk</label>
                        <input type="date" id="date_of_entry" name="date_of_entry"
                            class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('date_of_entry', $employee->date_of_entry) }}">
                        @error('date_of_entry')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-400">Jabatan</label>
                        <input type="text" id="position" name="position"
                            class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('position', $employee->position) }}">
                        @error('position')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Departemen -->
                    <div>
                        <label for="department_id" class="block text-sm font-medium text-gray-400">Departemen</label>
                        <select id="department_id" name="department_id"
                            class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                            @forelse ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @empty
                                <option value="">Belum ada departemen</option>
                            @endforelse
                        </select>
                        @error('department_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status Karyawan -->
                    <div>
                        <label for="employee_status" class="block text-sm font-medium text-gray-400">Status
                            Karyawan</label>
                        <select id="employee_status" name="employee_status"
                            class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                            <option value="1"
                                {{ old('employee_status', $employee->trashed() ? '0' : '1') == '1' ? 'selected' : '' }}>
                                Aktif</option>
                            <option value="0"
                                {{ old('employee_status', $employee->trashed() ? '0' : '1') == '0' ? 'selected' : '' }}>
                                Tidak Aktif</option>
                        </select>
                        @error('employee_status')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data User Login -->
            <div class="mt-6 border-t border-gray-600 pt-6">
                <h3 class="text-lg text-white">Data User Login</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <!-- Username -->
                        <div>
                            <label for="user_name" class="block text-sm font-medium text-gray-400">Username</label>
                            <input type="text" id="user_name" name="user_name"
                                class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('user_name', $employee->user->name) }}" required>
                            @error('user_name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Role Karyawan -->
                        <div>
                            <label for="user_role" class="block text-sm font-medium text-gray-400">Role
                                Karyawan</label>
                            <select id="user_role" name="user_role"
                                class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                                <option value="user" {{ $employee->user->role == 'user' ? 'selected' : '' }}>User
                                </option>
                                <option value="admin" {{ $employee->user->role == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="operator" {{ $employee->user->role == 'operator' ? 'selected' : '' }}>
                                    Operator</option>
                            </select>
                            @error('user_role')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <!-- Email -->
                        <div>
                            <label for="user_email" class="block text-sm font-medium text-gray-400">Email</label>
                            <input type="email" id="user_email" name="user_email"
                                class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('user_email', $employee->user->email) }}" required>
                            @error('user_email')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="user_password"
                                class="block text-sm font-medium text-gray-400">Password</label>
                            <input type="password" id="user_password" name="user_password"
                                class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                            @error('user_password')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Confirm -->
                        <div>
                            <label for="user_password_confirmation"
                                class="block text-sm font-medium text-gray-400">Konfirmasi Password</label>
                            <input type="password" id="user_password_confirmation" name="user_password_confirmation"
                                class="mt-1 w-full p-2 rounded-lg bg-gray-700 border-gray-600 text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                            @error('user_password_confirmation')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 text-right">
                <a href="{{ route('employee.index') }}" type="submit"
                    class="inline-block px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengubah data?')"
                    class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
