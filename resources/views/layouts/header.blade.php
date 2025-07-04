@php
    $leftNavLinks = [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Networks', 'url' => route('network')],
        ['name' => 'Affiliate Partners', 'url' => route('affiliate')],
        ['name' => 'Messages', 'url' => route('messages')],
    ];
@endphp

<header class="bg-white shadow-lg border-b border-gray-200">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #006C5F, #00857A);">
                        <span class="text-white font-bold text-lg">E</span>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">EmbizLive</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center justify-between flex-1 ml-10">
                <!-- Left Navigation Links -->
                <nav class="flex space-x-8">
                    @foreach ($leftNavLinks as $link)
                        <a href="{{ $link['url'] }}" 
                           class="relative px-3 py-2 text-gray-700 font-medium transition-colors duration-200 group
                                  {{ request()->is(trim(parse_url($link['url'], PHP_URL_PATH), '/')) || (request()->is('/') && $link['name'] === 'Home') ? 'text-[#006C5F]' : 'hover:text-[#006C5F]' }}">
                            {{ $link['name'] }}
                            <span class="absolute bottom-0 left-0 w-full h-0.5 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200
                                         {{ request()->is(trim(parse_url($link['url'], PHP_URL_PATH), '/')) || (request()->is('/') && $link['name'] === 'Home') ? 'scale-x-100' : '' }}"
                                  style="background-color: #006C5F;"></span>
                        </a>
                    @endforeach
                </nav>

                <!-- Right Navigation - Founder Login -->
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center px-4 py-2 text-white font-medium rounded-lg hover:opacity-90 transition-opacity duration-200 shadow-md hover:shadow-lg"
                           style="background-color: #006C5F;">
                            <i class='bx bx-user text-lg mr-2'></i>
                            Founder Login
                        </a>
                    @else
                        <div class="flex items-center space-x-3">
                            <span class="text-gray-700 font-medium">Welcome, {{ Auth::user()->name }}</span>
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 font-medium rounded-lg hover:bg-red-200 transition-colors duration-200">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" 
                        class="inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-gray-100 transition-colors duration-200">
                    <i class='bx bx-menu text-xl'></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200">
            <div class="px-2 pt-4 pb-6 space-y-2">
                @foreach ($leftNavLinks as $link)
                    <a href="{{ $link['url'] }}" 
                       class="block px-4 py-3 text-gray-700 font-medium rounded-lg transition-colors duration-200
                              {{ request()->is(trim(parse_url($link['url'], PHP_URL_PATH), '/')) || (request()->is('/') && $link['name'] === 'Home') ? 'text-[#006C5F] bg-gray-50' : 'hover:text-[#006C5F] hover:bg-gray-50' }}">
                        {{ $link['name'] }}
                    </a>
                @endforeach
                
                <div class="pt-4 border-t border-gray-200">
                    @guest
                        <a href="{{ route('login') }}" 
                           class="block w-full px-4 py-3 text-white font-medium rounded-lg hover:opacity-90 transition-opacity duration-200 text-center"
                           style="background-color: #006C5F;">
                            <i class='bx bx-user text-lg inline mr-2'></i>
                            Founder Login
                        </a>
                    @else
                        <div class="space-y-2">
                            <div class="px-4 py-2 text-gray-700 font-medium">Welcome, {{ Auth::user()->name }}</div>
                            <a href="{{ route('dashboard') }}" 
                               class="block px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full px-4 py-3 bg-red-100 text-red-700 font-medium rounded-lg hover:bg-red-200 transition-colors duration-200 text-left">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</header>

<!-- JavaScript for Mobile Menu Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });

            // Close mobile menu on window resize to desktop size
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }
    });
</script>
