@extends('layouts.guest')

@section('content')
    <!-- Logo -->
    <div class="text-center mb-8">
        <div class="flex justify-center mb-6">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center mr-2" style="background-color: #006C5F;">
                    <i class='bx bx-map text-white text-xl'></i>
                </div>
                <span class="text-2xl font-bold" style="color: #006C5F;">Embiz</span>
            </div>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome To Embiz</h1>
        <p class="text-gray-600">Login to your founders dashboard</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="font-medium text-sm text-green-600 mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class='bx bx-envelope text-gray-400'></i>
                </div>
                <input id="email"
                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent"
                    style="focus:ring-color: #006C5F;" type="email" name="email" value="{{ old('email') }}"
                    placeholder="Email Address" required autofocus autocomplete="username" />
            </div>
            @error('email')
                <ul class="text-sm text-red-600 space-y-1 mt-2">
                    @foreach ((array) $errors->get('email') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class='bx bx-lock-alt text-gray-400'></i>
                </div>
                <input id="password"
                    class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent"
                    style="focus:ring-color: #006C5F;" type="password" name="password" placeholder="Password" required
                    autocomplete="current-password" />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class='bx bx-hide text-gray-400 cursor-pointer' onclick="togglePassword()"></i>
                </div>
            </div>
            @error('password')
                <ul class="text-sm text-red-600 space-y-1 mt-2">
                    @foreach ((array) $errors->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @enderror
        </div>

        <!-- Login Button -->
        <div class="mt-8">
            <button type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-white font-medium hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200"
                style="background-color: #006C5F; focus:ring-color: #006C5F;">
                Login
            </button>
        </div>

        <!-- Remember Me and Forgot Password -->
        <div class="flex items-center justify-between text-sm">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-gray-600 shadow-sm focus:ring-opacity-50"
                    style="color: #006C5F; focus:ring-color: #006C5F;" name="remember">
                <span class="ml-2 text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
            @endif
        </div>
    </form>

    <!-- Terms and Privacy -->
    <div class="mt-8 text-center text-sm text-gray-500">
        By continuing, you acknowledge that you understand and agree to the
        <a href="#" class="underline hover:text-gray-700">Terms & Conditions</a>
        and
        <a href="#" class="underline hover:text-gray-700">Privacy Policy</a>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.bx-hide, .bx-show');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bx-hide');
                toggleIcon.classList.add('bx-show');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bx-show');
                toggleIcon.classList.add('bx-hide');
            }
        }
    </script>
@endsection
