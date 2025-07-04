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
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Verify your email</h1>
        <p class="text-gray-600 mb-2">Please enter the verification code sent to:</p>
        <p class="text-gray-800 font-medium">{{ Auth::user()->email ?? 'your@email.com' }}</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-green-600 text-center">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="space-y-6">
        @csrf

        <!-- Verification Code Input -->
        <div>
            <div class="flex justify-center space-x-2 mb-8">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent" style="focus:ring-color: #006C5F;" oninput="moveToNext(this, 'code2')" id="code1">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent" style="focus:ring-color: #006C5F;" oninput="moveToNext(this, 'code3')" id="code2">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent" style="focus:ring-color: #006C5F;" oninput="moveToNext(this, 'code4')" id="code3">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent" style="focus:ring-color: #006C5F;" oninput="moveToNext(this, 'code5')" id="code4">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent" style="focus:ring-color: #006C5F;" oninput="moveToNext(this, 'code6')" id="code5">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent" style="focus:ring-color: #006C5F;" oninput="moveToNext(this, null)" id="code6">
            </div>
        </div>

        <!-- Continue Button -->
        <div class="mt-8">
            <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-white font-medium hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200"
                    style="background-color: #006C5F; focus:ring-color: #006C5F;">
                Continue
            </button>
        </div>

        <!-- Resend Code -->
        <div class="text-center text-sm text-gray-500 mt-6">
            Didn't receive a code? 
            <button type="submit" class="font-semibold text-gray-700 hover:text-gray-900 focus:outline-none">
                Resend code
            </button>
        </div>
    </form>

    <!-- Terms and Privacy -->
    <div class="mt-8 text-center text-sm text-gray-500">
        By continuing, you acknowledge that you understand and agree to the 
        <a href="#" class="underline hover:text-gray-700">Terms & Conditions</a> 
        and 
        <a href="#" class="underline hover:text-gray-700">Privacy Policy</a>
    </div>

    <!-- Logout Link -->
    <div class="mt-4 text-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline focus:outline-none">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>

    <script>
        function moveToNext(current, nextFieldId) {
            if (current.value.length >= current.maxLength) {
                if (nextFieldId) {
                    document.getElementById(nextFieldId).focus();
                }
            }
        }

        // Handle backspace to move to previous field
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace') {
                const currentId = e.target.id;
                if (currentId && currentId.startsWith('code') && e.target.value === '') {
                    const currentNum = parseInt(currentId.replace('code', ''));
                    if (currentNum > 1) {
                        const prevId = 'code' + (currentNum - 1);
                        document.getElementById(prevId).focus();
                    }
                }
            }
        });
    </script>
@endsection
