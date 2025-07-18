@php
    $leftNavLinks = [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Networks', 'url' => route('network.index')],
        ['name' => 'Affiliate Partners', 'url' => route('affiliate.index')],
        ['name' => 'Messages', 'url' => route('messages.index')],
    ];
@endphp

<header class="bg-white shadow-lg border-b border-gray-200">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 md:h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <span class="text-lg md:text-xl lg:text-2xl font-bold text-gray-900">EmbizLive</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center justify-between flex-1 ml-4 lg:ml-10">
                <!-- Left Navigation Links -->
                <nav class="flex space-x-4 lg:space-x-8">
                    @foreach ($leftNavLinks as $link)
                        <a href="{{ $link['url'] }}" 
                           class="relative px-2 lg:px-3 py-2 text-sm lg:text-base text-gray-700 font-medium transition-colors duration-200 group
                                  {{ request()->is(trim(parse_url($link['url'], PHP_URL_PATH), '/')) || (request()->is('/') && $link['name'] === 'Home') ? 'text-[#006C5F]' : 'hover:text-[#006C5F]' }}">
                            {{ $link['name'] }}
                            <span class="absolute bottom-0 left-0 w-full h-0.5 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200
                                         {{ request()->is(trim(parse_url($link['url'], PHP_URL_PATH), '/')) || (request()->is('/') && $link['name'] === 'Home') ? 'scale-x-100' : '' }}"
                                  style="background-color: #006C5F;"></span>
                        </a>
                    @endforeach
                </nav>

                <!-- Right Navigation - Founder Login -->
                <div class="flex items-center space-x-2 lg:space-x-4">
                    @guest
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center px-3 lg:px-4 py-2 text-white text-sm lg:text-base font-medium rounded-lg hover:opacity-90 transition-opacity duration-200 shadow-md hover:shadow-lg"
                           style="background-color: #006C5F;">
                            <i class='bx bx-user text-base lg:text-lg mr-1 lg:mr-2'></i>
                            <span class="hidden sm:inline">Founder </span>Login
                        </a>
                    @else
                        <div class="flex items-center space-x-2 lg:space-x-4">
                            <!-- Notifications -->
                            <button class="relative p-1 lg:p-2 text-gray-600 hover:text-gray-900 transition-colors duration-200">
                                <i class='bx bx-bell text-lg lg:text-xl'></i>
                                <span class="absolute -top-1 -right-1 w-2 h-2 lg:w-3 lg:h-3 bg-red-500 rounded-full"></span>
                            </button>

                            <!-- Help -->
                            <button class="p-1 lg:p-2 text-gray-600 hover:text-gray-900 transition-colors duration-200">
                                <i class='bx bx-help-circle text-lg lg:text-xl'></i>
                            </button>

                            <!-- Profile Dropdown -->
                            <div class="relative">
                                <button id="profile-dropdown-button" class="flex items-center space-x-1 lg:space-x-2 text-gray-700 hover:text-gray-900 transition-colors duration-200">
                                    <div class="w-7 h-7 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                        <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                             alt="Profile" 
                                             class="w-full h-full object-cover">
                                    </div>
                                    <i class='bx bx-chevron-down text-sm'></i>
                                </button>
                                
                                <div id="profile-dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                                    <a href="{{ route('user-profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class='bx bx-user mr-2'></i>View Profile
                                    </a>
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class='bx bx-dashboard mr-2'></i>Dashboard
                                    </a>
                                    <a href="{{ route('messages.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class='bx bx-message mr-2'></i>Messages
                                    </a>
                                    <div class="border-t border-gray-200 my-1"></div>
                                    <a href="{{ route('account.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class='bx bx-cog mr-2'></i>Settings
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                            <i class='bx bx-log-out mr-2'></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" 
                        class="inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-gray-100 transition-colors duration-200">
                    <i class='bx bx-menu text-lg'></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200">
            <div class="px-2 pt-3 pb-4 space-y-1">
                @foreach ($leftNavLinks as $link)
                    <a href="{{ $link['url'] }}" 
                       class="block px-3 py-2 text-sm text-gray-700 font-medium rounded-lg transition-colors duration-200
                              {{ request()->is(trim(parse_url($link['url'], PHP_URL_PATH), '/')) || (request()->is('/') && $link['name'] === 'Home') ? 'text-[#006C5F] bg-gray-50' : 'hover:text-[#006C5F] hover:bg-gray-50' }}">
                        {{ $link['name'] }}
                    </a>
                @endforeach
                
                <div class="pt-3 border-t border-gray-200">
                    @guest
                        <a href="{{ route('login') }}" 
                           class="block w-full px-3 py-2 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity duration-200 text-center"
                           style="background-color: #006C5F;">
                            <i class='bx bx-user text-base inline mr-1'></i>
                            Founder Login
                        </a>
                    @else
                        <div class="space-y-2">
                            <div class="px-3 py-2 text-sm text-gray-700 font-medium">Welcome, {{ Auth::user()->name }}</div>
                            <a href="{{ route('dashboard') }}" 
                               class="block px-3 py-2 bg-gray-100 text-sm text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full px-3 py-2 bg-red-100 text-sm text-red-700 font-medium rounded-lg hover:bg-red-200 transition-colors duration-200 text-left">
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

<!-- JavaScript for Mobile Menu Toggle and Profile Dropdown -->
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

        // Profile Dropdown Functionality
        const profileDropdownButton = document.getElementById('profile-dropdown-button');
        const profileDropdownMenu = document.getElementById('profile-dropdown-menu');

        if (profileDropdownButton && profileDropdownMenu) {
            profileDropdownButton.addEventListener('click', function(event) {
                event.preventDefault();
                profileDropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!profileDropdownButton.contains(event.target) && !profileDropdownMenu.contains(event.target)) {
                    profileDropdownMenu.classList.add('hidden');
                }
            });
        }
    });
</script>
