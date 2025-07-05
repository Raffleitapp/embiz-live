<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Embiz') }} - Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Boxicons -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Alpine.js Cloak Style -->
        <style>
            [x-cloak] { display: none !important; }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen bg-gray-50">
            <!-- Sidebar -->
            <div class="hidden md:flex md:w-48 lg:w-56 xl:w-64 bg-white shadow-lg">
                <div class="p-3 md:p-4 lg:p-6 w-full">
                    <div class="flex items-center space-x-1 md:space-x-2 mb-4 md:mb-6 lg:mb-8">
                        <span class="text-base md:text-lg lg:text-xl font-bold text-gray-800">Embiz</span>
                    </div>
                    
                    <nav class="space-y-1 md:space-y-1 lg:space-y-2">
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1 md:mb-2 lg:mb-3">GENERAL</div>
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-1 md:space-x-2 lg:space-x-3 px-1.5 md:px-2 lg:px-3 py-1.5 md:py-2 text-xs md:text-sm lg:text-base {{ request()->routeIs('dashboard') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                            <i class='bx bx-grid-alt text-base md:text-lg'></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        
                        <div class="relative">
                            <button class="flex items-center justify-between w-full px-1.5 md:px-2 lg:px-3 py-1.5 md:py-2 text-xs md:text-sm lg:text-base {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg" onclick="toggleSubmenu('members')">
                                <div class="flex items-center space-x-1 md:space-x-2 lg:space-x-3">
                                    <i class='bx bx-users text-base md:text-lg'></i>
                                    <span class="font-medium">Members</span>
                                </div>
                                <i class='bx bx-chevron-down text-xs md:text-sm transform transition-transform {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'rotate-180' : '' }}' id="members-chevron"></i>
                            </button>
                            <div class="mt-1 lg:mt-2 ml-3 md:ml-4 lg:ml-6 space-y-1 {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'block' : 'hidden' }}" id="members-submenu">
                                <a href="{{ route('dashboard.members') }}" class="block px-1.5 md:px-2 lg:px-3 py-1 lg:py-2 text-xs lg:text-sm {{ request()->routeIs('dashboard.members') ? 'text-teal-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">All Members</a>
                                <a href="{{ route('dashboard.add-member') }}" class="block px-1.5 md:px-2 lg:px-3 py-1 lg:py-2 text-xs lg:text-sm {{ request()->routeIs('dashboard.add-member') ? 'text-teal-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">Add Member</a>
                            </div>
                        </div>
                        
                        <a href="{{ route('dashboard.roles-permissions') }}" class="flex items-center space-x-1 md:space-x-2 lg:space-x-3 px-1.5 md:px-2 lg:px-3 py-1.5 md:py-2 text-xs md:text-sm lg:text-base {{ request()->routeIs('dashboard.roles-permissions') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                            <i class='bx bx-shield text-base md:text-lg'></i>
                            <span class="font-medium hidden md:inline">Roles & Permissions</span>
                            <span class="font-medium md:hidden">Roles</span>
                        </a>
                        
                        <a href="{{ route('dashboard.activity-logs') }}" class="flex items-center space-x-1 md:space-x-2 lg:space-x-3 px-1.5 md:px-2 lg:px-3 py-1.5 md:py-2 text-xs md:text-sm lg:text-base {{ request()->routeIs('dashboard.activity-logs') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                            <i class='bx bx-list-ul text-base md:text-lg'></i>
                            <span class="font-medium hidden md:inline">Activity Logs</span>
                            <span class="font-medium md:hidden">Logs</span>
                        </a>
                        
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1 md:mb-2 lg:mb-3 mt-3 md:mt-4 lg:mt-6">OTHERS</div>
                        <a href="{{ route('dashboard.settings') }}" class="flex items-center space-x-1 md:space-x-2 lg:space-x-3 px-1.5 md:px-2 lg:px-3 py-1.5 md:py-2 text-xs md:text-sm lg:text-base {{ request()->routeIs('dashboard.settings') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                            <i class='bx bx-cog text-base md:text-lg'></i>
                            <span class="font-medium">Settings</span>
                        </a>
                        
                        <a href="{{ route('dashboard.support') }}" class="flex items-center space-x-1 md:space-x-2 lg:space-x-3 px-1.5 md:px-2 lg:px-3 py-1.5 md:py-2 text-xs md:text-sm lg:text-base {{ request()->routeIs('dashboard.support') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                            <i class='bx bx-help-circle text-base md:text-lg'></i>
                            <span class="font-medium hidden md:inline">Support / Help</span>
                            <span class="font-medium md:hidden">Help</span>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center space-x-1 md:space-x-2 lg:space-x-3 px-1.5 md:px-2 lg:px-3 py-1.5 md:py-2 text-xs md:text-sm lg:text-base text-gray-700 hover:bg-gray-50 rounded-lg w-full text-left">
                                <i class='bx bx-log-out text-base md:text-lg'></i>
                                <span class="font-medium">Logout</span>
                            </button>
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 overflow-hidden">
                <!-- Header -->
                <div class="bg-white shadow-sm border-b">
                    <div class="px-3 sm:px-4 lg:px-6 py-3 lg:py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2 sm:space-x-3 lg:space-x-4">
                                <!-- Mobile menu button -->
                                <button class="md:hidden p-1.5 sm:p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100" onclick="toggleMobileMenu()">
                                    <i class='bx bx-menu text-lg sm:text-xl'></i>
                                </button>
                                
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                    @hasSection('header-icon')
                                        {!! $__env->yieldContent('header-icon') !!}
                                    @else
                                        <i class="bx bx-grid-alt text-gray-600 text-lg sm:text-xl"></i>
                                    @endif
                                </div>
                                <h1 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 truncate">@yield('page-title', 'Dashboard')</h1>
                            </div>
                            
                            <div class="flex items-center space-x-1 sm:space-x-2 lg:space-x-4">
                                <div class="hidden md:block">
                                    @yield('header-actions')
                                </div>
                                
                                <div class="relative">
                                    <button class="p-1.5 sm:p-2 text-gray-400 hover:text-gray-600">
                                        <i class='bx bx-bell text-lg sm:text-xl'></i>
                                    </button>
                                </div>
                                
                                <div class="flex items-center space-x-2 lg:space-x-3">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-teal-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-medium text-xs sm:text-sm">{{ auth()->user()->initials }}</span>
                                    </div>
                                    <div class="hidden md:block">
                                        <div class="text-sm font-medium text-gray-900 truncate max-w-24 lg:max-w-none">{{ auth()->user()->name }}</div>
                                        <div class="text-xs text-gray-500">Admin</div>
                                    </div>
                                    <i class='bx bx-chevron-down text-gray-400 text-sm'></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Mobile header actions -->
                        <div class="md:hidden mt-3">
                            @yield('header-actions')
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                <main class="p-3 sm:p-4 lg:p-6">
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- Mobile Sidebar Overlay -->
        <div id="mobile-sidebar-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" onclick="toggleMobileMenu()"></div>
        
        <!-- Mobile Sidebar -->
        <div id="mobile-sidebar" class="hidden fixed inset-y-0 left-0 z-50 w-56 sm:w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">
            <div class="p-4 sm:p-6">
                <div class="flex items-center justify-between mb-6 sm:mb-8">
                    <span class="text-lg sm:text-xl font-bold text-gray-800">Embiz</span>
                    <button class="p-1.5 sm:p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100" onclick="toggleMobileMenu()">
                        <i class='bx bx-x text-lg sm:text-xl'></i>
                    </button>
                </div>
                
                <nav class="space-y-1 sm:space-y-2">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 sm:mb-3">GENERAL</div>
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 sm:space-x-3 px-2 sm:px-3 py-2 text-sm sm:text-base {{ request()->routeIs('dashboard') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                        <i class='bx bx-grid-alt text-lg'></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <div class="relative">
                        <button class="flex items-center justify-between w-full px-2 sm:px-3 py-2 text-sm sm:text-base {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg" onclick="toggleSubmenu('mobile-members')">
                            <div class="flex items-center space-x-2 sm:space-x-3">
                                <i class='bx bx-users text-lg'></i>
                                <span class="font-medium">Members</span>
                            </div>
                            <i class='bx bx-chevron-down text-sm transform transition-transform {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'rotate-180' : '' }}' id="mobile-members-chevron"></i>
                        </button>
                        <div class="mt-1 sm:mt-2 ml-4 sm:ml-6 space-y-1 {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'block' : 'hidden' }}" id="mobile-members-submenu">
                            <a href="{{ route('dashboard.members') }}" class="block px-2 sm:px-3 py-1 sm:py-2 text-xs sm:text-sm {{ request()->routeIs('dashboard.members') ? 'text-teal-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">All Members</a>
                            <a href="{{ route('dashboard.add-member') }}" class="block px-2 sm:px-3 py-1 sm:py-2 text-xs sm:text-sm {{ request()->routeIs('dashboard.add-member') ? 'text-teal-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">Add Member</a>
                        </div>
                    </div>
                    
                    <a href="{{ route('dashboard.roles-permissions') }}" class="flex items-center space-x-2 sm:space-x-3 px-2 sm:px-3 py-2 text-sm sm:text-base {{ request()->routeIs('dashboard.roles-permissions') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                        <i class='bx bx-shield text-lg'></i>
                        <span class="font-medium">Roles & Permissions</span>
                    </a>
                    
                    <a href="{{ route('dashboard.activity-logs') }}" class="flex items-center space-x-2 sm:space-x-3 px-2 sm:px-3 py-2 text-sm sm:text-base {{ request()->routeIs('dashboard.activity-logs') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                        <i class='bx bx-list-ul text-lg'></i>
                        <span class="font-medium">Activity Logs</span>
                    </a>
                    
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 sm:mb-3 mt-4 sm:mt-6">OTHERS</div>
                    <a href="{{ route('dashboard.settings') }}" class="flex items-center space-x-2 sm:space-x-3 px-2 sm:px-3 py-2 text-sm sm:text-base {{ request()->routeIs('dashboard.settings') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                        <i class='bx bx-cog text-lg'></i>
                        <span class="font-medium">Settings</span>
                    </a>
                    
                    <a href="{{ route('dashboard.support') }}" class="flex items-center space-x-2 sm:space-x-3 px-2 sm:px-3 py-2 text-sm sm:text-base {{ request()->routeIs('dashboard.support') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                        <i class='bx bx-help-circle text-lg'></i>
                        <span class="font-medium">Support / Help</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-2 sm:space-x-3 px-2 sm:px-3 py-2 text-sm sm:text-base text-gray-700 hover:bg-gray-50 rounded-lg w-full text-left">
                            <i class='bx bx-log-out text-lg'></i>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <script>
        function toggleMobileMenu() {
            const overlay = document.getElementById('mobile-sidebar-overlay');
            const sidebar = document.getElementById('mobile-sidebar');
            
            if (overlay.classList.contains('hidden')) {
                overlay.classList.remove('hidden');
                sidebar.classList.remove('hidden');
                setTimeout(() => {
                    sidebar.classList.remove('-translate-x-full');
                }, 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                    sidebar.classList.add('hidden');
                }, 300);
            }
        }
        
        function toggleSubmenu(submenu) {
            const submenuElement = document.getElementById(submenu + '-submenu');
            const chevron = document.getElementById(submenu + '-chevron');
            
            if (submenuElement && chevron) {
                if (submenuElement.classList.contains('hidden')) {
                    submenuElement.classList.remove('hidden');
                    submenuElement.classList.add('block');
                    chevron.classList.add('rotate-180');
                } else {
                    submenuElement.classList.add('hidden');
                    submenuElement.classList.remove('block');
                    chevron.classList.remove('rotate-180');
                }
            }
        }
        </script>
        @stack('scripts')
    </body>
</html>
