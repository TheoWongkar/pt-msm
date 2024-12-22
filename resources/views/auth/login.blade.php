<x-layouts.guest>

    <div class="bg-gray-900 flex items-center justify-center min-h-screen px-4 sm:px-0">
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-md p-6">
            <!-- Logo -->
            <img src="img/msm-logo.svg" alt="logo msm" class="mx-auto h-16 md:h-20 mb-1">

            <!-- Text -->
            <h3 class="text-md font-semibold text-center text-gray-400">Sistem Informasi Karyawan</h3>
            <h2 class="text-xl font-semibold text-center text-gray-200 my-1">PT. Meares Soputan Mining</h2>
            <p class="text-sm text-center text-gray-400 mb-6">Silakan masuk ke akun Anda</p>

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:ring focus:ring-blue-500">
                    <!-- Pesan Error -->
                    @error('message')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-300 focus:outline-none focus:ring focus:ring-blue-500">
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="flex flex-col sm:flex-row items-center justify-between mb-4">
                    <label class="flex items-center text-sm text-gray-300 mb-2 sm:mb-0">
                        <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-500 rounded">
                        <span class="ml-2">Ingat saya</span>
                    </label>
                    <a href="{{ route('login') }}" class="text-sm text-blue-400 hover:underline">Lupa
                        password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500">
                    Masuk
                </button>
            </form>
        </div>
    </div>

</x-layouts.guest>
